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
			$article_id = $row["article_id"];
			$sql = "SELECT * FROM rss_feeds WHERE id='$article_id'";
			$results_rss_feeds = $connection->query ( $sql );
			
			// Push the result
			if ( $results_rss_feeds->num_rows > 0 ) {
				while ( $row = $results_rss_feeds->fetch_assoc() ) {
					array_push($results, $row["title"] . "---" . $row["id"] );
				}
			}
		}
	}
	
	// Display the results
	$results = json_encode ( $results );	
	echo $results;
	
	// Close the connection
	$connection->close ();
?>