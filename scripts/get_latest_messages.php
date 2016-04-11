<?php
	// Setup database credentials
	$servername="localhost";
	$username="hussaina_admin";
	$password="john.f.kennedy";
	$database="hussaina_projecty";
	
	// Establish a connection
	$connection = new mysqli($servername, $username, $password, $database);
	
	// Setup the query
	$sql = "SELECT * FROM latest_messages";	
	$result = $connection->query ( $sql );
	
	// Collect the results
	$results = array ();
	
	if ( $result->num_rows > 0 ) {
		while ( $row = $result->fetch_assoc() ) {
			$name = $row["name"];
			$article_id = $row["article_id"];
			$sql = "SELECT * FROM rss_feeds WHERE id='$article_id'";
			$results_rss_feeds = $connection->query ( $sql );
			
			// Push the result
			if ( $results_rss_feeds->num_rows > 0 ) {
				while ( $row = $results_rss_feeds->fetch_assoc() ) {
					$title = "<strong>" . $name . "</strong>" . " posted in " . $row["title"];
					array_push($results, $title . "---" . $row["id"] );
				}
			}
		}
	}
	
	// Display the results
	if ( count ( $results ) > 0 ) {
		//$results = json_encode ( $results );	
		$output = '[';
		
		for ( $i = 0; $i < count ( $results ); $i ++ ) {
			$output = $output . '"' . $results [$i] . '"';
			
			if ( $i + 1 < count ( $results ) ) {
				$output = $output . ',';
			}
		}
		
		$output = $output . ']';
		echo $output;
	}
	
	// Close the connection
	$connection->close ();
?>