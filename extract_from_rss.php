<?php
	require 'php\autoloader.php';
	
	include 'rss_database.php';
	
	class RSSFeed {
		public $title;
		public $url;
		public $date;
		public $summary;
		
		function __construct ( $title, $url, $date ) {
			$this->title = $title;
			$this->url = $url;
			$this->date = $date;
		}
	}
	
	class CollectRSSFeed {
		function setupRSSArray () {
			// Setup our RSS feed array
			$rss_feed = array ();
			
			// General 
			array_push($rss_feed, "http://feeds.reuters.com/Reuters/domesticNews");
			array_push($rss_feed, "http://feeds.reuters.com/Reuters/worldNews");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/topNews");
			
			// Politics
			array_push($rss_feed, "http://feeds.reuters.com/Reuters/PoliticsNews");
			
			// Business 
			array_push($rss_feed, "http://www.forbes.com/business/feed/");
			array_push($rss_feed, "http://www.forbes.com/finance/index.xml");
			array_push($rss_feed, "http://www.forbes.com/entrepreneurs/index.xml");
			array_push($rss_feed, "http://www.forbes.com/markets/index.xml");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/businessNews");
			
			// Technology 
			array_push($rss_feed, "http://feeds.reuters.com/reuters/technologyNews");
			array_push($rss_feed, "http://www.forbes.com/technology/index.xml");
			
			// Sports 
			array_push($rss_feed, "http://feeds.reuters.com/reuters/sportsNews");
			
			// Celebrity
			array_push($rss_feed, "http://feeds.reuters.com/reuters/peopleNews");
			
			// Science 
			array_push($rss_feed, "http://feeds.reuters.com/reuters/scienceNews");
			
			// Entertainment
			array_push($rss_feed, "http://feeds.reuters.com/reuters/entertainment");
			array_push($rss_feed, "http://feeds.reuters.com/news/reutersmedia");
			
			// Lifestyle
			array_push($rss_feed, "http://feeds.reuters.com/reuters/businessNews");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/lifestyle");
			
			// Food
			array_push($rss_feed, "http://feeds.reuters.com/reuters/healthNews");
			
			// Environment
			array_push($rss_feed, "http://feeds.reuters.com/reuters/environment");
			
			return $rss_feed;
		}
		
		function parseRSSFeed ( $url_array ) {
			$length = count($url_array);
			
			// Go through each RSS feed link
			for ( $i = 0; $i < $length; $i ++ ) {
				$feed = new SimplePie ();
				$feed->set_feed_url ( $url_array[$i] );
				$feed->init ();
				$feed->handle_content_type ();
				
				// Add each article from each link into an array
				foreach ( $feed->get_items() as $item ) {
					$article = new RSSFeed ( $item->get_title(),
											 $item->get_link (),
											 $item->get_date () );
											 
					summarizeArticle ( $article );
					
					// Insert result into database
					insertIntoDatabase ( $article->title, 
										 $article->url, 
										 $article->date, 
										 json_encode($article->summary) );
				}
			}
		}
	}
?>