<?php	
	include 'Teaser.php';
	
	class Article {
		public $url;
		public $title;
		public $date;
		public $summary;
		
		function __construct ( $url, $title, $date, $summary ) {
			$this->url = $url;
			$this->title = $title;
			$this->date = $date;
			$this->summary = $summary;
		}
	}
	
	function summarizeArticleFast ( $article, &$title="" ) {		
		$teaser = new Teaser ();				
		$article->summary = json_encode($teaser->createSummary ( $article->url, "url", $title ));
	}
	
	function summarizeArticle ( $article, &$title="" ) {
		$summary = array ();
				
		if (strstr(substr($article->url, 0, 8), "http://") == FALSE) {
			$article->url = "http://" . $article->url;
		}
		
		$url = "http://textteaser.com/summary?url=" . $article->url;		
		
		$content = file_get_contents ( $url );
		if ( $content != FALSE ) {						
			$dom = new DOMDocument;
			@$dom->loadHTML($content);
			$summaries = $dom->getElementsByTagName('ul');
			
			foreach ($summaries->item(0)->getElementsByTagName('li') as $summaryList) {
				array_push ( $summary, trim ( str_replace ( "'", "", str_replace ( '"', '', html_entity_decode ( preg_replace('/\s+/', ' ', str_replace( array("\r","\n"), "", $summaryList->nodeValue ) ) ) ) ) ) );                    
			}			
			
			// Don't save
			if ( count ( $summary ) == 0 ) {
				$teaser = new Teaser ();				
				$article->summary = json_encode($teaser->createSummary ( $article->url, "url", $title ));
			} else {
				$article->summary = json_encode ($summary);
			}
		} else {
			$teaser = new Teaser ();				
			$article->summary = json_encode($teaser->createSummary ( $article->url, "url", $title ));
		}
		
		if ( $title == null || 
			 strlen ( $title ) == 0 ) {
			$title = "A summary has been generated!";
		}
	}
	
	function summarizeResults ( $results ) {		
		for ( $i = 0; $i < count ($results); $i ++ ) {
			summarizeArticle ( $results[$i] );
		}
	}
?>