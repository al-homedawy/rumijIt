$(function(){
	$(".search_summary").hide ();
	$("#search_query_results").hide ();
	$(".loading_message").hide ();
	
	$("#search_query_results").load ( function () {
		$(".loading_message").hide ();
		$("#search_query_results").show ();
	});
	
	$("#search_query").on ( "input", function (event) {
		// Obtain the latest text
		var text = $(this).val ();
		
		if ( text.length > 0 ) {
			$.ajax ( {
				url: "scripts/search_suggestions.php?search=" + text,
				success: function ( response ) {
					$("#search_suggestions").empty ();
					
					while ( response.indexOf(",") != -1 ) {
						var index = response.indexOf(",");
						var str = response.substring(0, index);
						response = response.substring(index + 1, response.length);
						$("#search_suggestions").append ( "<option value='" + str + "'>" );
					}
					
					$("#search_query").fadeOut(10, function() {
						$("#search_query").fadeIn(10, function () {
							$("#search_query").focus();
							$("#search_query").val($("#search_query").val());
						});					
					});
				}
			});
		}
	});		
	
	$("#search_query").keypress ( function (e) {
		if ( e.keyCode == 13 ) {
			$("#search_button").click ();
		}
	});
	
	$("#search_button").click ( function () {
		$(".loading_message").show ();
		$("#search_query_results").hide ();
		
	    // Hide the introduction
		$(".introduction").hide ();
		$(".single_article_intro").hide ();
		$(".single_article_class").hide ();
		
		// Reposition the search bar 
		$(".search_class").attr("style", "top: 5%; left: 10%;");
		
		// Obtain the search query
		var search_query = $("#search_query").val ();
		search_query = search_query.replace ( " ", "%20" );
		
		// Display the results
		$("#search_query_results").attr ( "src", "search_result.php?search=" + search_query );
   } );
   
   $("#single_article_button").click ( function () {	
		$(".loading_message").show ();
   
		// Hide the introduction
		$(".introduction").hide ();
		$(".single_article_intro").hide ();
		$(".single_article_class").hide ();
		
		// Reposition the search bar 
		$(".search_class").attr("style", "top: 5%; left: 10%;");
		
		// Obtain the search query
		var search_query = $("#single_article_query").val ();
		search_query = search_query.replace ( " ", "%20" );
		
		// Display the results
		$("#search_query_results").show ();
		$("#search_query_results").attr ( "src", "search_result.php?url=" + search_query );
   });
   
   $(".search_image").click ( function () {	   
		// Hide the image
		$(this).fadeToggle ("fast", function () {
			// Display the summary
			$(this).parent().children(".search_summary").fadeIn ();
		});
   } );
   
   $(".search_image_generic").click ( function () {	   
		// Hide the generic image
		$(this).fadeToggle ("fast", function () {
			// Display the summary
			$(this).parent().children(".search_summary").fadeIn ();
		});
   } );

 }); 