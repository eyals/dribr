<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Dribbble Slideshow</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	</head>
	<body>
	<div id="shot"></div>
	<div id="standbyShot"></div>
	<style>
		body{margin:0; background-color:blue}
		#shot, #standbyShot{
			background:url(cover.png) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		width:100%; height:100%;position:fixed; left:0; top:0;}
		#shot{z-index:10;}
		#astandbyShot{visibility:hidden; width:0; height:0;}
	</style>
<script>
<?php
	$pages = 1;
	$per_page = 2;//up to 50
	$shots = array();
	for ($i=1;$i<=$pages;$i++){
		$results = json_decode(file_get_contents("http://api.dribbble.com/shots/popular?per_page=".$per_page."&page=".$i));
		foreach ($results->shots as $shot){

			$newShot;
			$newShot['image'] = $shot->image_url;
			$newShot['title'] = $shot->title;
			$newShot['likes'] = $shot->likes_count;
			$newShot['comments'] = $shot->comments_count;
			$newShot['views'] = $shot->views_count;
			$newShot['url'] = $shot->short_url;
			
			$newShot['player']['avatar'] = $shot->player->avatar_url;
			$newShot['player']['name'] = $shot->player->name;
			$newShot['player']['location'] = $shot->player->location;
			array_push($shots,$newShot);
			
		}
	}
	echo "var shots = " . json_encode($shots) . ";";
?>

//console.log(shots);

var totalShots = shots.length;
setInterval(changeImage,6000);

function changeImage(){
	//setTimer(function(){},500);
	
	$('#shot').fadeOut(1000,function(){
			$(this).css("background-image", $('#standbyShot').css("background-image"));
			console.log($('#standbyShot').css("background-image"));
			$(this).show();
			setNextShot();
	});
	
}

function setNextShot(){
	var nextShotUrl = shots[Math.floor(Math.random() * totalShots)].image;
	$('#standbyShot').css("background-image", 'url('+nextShotUrl+')');
}
setNextShot();

function setShotsSize(){
	$('#shot').css({width:window.width,height:window.height});
}
</script>

</body>
</html>