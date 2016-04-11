<?php
	// Setup database credentials
	$servername="localhost";
	$username="hussaina_admin";
	$password="john.f.kennedy";
	$database="hussaina_projecty";
	
	// Get variables
	$article_id = $_GET["id"];
	$name = $_GET["name"];
	
	// Establish a connection
	$connection = new mysqli($servername, $username, $password, $database);
	
	// Setup the query
	$sql = "INSERT INTO latest_messages (article_id, name) VALUES ('$article_id', '$name')";	
	$connection->query ( $sql );
	
	// Close the connection
	$connection->close ();
?>