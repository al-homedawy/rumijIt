<?php
	ini_set('max_execution_time', 3600);
	
	// Turn off all error reporting
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT);
	
	include 'summarize_article.php';
	include 'extract_from_rss.php';
	
	// Initialize our RSS scraper
	$collectRSSFeed = new CollectRSSFeed ();
	
	// Setup our RSS URL Array
	$rss_array = $collectRSSFeed->setupRSSArray ();
		
	// Extract the latest articles from RSS feeds
	$collectRSSFeed->parseRSSFeed ( $rss_array );
?>