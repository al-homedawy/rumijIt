<?php
	ini_set('max_execution_time', 3600);
	
	header('Content-Type: text/plain; charset=utf-8');
	
	include 'rss_database.php';
	include 'summarize_article.php';
	include 'extract_from_google.php';
	
	// Obtain the search key
	$search = $_GET["search"];
	
	// Extract the latest articles from RSS feeds
	$rss_feeds = retrieveAllFeeds ( $search );
		
	// Extract the latests articles from Google News
	$google_news = parseGoogleNews ( $search );
	
	// Summarize the latest articles from Google News
	summarizeResults ( $google_news );
	
	// Merge the results together
	$results = array_merge ( $rss_feeds, $google_news );
	
	// Display the encoded result
	echo json_encode ( $results );
?>