<?php
	require 'php/autoloader.php';
	
	include 'rss_database.php';
	
	class RSSFeed {
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
	
	class CollectRSSFeed {
		function setupRSSArray () {
			// Setup our RSS feed array
			$rss_feed = array ();
			
			// General 
			array_push($rss_feed, "http://feeds.reuters.com/Reuters/domesticNews");
			array_push($rss_feed, "http://feeds.reuters.com/Reuters/worldNews");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/topNews");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/topstories.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/world.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/canada.xml");
			array_push($rss_feed, "http://www.cbc.ca/cmlink/rss-cbcaboriginal");
			array_push($rss_feed, "http://www.thestar.com/feeds.topstories.rss");
			array_push($rss_feed, "http://www.thestar.com/feeds.articles.news.rss");
			array_push($rss_feed, "http://feeds.foxnews.com/foxnews/latest");
			array_push($rss_feed, "http://feeds.feedburner.com/NdtvNews-TopStories");
			array_push($rss_feed, "http://feeds.ign.com/ign/all");
			
			// General - Middle East
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=news");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=opinion");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=features");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=business");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=culture");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=travel");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=special-reports");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=columns");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?section=hot-topics");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=84");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=67");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=68");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=69");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=70");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=71");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=72");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=73");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=74");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=75");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=87");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=76");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=83");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=77");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=78");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=79");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=86");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=80");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=81");
			array_push($rss_feed, "http://www.yourmiddleeast.com/getRSS.php?regionID=82");
			
			// General - Europe
			/*
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=42&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=43&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=44&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=45&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=47&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=48&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=49&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=50&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=51&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=53&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=41&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=52&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=147&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=89&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=57&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=59&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=268&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=46&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=60&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=61&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=55&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=40&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=62&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=63&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=64&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=65&language=EN&format=RSS");
			array_push($rss_feed, "http://europa.eu/rapid/search-result.htm?query=66&language=EN&format=RSS");*/
			
			// Politics
			array_push($rss_feed, "http://feeds.reuters.com/Reuters/PoliticsNews");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/politics.xml");
			
			// Business 
			array_push($rss_feed, "http://www.forbes.com/business/feed/");
			array_push($rss_feed, "http://www.forbes.com/finance/index.xml");
			array_push($rss_feed, "http://www.forbes.com/entrepreneurs/index.xml");
			array_push($rss_feed, "http://www.forbes.com/markets/index.xml");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/businessNews");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/business.xml");
			array_push($rss_feed, "http://feeds.feedburner.com/entrepreneur/latest");
			array_push($rss_feed, "http://feeds.feedburner.com/entrepreneur/salesandmarketing");
			
			// Technology 
			array_push($rss_feed, "http://feeds.reuters.com/reuters/technologyNews");
			array_push($rss_feed, "http://www.forbes.com/technology/index.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/technology.xml");
			array_push($rss_feed, "http://feeds.feedburner.com/entrepreneur/startingabusiness.rss");
			array_push($rss_feed, "http://feeds.feedburner.com/entrepreneur/ebiz");
			
			// Sports 
			array_push($rss_feed, "http://www.thestar.com/feeds.articles.sports.rss");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/sportsNews");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-mlb.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-nba.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-curling.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-cfl.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-nfl.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-soccer.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/sports-figureskating.xml");
			
			// Celebrity
			array_push($rss_feed, "http://feeds.reuters.com/reuters/peopleNews");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/arts.xml");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/offbeat.xml");
			
			// Science 
			array_push($rss_feed, "http://feeds.reuters.com/reuters/scienceNews");
			
			// Entertainment
			array_push($rss_feed, "http://feeds.reuters.com/reuters/entertainment");
			array_push($rss_feed, "http://feeds.reuters.com/news/reutersmedia");
			
			// Lifestyle
			array_push($rss_feed, "http://feeds.reuters.com/reuters/businessNews");
			array_push($rss_feed, "http://feeds.reuters.com/reuters/lifestyle");
			array_push($rss_feed, "http://rss.cbc.ca/lineup/health.xml");
			
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
					$image_src = $item->get_enclosure()->get_link();
					
					if ( strlen ( $image_src ) == 0 ) {
						$description = $item->get_description();
						if ( strlen ($description) > 0 ) {
							$image_src = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($description))->xpath("//img/@src"));
							if ( strlen ( $image_src ) > 0 ) {
								$size = getimagesize ( $image_src );
								
								if ( $size == false ||
									 $size[0] < 10 ||
									 $size[1] < 10 ) {
									$image_src = "";
								}
							}
						}
					}
					
					$article = new RSSFeed ( $item->get_title(),
											 $item->get_link (),
											 $item->get_date (),
											 $image_src );
											 
					// Summarize the article
					summarizeArticle ( $article );
										
					// Insert result into database
					insertIntoDatabase ( $article->title, 
										 $article->url, 
										 $article->date, 
										 $article->thumbnail,
										 $article->summary );
				}
			}
		}
	}
?>