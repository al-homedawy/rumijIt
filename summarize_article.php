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
	
	function summarizeArticle ( $article ) {
		$teaser = new Teaser ();	
			
		$article->summary = $teaser->createSummary ( $article->url, "url" );
	}
	
	function summarizeResults ( $results ) {		
		for ( $i = 0; $i < count ($results); $i ++ ) {
			$teaser = new Teaser ();	
			
			$results[$i]->summary = $teaser->createSummary ( $results[$i]->url, 
															 "url" );			 
		}
	}
?>