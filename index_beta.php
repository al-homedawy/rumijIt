<html>
	<head>
		<title>Index</title>
	</head>
	
	<body>
		<h1>News</h1>		
		
		<?php
			include 'extract_news.php';
			
			$search = $_GET["search"];
			
			// Search for news 
			$results = json_decode ( extractNews ( $search ) );
			
			// Display the news
			$count = count ( $results );
			
			for ( $i = 0; $i < $count; $i ++ ) {
				echo "<b>" . $results[$i]->title . "</b>" . "   - " . $results[$i]->date . "<br><br>";
				echo "<a href='" . $results[$i]->url . "'>Article</a><br><br>";
								
				$summary = json_decode($results[$i]->summary);
				
				for ( $j = 0; $j < count ( $summary ); $j ++ ) {					
					echo $summary[$j] . "<br><br>";
				}
				echo "<img src='" . $results[$i]->thumbnail . "' />" . "<br>";
			}
		?>
	</body>
</html>