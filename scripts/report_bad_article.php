<?php
	$article_id = $_GET["id"];
	$message = "Article #" . $article_id . " has been reported.";
	mail ( "hussain_al@live.ca", "Report from RumijIt", $message );
?>