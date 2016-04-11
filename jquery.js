$(function(){	
	$(".search_summary").hide ();
	$(".loading_message").hide ();
	$(".search_query").focus ();
	$(".chat_form").hide ();
	$(".latest_messages").hide ();
	$("#menu_icon_container").fadeIn ();
		
	$.ajax ( {
		url: "scripts/latest_weather_report.php",
		cache: true,
		success: function ( response ) {
			$("#weather_text").append ( response );
		}
	} );
	
	var stopMoving = false;
	
	$("#search_query_results").on ( "mouseover", function () { 
		stopMoving = true;
	} );
	
	$("#search_query_results").on ( "mouseleave", function () { 
		stopMoving = false;
		menu_icon ();
	} );
	
	
	
	$("#menu_icon").click ( function () {
		$("#menu_icon_container").fadeOut ( 800, function () {
			$(".latest_messages").fadeIn ( 400, function () {
				
			});
		});
	});
	
	setInterval(function() {
		if ( $(".loading_message").is(":visible") ) {
			$("#loading_message_text").text("." + $("#loading_message_text").text() + ".");
		}
    }, 1500);
	
	setInterval(function() {
		$(".chat_form:visible").each( function () {
			var article_id = $(this).attr("article_id");
			var chatlog = $(this).find(".chat");
			refreshMessageList ( chatlog, article_id );
		} );		
    }, 5000);
	
	setInterval(function () {		
		// Refresh the latest messages
		$.ajax ( {
			url: "scripts/get_latest_messages.php",
			cache: false,
			success: function ( response ) {
				var trimmedResponse = response.substr ( 1, response.length - 2 );
				var messages = new Array ();
				
				while ( trimmedResponse.search('",') != -1 ) {
					var text = trimmedResponse.substr(0, trimmedResponse.search('",') + 1);
					trimmedResponse = trimmedResponse.substr (trimmedResponse.search('",') + 2, trimmedResponse.length);
					messages.push(text);
				}
				
				messages.push(trimmedResponse);
				
				var latest_messages = $(".latest_messages").find(".latest_chat");
				var panelbody = latest_messages.parent ();
				var previous_scroll_height = panelbody.scrollTop ();
				
				latest_messages.empty ();
				
				messages = messages.reverse ();
				
				for ( i = 0; i < messages.length; i ++ ) {
					var trimmedQuotes = messages[i].substr ( 1, messages[i].length - 2 );
					var title = trimmedQuotes.substr ( 0, trimmedQuotes.search("---") );
					var id = trimmedQuotes.substr ( trimmedQuotes.search ("---") + 3, trimmedQuotes.length );
									
					var message = $("<li class='latest_message' article_id='" + id + "'><p class='latest_message' align='left'>" + title + "</p></li>");
					latest_messages.append ( message );
					
					message.click ( function () {
						var id = $(this).attr ( "article_id" );
						
						$.ajax ( {
							url: "search_result.php?id=" + id,
							cache: false,
							success: function ( response ) {
								$(".weather").hide ();
								$(".search_latest_news").hide ();
								$(".search_local_news").hide ();
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
								
								// Obtain the search query
								var search_query = $(".search_query").val ();
								
								// Reposition the search bar 
								$(".search_class").remove ();
								$(".search_class_new").remove ();
								var image_icon = $("<img class='search_icon' src='images/newspaper.png' width='30' height='30' />");
								image_icon.click ( function () {
									location.reload ()
								} );
								$(".navbar").append ( "<div class='search_class_new' style='margin-left: 5px; float: left; margin-top: 5px;' align='center'></div>" );
								$(".search_class_new").append ( image_icon );
								$(".search_class_new").append ( "<input class='search_query' type='text' placeholder='Ex: Trump' list='search_suggestions'><datalist id='search_suggestions'></datalist></input><button class='btn btn-primary btn-sm' id='search_button' type='button'>Search</button>");
								$(".search_query").val ( search_query );
		
								$(".loading_message").hide ();
								$("#search_query_results").empty().append ( response );
								stopMoving = true;
							}
						} );
					});					
				}
				
				$(".badge").empty ();
				$(".badge").append ( messages.length );
				
				// Scroll to the bottom
				var panelbody = latest_messages.parent ();
				panelbody.scrollTop(previous_scroll_height);
			}
		} );
	}, 5000);
	
	function refreshMessageList (chatlog, article_id) {
		// Refresh the message list
		$.ajax ( {
			url: "scripts/extract_article_messages.php?id=" + article_id,
			cache: false,
			success: function ( response ) {
				var trimmedResponse = response.substr(1, response.length - 2 );
				var messages = new Array ();
				
				while ( trimmedResponse.search('",') != -1 ) {
					var text = trimmedResponse.substr(0, trimmedResponse.search('",') + 1);
					trimmedResponse = trimmedResponse.substr (trimmedResponse.search('",') + 2, trimmedResponse.length);
					messages.push(text);
				}
				
				messages.push(trimmedResponse);
				
				// Clear the chat
				chatlog.empty ();
				
				// Add messages
				for ( i = 0; i < messages.length; i ++ ) {
					chatlog.append ( "<li><p align='left'>" + messages [i].substr(1, messages[i].length - 2) + "</p></li>" );
				}				
				
				// Scroll to the bottom
				var panelbody = chatlog.parent ();
				panelbody.scrollTop(panelbody.prop("scrollHeight"));
			}
		} );
	}	
	
	if ( $("#search_query_results").html ().length < 10 ) {
		$(".search_icon").hide ();
	}
	
	$(".search_icon").click ( function () {
		location.reload ();
	});
	
	$(".search_local_news").click ( function () {
		$.ajax ( {
			url: "scripts/extract_location_from_ip.php",
			cache: false,
			success: function ( response ) {
				$(".search_query").val ( "Latest News in " + response );
				$("#search_button").click ();
			}
		});
	});
	
	var previousText = $(".search_query").val ();
		
	setInterval(function () {	
		// Obtain the latest text
		var text = $(".search_query").val ();
		
		if ( text.length > 0 && previousText != text ) {
			$.ajax ( {
				url: "scripts/search_suggestions.php?search=" + text,
				cache: false,
				success: function ( response ) {
					previousText = text;
					$("#search_suggestions").empty ();
					
					while ( response.indexOf(",") != -1 ) {
						var index = response.indexOf(",");
						var str = response.substring(0, index);
						response = response.substring(index + 1, response.length);
						$("#search_suggestions").append ( "<option value='" + str + "'>" );
					}
					
					$(".search_query").fadeOut(10, function() {
						$(".search_query").fadeIn(10, function () {
							$(".search_query").focus();
							$(".search_query").val($(".search_query").val());
						});					
					});
				}
			});
		}
	}, 500);		
		
	$(".search_query").keypress ( function (e) {		
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
		$(".weather").hide ();
		$(".search_latest_news").hide ();
		$(".search_local_news").hide ();
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
		
		// Obtain the search query
		var search_query = $(".search_query").val ();
		
		// Reposition the search bar 
		$(".search_class").remove ();
		$(".search_class_new").remove ();
		var image_icon = $("<img class='search_icon' src='images/newspaper.png' width='30' height='30' />");
		image_icon.click ( function () {
			location.reload ()
		} );
		$(".navbar").append ( "<div class='search_class_new' style='margin-left: 5px; float: left; margin-top: 5px;' align='center'></div>" );
		$(".search_class_new").append ( image_icon );
		$(".search_class_new").append ( "<input class='search_query' type='text' placeholder='Ex: Trump' list='search_suggestions'><datalist id='search_suggestions'></datalist></input><button class='btn btn-primary btn-sm' id='search_button' type='button'>Search</button>");
		$(".search_query").val ( search_query );
		
		search_query = search_query.replace ( " ", "%20" );
		
		// Display the results
		$.ajax ( {
				url: "search_result.php?search=" + search_query,
				cache: false,
				success: function ( response ) {
					$(".loading_message").hide ();
					$("#search_query_results").empty().append ( response );
					stopMoving = true;
				}
		} );
   } );
   
   $("#single_article_button").click ( function () {
	    $(".weather").hide ();
		$(".search_latest_news").hide ();
		$(".search_local_news").hide ();
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
		
		// Obtain the search query
		var search_query = $("#single_article_query").val ();
		
		// Reposition the search bar 
		$(".single_article_class").remove ();
		$(".single_article_class_new").remove ();
		var image_icon = $("<img class='search_icon' src='images/newspaper.png' width='30' height='30' />");
		image_icon.click ( function () {
			location.reload ()
		} );
		$(".navbar").append ( "<div class='single_article_class_new' style='margin-left: 5px; float: left; margin-top: 5px;' align='center'>");
		$(".single_article_class_new").append ( image_icon );
		$(".single_article_class_new").append ( "<input id='single_article_query' type='text' placeholder='Ex: http://google.ca' /><button class='btn btn-primary btn-sm' id='single_article_button' type='button'>Summarize</button></div>");
		$("#single_article_query").val ( search_query );
		
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
					stopMoving = true;
				}
		} );
   });
   
   $(".search_summary").click ( function () {	   
		// Hide the image
		$(this).fadeOut ("fast", function () {
			// Display the summary
			$(this).parents(".search_information").children ( ".chat_form" ).hide(); 
			$(this).parent().children(".search_image").fadeIn ();
			$(this).parent().children(".search_image_generic").fadeIn ();			
		});
   } );
   
   $(".search_image").click ( function () {	   
		// Hide the image
		$(this).fadeOut ("fast", function () {
			// Display the summary
			$(this).parent().children(".search_summary").fadeIn ();			
			$(this).parents(".search_information").children ( ".chat_form" ).show ();
			
			var article_id = $(this).parents(".search_information").children(".chat_form").attr("article_id");
			var chatlog = $(this).parents(".search_information").children(".chat_form").find(".chat");
			refreshMessageList ( chatlog, article_id );
		});
   } );
   
   $(".search_latest_news").click ( function () {
	   $(".search_query").val ("");
	   $("#search_button").click ();
   } );
   
   $("#search_tesla").click ( function () {
	   $(".search_query").val ("tesla");
	   $("#search_button").click ();
   } );
   
   $("#search_islam").click ( function () {
	   $(".search_query").val ("islam");
	   $("#search_button").click ();
   } );

   $("#search_syria").click ( function () {
	   $(".search_query").val ("syria");
	   $("#search_button").click ();
   } );
   
   $("#search_trump").click ( function () {
	   $(".search_query").val ("trump");
	   $("#search_button").click ();
   } );
   
   $("#search_obama").click ( function () {
	   $(".search_query").val ("obama");
	   $("#search_button").click ();
   } );
   
   $("#search_sports").click ( function () {
	   $(".search_query").val ("sports");
	   $("#search_button").click ();
   } );
   
   $("#search_united_states").click ( function () {
	   $(".search_query").val ("United States");
	   $("#search_button").click ();
   } );
   
   $("#search_israel").click ( function () {
	   $(".search_query").val ("Israel");
	   $("#search_button").click ();
   } );
   
   $("#search_sanders").click ( function () {
	   $(".search_query").val ("Sanders");
	   $("#search_button").click ();
   } );
   
   $("#search_putin").click ( function () {
	   $(".search_query").val ("Putin");
	   $("#search_button").click ();
   } );
   
   $("#previous_result").click ( function () {
	   var current_page = $("#previous_result").attr ( "data-page" );
	   
	   // Obtain the search query
		var search_query = $(".search_query").val ();
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
		var search_query = $(".search_query").val ();
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
   
   $(".chat_form").keypress ( function (e) {		
		if ( e.keyCode == 13 ) {
			var article_id = $(this).attr("article_id");
			var name = $(this).find("#name_text").val ();
			var message = $(this).find("#message_text").val ();
			var chatlog = $(this).find(".chat");
			
			if ( name.length > 0 ) {			
				// Reset variables
				$(this).find("#message_text").val ("");
				
				$.ajax ( {
					url: "scripts/post_message.php?id=" + article_id + "&name=" + name + "&message=" + message,
					cache: false,
					success: function ( response ) {
						refreshMessageList ( chatlog, article_id );
						
						$.ajax ( {
							url: "scripts/post_latest_messages.php?id=" + article_id + "&name=" + name,
							cache: false,
							success: function ( response ) {
								// Do nothing
							}
						} );
					}
				} );
			} else {
				alert ( "Please enter a name!" );
			}
		}
	});
	
	$(".report_summary").click ( function () {
		var article_id = $(this).attr ( "article_id" );
		var article = $(this).parents(".search_information");
		
		$.ajax ( {
				url: "scripts/report_bad_article.php?id=" + article_id,
				cache: false,
				success: function ( response ) {
					article.hide ();
				}
			} );
	} );
	
	$(".close_latest").click ( function () {
		$(".latest_messages").fadeOut ( 400, function () {
			$("#menu_icon_container").fadeIn ();
		});
	} );
 }); 