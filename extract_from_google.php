<?php	
	define ( "MAIN_SITE", "www.al-homedawy" );
	define ( "SERVER_IP", "99.239.204.188" );
	
	class GoogleNews {
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
	
	function parseGoogleNews ( $search ) {
		// Setup our results
		$google_news = array ();
		
		// Obtain our ip address
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
		// Setup our Google news url
		$url = "https://ajax.googleapis.com/ajax/services/search/news?";
		$url .= "v=1.0&q=";
		$url .= $search;
		$url .= "&userip=";
		$url .= SERVER_IP;//$ip_address;
		$url .= "&rsz=8&scoring=d";
		
		// Replace all spaces with %20
		$url = str_replace ( ' ', '%20', $url );
		
		//echo $url . "<br>";
		
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
				array_push ( $google_news, new GoogleNews ( $results[$i]->title,
															$results[$i]->unescapedUrl,
															$results[$i]->publishedDate ));
			}
		}
		
		return $google_news;
	}
?>