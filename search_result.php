<?php
	// Start a session 
	session_start ();
?>
	
<!DOCTYPE HTML>
<html lang="en">
<html>
	<head>		
		<meta charset="utf-8">
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
		<!-- Facebook Share -->
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1554968898134554";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		
		<!-- Google+ -->
		<script src="https://apis.google.com/js/platform.js" async defer></script>


		<!-- Search for results -->
		<?php
			include 'scripts/extract_news.php';
			
			// Turn off all error reporting
			error_reporting(0);
			
			// Definitions
			define ( "MAX_SEARCH_RESULT", "5" );
			
			// Obtain an id if specified
			$id = -1;
			
			if ( isset ( $_GET["id"] ) ) {
				$id = $_GET["id"];
			}
					
			// Obtain the search query
			$query = $_GET["search"];
			
			// Restart the session
			if ( isset ( $_SESSION["query"] ) ) {
				if ( $query !== $_SESSION["query"] ) {
					session_unset();
					session_destroy();
					session_start ();
				}
			}
			
			$_SESSION["query"] = $query;
			
			// Setup our page
			$current_page = 0;
			
			if ( isset ( $_GET["current_page"] ) ) {
				$current_page = $_GET["current_page"];
			}
			
			// Setup our result
			$results = null;
			
			if ( isset ( $_SESSION["results"] ) ) {
				$results = $_SESSION["results"];
			}
			
			// Find the results if we haven't saved them
			if ( $current_page == 0 && $results == null ) {
				if ( $id != -1 ) {					
					$results = json_decode ( extractArticle ( $id ) );
				} else if ( !isset ($query) ) {
					$query = $_GET["url"];
					$news = new GoogleNews ( "", $query, "", "" );			
					$title = "";				
					summarizeArticle ( $news, $title );			
					$news->title = $title;
					$results = array ( $news );
					
					// We don't start a session here
					session_unset();
					session_destroy();
				} else {			
					// Parse results
					$results = json_decode ( extractNews ( $query ) );
					$_SESSION["results"] = $results;
				} 
			} 
			
			// Calculate total results
			for ( $i = 0; $i < count ( $results ); $i ++ ) {
				if ( count ( json_decode ( $results[$i]->summary ) ) > 0 ) {
					$maximum = $maximum + 1;
				}
			}
			
			// Display results
			if ( $maximum > 5 ) {
				echo "<h4>About " . $maximum . " results</h4>" . "<br>";
			}
		?>
		
		<!-- Display the search results -->
		<div class="search_results container-fluid">
			<?php
				function displayArticleInformation ($i) {
					global $results;
					
					// Display the article image
					echo "<td class='search_image' style='width: 70%;'>";
						if ( strlen($results[$i]->thumbnail) > 0 ) {
							echo "<img class='search_image_src img-rounded' title='Click on the image for a summary!' src='" . $results[$i]->thumbnail . "'/>";
						} else {						
							echo "<h2 style='text-align: center;'>" . $results[$i]->title . "</h2>";
							echo "<p style='text-align: center; font-size: 16px;'><kbd>Click over here to read the description!</kbd></p>";
						}						
						
					echo "</td>";
					
					// Display the article summary						
					echo "<td class='search_summary jumbotron' style='width: 70%;'>";													
						echo "<ul>";
							$summary = json_decode ( $results[$i]->summary );
							
							for ( $j = 0; $j < count ($summary); $j ++ ) {
								echo "<li>" . $summary[$j] . "</li>";
							}
						echo "</ul>";							
					echo "</td>";
				}
				
				function displayArticlePortfolio ($i) {
					global $results;
					
					// Display the article portfolio
					echo "<td class='search_portfolio jumbotron text-center' style='width: 30%;'>";											
						// Title
						echo "<h4 style='text-align: center;'>" . $results[$i]->title . "</h4>";						
						echo "<hr>";
						
						// Date
						echo "<p style='text-align: center;'>" . $results[$i]->date . "</p>";
						
						// View
						echo "<a id='search_view' class='btn btn-success' role='button' href='" . $results[$i]->url . "' target='_blank'>Click here to view original article</a>";
						
						echo "<table class='share_button' align='center'>";						
							echo "<td align='center'>";
								// Share on Facebook
								echo "<div class='fb-share-button' data-href='" . $results[$i]->url . "' data-layout='button'></div>";
							echo "</td>";
							
							echo "<td align='center'>";
								// Share on Twitter
								echo "<a href='https://twitter.com/share' class='twitter-share-button' data-url='" . $results[$i]->url . "'>Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
							echo "</td>";
							
							echo "<td align='center'>";
								echo "<div style='margin-top: 5px;'>";
									// Share on Google+
									echo "<g:plus count='false' action='share' href='" . $results[$i]->url . "'></g:plus>";
								echo "</div>";
							echo "</td>";						
						echo "</table>";
						
						// Report a summary
						echo "<a href='#' class='report_summary' article_id='" . $results[$i]->id . "'><u>Report this article</u></a>";
						
					echo "</td>";
				}
				
				function displayResults ( $start ) {
					global $results, $current_page;
					
					$start = $start * MAX_SEARCH_RESULT;					
					$end = $start + MAX_SEARCH_RESULT;
					
					if ( $end > count ( $results ) ) {
						$end = count ( $results );
					}
					
					$i = $start;
					
					while ( $start < $end ) {								
						if ( $i > count ( $results ) ) {
							break;
						}
						
						if ( count ( json_decode ( $results[$i]->summary ) ) > 0 ) {	
							$start = $start + 1;
							
							echo "<div class='search_information table-responsive' align='center'>";
								
								echo "<table class='search_table' style='width: 75%'>";
								
									if ( $i % 2 == 0 ) {
										displayArticleInformation ($i);
										displayArticlePortfolio ($i);
									} else {
										displayArticlePortfolio ($i);
										displayArticleInformation ($i);
									}
									
								echo "</table>";
								
								// Display a chatbox for RSS feeds only
								if ( $results[$i]->google_chat == false ) {		
									// Chatbox 
									echo "<div class='chat_form container-fluid col-lg-6 col-lg-offset-3 text-center' align='center' article_id='" . $results[$i]->id . "'>";
										echo "<div class='row'>";
											echo "<div>";
												
												echo "<div class='panel panel-primary'>";
													echo "<div class='panel-heading'>";
														echo "<span class='glyphicon glyphicon-comment'></span> " . $results[$i]->title;               
													echo "</div>";
													echo "<div class='panel-body'>";
														echo "<ul class='chat'>";
														echo "</ul>";
													echo "</div>";
													echo "<div class='panel-footer'>";
														echo "<input id='message_text' type='text' class='form-control input-sm' placeholder='Type your message here...' style='width: 100%;' />";
													echo "</div>";
												echo "</div>";
											echo "</div>";
										echo "</div>";
									echo "</div>";	
								}
								
							echo "</div>";
						}
						
						$i = $i + 1;
					}
					
					$offset = (int) ( ($i - $start) / MAX_SEARCH_RESULT );
					$current_page = $current_page + $offset;
				}
				
				// Display the current results
				displayResults ( $current_page );
							
				// Display the next result
				if ( $maximum > MAX_SEARCH_RESULT ) {
					echo "<div class='table-responsive' align='center'>";								
						echo "<table class='page_results' style='width: 75%'>";						
							if ( $current_page > 0 ) {
								$previous_page = $current_page - 1;
								echo "<td><a id='previous_result' data-page='" . $previous_page . "' href='#' style='float: left;'><u>Previous</u></a></td>";
							}
							
							$max = ($maximum / MAX_SEARCH_RESULT) - 1;
							
							if ( $current_page < $max ) {
								$next_page = $current_page + 1;							
								echo "<td><a id='next_result' data-page='" . $next_page . "' href='#' style='float: right;'><u>Next</u></a></td>";
							}
							
						echo "</table>";
					echo "</div>";
				}
				
				//echo "<div class='search_status alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> You have <strong>" . $maximum . "</strong> results</div>";
			?>			
		</div>
	</body>

</html>