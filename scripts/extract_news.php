<?php
	ini_set('max_execution_time', 3600);
	define ( "MAX_RESULTS", "30" );
	
	include 'rss_database.php';
	include 'summarize_article.php';
	include 'extract_from_google.php';
	
	function extractNews ( $search ) {
		
		// Extract the latest articles from RSS feeds
		$rss_feeds = retrieveAllFeeds ( $search );
		
		$google_news = null;
			
		// Extract the latests articles from Google News
		if ( count ( $rss_feeds ) < MAX_RESULTS ) {
			$google_news = parseGoogleNews ( $search );
		}
		
		// Merge the results together
		$results = $rss_feeds;
		
		if ( $google_news !== null ) {
			$results = array_merge ( $google_news, $rss_feeds );
		}
		
		// Display the encoded result
		return json_encode ( $results );
	}
	
	function extractArticle ( $id ) {
		$article = retrieveArticle ( $id );
		
		return json_encode ( $article );
	}
?>