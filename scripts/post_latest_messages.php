<?php
	// Setup database credentials
	$servername="localhost";
	$username="hussaina_admin";
	$password="john.f.kennedy";
	$database="hussaina_projecty";
	
	// Get variables
	$article_id = $_GET["id"];
	
	// Establish a connection
	$connection = new mysqli($servername, $username, $password, $database);
	
	// Setup the query
	$sql = "INSERT INTO latest_messages (article_id) VALUES ('$article_id')";	
	$connection->query ( $sql );
	
	// Close the connection
	$connection->close ();
?>