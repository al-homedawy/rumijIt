<?php	
	require 'php/autoloader.php';
	
	class GoogleNews {
		public $title;
		public $url;
		public $date;
		public $thumbnail;
		public $summary;
		
		function __construct ( $title, $url, $date, $thumbnail ) {
			$this->title = $title;
			$this->url = $url;
			$this->date = $date;
			$this->thumbnail = $thumbnail;
		}
	}
	
	function parseGoogleNews ( $search ) {
		// Setup our results
		$google_news = array ();
		
		// Replace all spaces with %20
		$search = str_replace ( ' ', '%20', $search );
		
		// Create our Google news url
		$google_url = "http://news.google.de/news/feeds?pz=1&cf=all&output=rss&hl=en&q=";
		$google_url .= $search;
		
		// Initialize SimplePie
		$feed = new SimplePie ();
		$feed->set_feed_url ( $google_url );
		$feed->init ();
		$feed->handle_content_type ();
		
		// Add each article from each link into an array
		foreach ( $feed->get_items() as $item ) {						
			$url = substr ( $item->get_link (), strpos ( $item->get_link (), "url=" ) + 4 );
			
			$article = new GoogleNews ( $item->get_title(),
										$url,
										$item->get_date (),
										null );
									 
			// Summarize the article
			summarizeArticle ( $article );
			
			array_push ( $google_news, $article );
		}
		
		return $google_news;
	}
?>