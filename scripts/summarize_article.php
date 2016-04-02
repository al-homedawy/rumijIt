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
	
	function summarizeArticle ( $article, &$title="" ) {
		$teaser = new Teaser ();	
			
		$article->summary = json_encode($teaser->createSummary ( $article->url, "url", $title ));
	}
	
	function summarizeResults ( $results ) {		
		for ( $i = 0; $i < count ($results); $i ++ ) {
			summarizeArticle ( $results[$i] );
		}
	}
?>