<!DOCTYPE HTML>
<html lang="en">
<html>

	<head>
		<title>QuickNews</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
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
		<!-- Search for results -->
		<?php
			include 'scripts/extract_news.php';
			
			// Turn off all error reporting
			error_reporting(0);
			
			// Obtain the search query
			$query = $_GET["search"];
			
			// Setup our result
			$results;
			
			if ( !isset ($query) ) {
				$query = $_GET["url"];
				$news = new GoogleNews ( "", $query, "", "" );			
				$title = "";				
				summarizeArticle ( $news, $title );			
				$news->title = $title;
				$results = array ( $news );
			} else {			
				// Parse results
				$results = json_decode ( extractNews ( $query ) );
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
							echo "<img class='search_image_src img-rounded' src='" . $results[$i]->thumbnail . "'/>";
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
					echo "<td class='search_portfolio jumbotron' style='width: 30%;'>";											
						// Title
						echo "<h4 style='text-align: center;'>" . $results[$i]->title . "</h4>";						
						echo "<hr>";
						
						// Date
						echo "<p style='text-align: center;'>" . $results[$i]->date . "</p>";
						
						// View
						echo "<a id='search_view' class='btn btn-success' role='button' href='" . $results[$i]->url . "' target='_blank'>Click here to view original article</a>";
					echo "</td>";
				}
				
				echo "<div class='search_status alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> You have <strong>" . count($results) . "</strong> results</div>";
				
				for ( $i = 0; $i < count ($results); $i ++ ) {
					if ( count ( json_decode ( $results[$i]->summary ) ) > 0 ) {
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
							
						echo "</div>";
					}
				}
			?>			
		</div>
	</body>

</html>