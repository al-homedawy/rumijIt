<!DOCTYPE HTML>
<html>
	<head>
		<title>Rumijit</title>
		
		<!-- Site information -->
		<meta name="author" content="Hussain Al-Homedawy">
		<meta name="keywords" content="news,summarize,simple,inquiry,inquire,latest">
		
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
	
	<body>
		<!-- Navbar -->
		<div class="container-fixed navbar">			
			<!-- Contact Me -->
			<a href="https://www.linkedin.com/in/hussainal" target="_blank"><u>Contact Me</u></a>
		</div>
		
		<!-- Logo -->
		<div class="logo" align="center">
			<img src='images/rumijitLogo.gif' width='300px' height='200px' />
		</div>
	
		<!-- Introduction -->
		<div class="introduction" align="center">
			<h2 id="introduction_text">Search for your summarized news articles</h2>
		</div>
	
		<!-- Search -->
		<div class="search_class" style="margin-top: 5px;" align="center">	
			<!-- Search icon -->
			<img class="search_icon" src='images/newspaper.png' width="30" height="30" />
			
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
			<!-- Search icon -->
			<img class="search_icon" src='images/newspaper.png' width="30" height="30" />
			
			<!-- Search text -->
			<input id="single_article_query" type="text" placeholder="Ex: http://google.ca" />
			
			<!-- Search icon -->
			<button class="btn btn-primary btn-sm" id="single_article_button" type="button">Summarize</button>
		</div>
		
		<!-- Loading message -->
		<div class="loading_message" align="center">
			<h2 id="loading_message_text">Give us a moment while we search the web!</h2>
		</div>
		
		<!-- Common searches -->
		<div class="common_searches" align="center">			
			<h4>People searched for...</h4>
			
			<!-- Latest news -->
			<a href="#" id="search_latest_news"><u>Latest News</u></a>
			
			<!-- United States -->
			<a href="#" id="search_united_states"><u>United States</u></a>
			
			<!-- Tesla -->
			<a href="#" id="search_tesla"><u>Tesla</u></a>
			
			<!-- Islam -->
			<a href="#" id="search_islam"><u>Islam</u></a>
			
			<!-- Syria -->
			<a href="#" id="search_syria"><u>Syria</u></a>
			
			<!-- Trump -->
			<a href="#" id="search_trump"><u>Trump</u></a>
			
			<!-- Obama -->
			<a href="#" id="search_obama"><u>Obama</u></a>
			
			<!-- Sports -->
			<a href="#" id="search_sports"><u>Sports</u></a>
		</div>
		
		<footer>
			<p class="text-muted">
				Content &copy; 2015 &nbsp;RumijIt. All Rights Reserved &nbsp; &nbsp;
			</p>
		</footer>
		
		<!-- Search results -->
		<div id="search_query_results" width="100%" height="100%" />
	</body>
</html>