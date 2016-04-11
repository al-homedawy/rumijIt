<?php
	// Setup database credentials
	$servername="localhost";
	$username="hussaina_admin";
	$password="john.f.kennedy";
	$database="hussaina_projecty";
	
	// Get neccessary message variables
	$article_id = $_GET["id"];
	$name = $_GET["name"];
	$message = $_GET["message"];
	$message = $name . ": " . $message;	
	$message = htmlentities ( $message, ENT_QUOTES );
		
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
		
		// Create our message
		$messages = null;
		
		if ( strlen ( $row ["messages"] ) > 0 ) {
			$messages = json_decode ( $row ["messages"] );
		} else {
			$messages = array ();
		}
		
		array_push ( $messages, $message );
		$messages = json_encode ( $messages );
		
		// Update the message 
		$sql = "UPDATE rss_feeds SET messages='$messages' WHERE id='$article_id'";
		$connection->query ( $sql );
	} 
		
	// Close the connection
	$connection->close ();
?>