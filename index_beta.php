<!DOCTYPE HTML>
<html>
	<head>
		<title>Quick News</title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- External JQuery file -->
		<script src="jquery.js"></script>
		
		<!-- Styling sheet -->
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body style="overflow: hidden">
		<!-- Navbar -->
		<div class="container-fixed navbar" align="right">
			<!-- Contact Me -->
			<a href="https://www.linkedin.com/in/hussainal" target="_blank">Contact Me</a>
		</div>
	
		<!-- Introduction -->
		<div class="introduction" align="center">
			<h2 id="introduction_text">Search for your summarized news articles</h2>
		</div>
	
		<!-- Search -->
		<div class="search_class" style="margin-top: 5px;" align="center">
				<!-- Search text -->
				<input id="search_query" type="text" placeholder="Ex: Trump" list="search_suggestions">
					<datalist id="search_suggestions">
					</datalist>
				</input>
				
				<!-- Search icon -->
				<button class="btn btn-primary btn-sm" id="search_button" type="button">Search</button>
		</div>
		
		<!-- Summarize an individual article -->
		<div class="single_article_intro" align="center">
			<h3 id="introduction_text">... or summarize a single article ...</h3>
		</div>
		
		<div class="single_article_class" style="margin-top: 5px;" align="center">
			<!-- Search text -->
			<input id="single_article_query" type="text" placeholder="Ex: http://google.ca" />
			
			<!-- Search icon -->
			<button class="btn btn-primary btn-sm" id="single_article_button" type="button">Summarize</button>
		</div>
		
		<!-- Loading message -->
		<div class="loading_message" align="center">
			<h2>Give us a moment while we search the web!</h2>
		</div>
		
		<!-- Search results -->
		<iframe id="search_query_results" width="100%" height="100%" seamless="seamless" />
	</body>
</html>