<?php	
	define ( "MAIN_SITE", "www.al-homedawy" );
	define ( "MAX_INTERATIONS", "1" );
	
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
		
		// Obtain our ip address
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
		// Replace all spaces with %20
		$search = str_replace ( ' ', '%20', $search );
		
		// Create our Google news url
		$google_url = "https://ajax.googleapis.com/ajax/services/search/news?";
		$google_url .= "v=1.0&q=";
		$google_url .= $search;
		$google_url .= "&userip=";
		$google_url .= $ip_address;
		$google_url .= "&rsz=large&scoring=d";
		
		$j = 0;
		$iterations = 0;
		
		while ( $iterations < MAX_INTERATIONS ) {		
			
			// Setup our Google news url
			$url = $google_url . "&start=" . $j;
			
			// Obtain our JSON file
			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_REFERER, MAIN_SITE );
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
			$body = curl_exec($ch);
			curl_close($ch);
			
			// Decode our result
			$body = json_decode($body);
			
			$results = $body->responseData->results;
			
			if ( error_get_last () === NULL ) {
				$count = count($results);
			
				for ( $i = 0; $i < $count; $i ++ ) {
					$result = $results[$i];
					
					$google_news_report = new GoogleNews ( $result->title,
														   $result->unescapedUrl,
														   $result->publishedDate,
														   "");
					if ( isset ( $results[$i]->image ) ) {
						$google_news_report->thumbnail = $results[$i]->image->url;
					}			
					
					array_push ( $google_news, $google_news_report );
				}
			}
			
			$j += 8;
			$iterations += 1;
		}
		
		return $google_news;
	}
?>