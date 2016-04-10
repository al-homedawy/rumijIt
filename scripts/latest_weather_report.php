<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	$details = json_decode(file_get_contents("http://ipinfo.io/" . $ip . "/json"));
	
	$city=$details->city;
	$country=$details->country; 
	
	$url="http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=metric&cnt=7&lang=en&APPID=55365355710512fa774232c0164c3ef7";
	
	$json=file_get_contents($url);
	$data=json_decode($json,true);
	
	$temp = $data['main']['temp'];
	echo ucfirst ( $data['weather'][0]['description'] . " in " . $city . ", " . $temp . "&deg;" ) ;
?>
