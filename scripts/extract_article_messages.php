<?php
	// Setup database credentials
	$servername="localhost";
	$username="hussaina_admin";
	$password="john.f.kennedy";
	$database="hussaina_projecty";
	
	// Get neccessary message variables
	$article_id = $_GET["id"];
	
	// Establish a connection
	$connection = new mysqli($servername, $username, $password, $database);
	
	// Check connection
	if ( $connection->connect_error ) {
		die ("Connection failed: " . $connection->connect_error);
	}
	
	// Grab the article summary
	$sql = "SELECT * FROM rss_feeds WHERE id='$article_id'";
	$result = $connection->query ($sql);
	
	if ( $result->num_rows > 0 ) {
		$row = $result->fetch_assoc();
		
		echo $row["messages"];
	}
	
	// Close the connection
	$connection->close ();
?>