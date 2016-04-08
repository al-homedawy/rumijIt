<?php
	include 'summarize_article.php';
	
	// Setup database credentials
	$servername="localhost";
	$username="root";
	$password="";
	$database="projecty";
	
	// Establish a connection
	$connection = new mysqli($servername, $username, $password, $database);
	
	// Check connection
	if ( $connection->connect_error ) {
		die ("Connection failed: " . $connection->connect_error);
	}
	
	$sql = "SELECT * FROM rss_feedss";
	$result = $connection->query($sql);
	
	if ( $result->num_rows > 0 ) {
		while ( $row = $result->fetch_assoc() ) {
			echo $row["url"];
		}
	}
	
	// Close the connection
	$connection->close();	
?>