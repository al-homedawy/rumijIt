$(function(){	
	$(".search_summary").hide ();
	$(".loading_message").hide ();
	$("#search_query").focus ();
	
	setInterval(function() {
		if ( $(".loading_message").is(":visible") ) {
			$("#loading_message_text").text("." + $("#loading_message_text").text() + ".");
		}
    }, 1500);

	
	if ( $("#search_query_results").html ().length < 10 ) {
		$(".search_icon").hide ();
	}
	
	$(".search_icon").click ( function () {
		location.reload ();
	});
		
	$("#search_query").on ( "input", function (event) {
		// Obtain the latest text
		var text = $(this).val ();
		
		if ( text.length > 0 ) {
			$.ajax ( {
				url: "scripts/search_suggestions.php?search=" + text,
				cache: false,
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
			$("#search_query").blur ();
		}
	});
	
	$("#single_article_query").keypress ( function (e) {
		if ( e.keyCode == 13 ) {
			$("#single_article_button").click ();
			$("#single_article_query").blur ();
		}
	});
	
	$(".logo").click ( function () {
		location.reload ()
	} );
	
	$("#search_button").click ( function () {
		$(".search_latest_news").hide ();
		$(".logo").hide ();
		$(".common_searches").hide ();
		$("#loading_message_text").text ("Give us a moment while we search the web!");
		$(".search_icon").show ();
		$(".loading_message").show ();
		$("#search_query_results").empty();
		
	    // Hide the introduction
		$(".introduction").hide ();
		$(".single_article_intro").hide ();
		$(".single_article_class").hide ();
		
		// Reposition the search bar 
		$(".search_class").removeAttr("style");
		$(".search_class").appendTo(".navbar");
		$(".search_class").attr("class", "search_class_new");
		$(".search_class_new").attr("style", "margin: 5px; float: left;");
		
		// Obtain the search query
		var search_query = $("#search_query").val ();
		search_query = search_query.replace ( " ", "%20" );
		
		// Display the results
		$.ajax ( {
				url: "search_result.php?search=" + search_query,
				cache: false,
				success: function ( response ) {
					$(".loading_message").hide ();
					$("#search_query_results").empty().append ( response );
				}
		} );
   } );
   
   $("#single_article_button").click ( function () {
	    $(".search_latest_news").hide ();
	    $(".logo").hide ();
		$(".common_searches").hide ();
		$("#loading_message_text").text ("Give us a moment while we read the article!");
		$(".search_icon").show ();
		$(".loading_message").show ();
		$("#search_query_results").empty();
   
		// Hide the introduction
		$(".introduction").hide ();
		$(".single_article_intro").hide ();
		$(".search_class").hide ();
		
		// Reposition the search bar 
		$(".single_article_class").removeAttr("style");
		$(".single_article_class").appendTo(".navbar");
		$(".single_article_class").attr("class", "single_article_class_new");
		$(".single_article_class_new").attr("style", "margin: 5px; float: left;");
		
		// Obtain the search query
		var search_query = $("#single_article_query").val ();
		search_query = search_query.replace ( " ", "%20" );
		search_query = search_query.replace ( "http://", "" );
		search_query = search_query.replace ( "https://", "" );
		
		// Display the results
		$.ajax ( {
				url: "search_result.php?url=" + search_query,
				cache: false,
				success: function ( response ) {
					$(".loading_message").hide ();
					$("#search_query_results").empty().append ( response );
				}
		} );
   });
   
   $(".search_summary").click ( function () {	   
		// Hide the image
		$(this).fadeOut ("fast", function () {
			// Display the summary
			$(this).parent().children(".search_image").fadeIn ();
			$(this).parent().children(".search_image_generic").fadeIn ();
		});
   } );
   
   $(".search_image").click ( function () {	   
		// Hide the image
		$(this).fadeOut ("fast", function () {
			// Display the summary
			$(this).parent().children(".search_summary").fadeIn ();
		});
   } );
   
   $(".search_image_generic").click ( function () {	   
		// Hide the generic image
		$(this).fadeOut ("fast", function () {
			// Display the summary
			$(this).parent().children(".search_summary").fadeIn ();
		});
   } );
   
   $(".search_latest_news").click ( function () {
	   $("#search_query").val ("");
	   $("#search_button").click ();
   } );
   
   $("#search_tesla").click ( function () {
	   $("#search_query").val ("tesla");
	   $("#search_button").click ();
   } );
   
   $("#search_islam").click ( function () {
	   $("#search_query").val ("islam");
	   $("#search_button").click ();
   } );

   $("#search_syria").click ( function () {
	   $("#search_query").val ("syria");
	   $("#search_button").click ();
   } );
   
   $("#search_trump").click ( function () {
	   $("#search_query").val ("trump");
	   $("#search_button").click ();
   } );
   
   $("#search_obama").click ( function () {
	   $("#search_query").val ("obama");
	   $("#search_button").click ();
   } );
   
   $("#search_sports").click ( function () {
	   $("#search_query").val ("sports");
	   $("#search_button").click ();
   } );
   
   $("#search_united_states").click ( function () {
	   $("#search_query").val ("United States");
	   $("#search_button").click ();
   } );
   
   $("#search_israel").click ( function () {
	   $("#search_query").val ("Israel");
	   $("#search_button").click ();
   } );
   
   $("#search_russia").click ( function () {
	   $("#search_query").val ("Russia");
	   $("#search_button").click ();
   } );
   
   $("#search_putin").click ( function () {
	   $("#search_query").val ("Putin");
	   $("#search_button").click ();
   } );
   
   $("#previous_result").click ( function () {
	   var current_page = $("#previous_result").attr ( "data-page" );
	   
	   // Obtain the search query
		var search_query = $("#search_query").val ();
		search_query = search_query.replace ( " ", "%20" );
		
		// Display the results
		$.ajax ( {
				url: "search_result.php?search=" + search_query + "&current_page=" + current_page,
				cache: true,
				success: function ( response ) {
					$("#search_query_results").empty().append ( response );
				}
		} );
   } );
   
   $("#next_result").click ( function () {	   
	   var current_page = $("#next_result").attr ( "data-page" );
	   
	   // Obtain the search query
		var search_query = $("#search_query").val ();
		search_query = search_query.replace ( " ", "%20" );
		
		// Display the results
		$.ajax ( {
				url: "search_result.php?search=" + search_query + "&current_page=" + current_page,
				cache: true,
				success: function ( response ) {
					$("#search_query_results").empty().append ( response );
				}
		} );
   } );
 }); 