<!DOCTYPE HTML>
<html>
	<head>
		<title>Rumijit</title>
		
		<!-- Site information -->
		<meta name="author" content="Hussain Al-Homedawy">
		<meta name="keywords" content="news,summarize,simple,inquiry,inquire,latest">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
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
			<!-- Forums -->
			<a href="forums/index.php"><u>Forums</u></a>
			
			<!-- Contact Me -->
			<!--<a href="https://www.linkedin.com/in/hussainal" target="_blank"><u>Contact Me</u></a>-->
			
			<!-- Blog -->
			<a href="https://medium.com/@hussain.al" target="_blank"><u>Blog</u></a>
		</div>
		
		<!-- Menu -->
		<div class="menu">
			<!-- Menu image -->
			<div id="menu_icon_container">
				<a class="pull-left" href="#">
					<img id="menu_icon" src="images/messenger.png" width="50px" height="50px" />
					<span class="badge pull-right"></span>
				</a>
			</div>
			
			<!-- Latest messages -->
			<div class="latest_messages container">
				<div class="row">
					<div class="col-md-3">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="glyphicon glyphicon-comment"></span> Latest Article Messages    
								<div class="btn-group pull-right">
									<button type="button" class="close_latest close" data-dismiss="modal">&times;</button>
								</div>
							</div>
							<div class="panel-body">
								<ul class="latest_chat">   
								</ul>
							</div>
							<div class="panel-footer">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Logo -->
		<div class="logo" align="center">
			<img id="logo_img" src='images/rumijitLogo.gif' width='300px' height='200px' />
		</div>
		
		<!-- Weather -->
		<div class="weather" align="center">
			<h4 id="weather_text"></h2>
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
			
			<!-- Search button -->
			<button class="btn btn-primary btn-sm" id="search_button" type="button">Search</button>
			
			<!-- Latest News button -->
			<button class="search_latest_news btn btn-danger btn-sm" type="button">Latest News</button>
			
			<!-- Local News button -->
			<button class="search_local_news btn btn-warning btn-sm"  type="button">Local News</button>
		</div>
		
		<!-- Summarize an individual article -->
		<div class="single_article_intro" align="center">
			<h3 id="introduction_text">or summarize a single article</h3>
		</div>
		
		<div class="single_article_class" style="margin-top: 5px;" align="center">
			<!-- Search icon -->
			<img class="search_icon" src='images/newspaper.png' width="30" height="30" />
			
			<!-- Search text -->
			<input id="single_article_query" type="text" placeholder="Ex: http://google.ca" />
			
			<!-- Search button -->
			<button class="btn btn-primary btn-sm" id="single_article_button" type="button">Summarize</button>
		</div>
		
		<!-- Loading message -->
		<div class="loading_message" align="center">
			<h2 id="loading_message_text">Give us a moment while we search the web!</h2>
		</div>
		
		<!-- Common searches -->
		<div class="common_searches" align="center">			
			<h4>People searched for...</h4>
			
			<!-- Trump -->
			<a href="#" id="search_trump"><u>Trump</u></a>
						
			<!-- Russia -->
			<a href="#" id="search_russia"><u>Russia</u></a>
			
			<!-- Israel -->
			<a href="#" id="search_israel"><u>Israel</u></a>
			
			<!-- United States -->
			<a href="#" id="search_united_states"><u>United States</u></a>
			
			<!-- Tesla -->
			<a href="#" id="search_tesla"><u>Tesla</u></a>
			
			<!-- Islam -->
			<a href="#" id="search_islam"><u>Islam</u></a>
			
			<!-- Syria -->
			<a href="#" id="search_syria"><u>Syria</u></a>
			
			<!-- Bernie Sanders -->
			<a href="#" id="search_putin"><u>Putin</u></a>
			
			<!-- Obama -->
			<a href="#" id="search_obama"><u>Obama</u></a>
			
			<!-- Sports -->
			<a href="#" id="search_sports"><u>Sports</u></a>
		</div>
		
		<!--
		<footer>
			<p class="text-muted">
				Content &copy; 2016 &nbsp;RumijIt. All Rights Reserved &nbsp; &nbsp;
			</p>
		</footer> -->
		
		<!-- Restart the session -->
		<?php
			// Turn off all error reporting
			error_reporting(0);

			session_unset();
			session_destroy();
		?>
		
		<!-- Search results -->
		<div id="search_query_results" width="100%" height="100%" />
	</body>
</html>