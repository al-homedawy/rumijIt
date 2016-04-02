<?php
	$search = $_GET["search"];
	$result = array ();
	
	// Create the url
	$url = "http://clients1.google.com/complete/search?hl=en&output=toolbar&q=" . $search;
	
	// Obtain the url's content
	clearstatcache();
	$body = file_get_contents ( $url );
	$xml_data = new SimpleXMLElement( $body );
	
	for ( $j = 0; $j < count ( $xml_data ); $j++ ) {
		echo $xml_data->CompleteSuggestion[$j]->suggestion["data"] . ",";
	}
?>