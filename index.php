<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Dribbble Slideshow</title>
		<link href='http://fonts.googleapis.com/css?family=Signika:700,400' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	</head>
	<body>
	<div id="shot"></div>
	<div id="standbyShot"></div>
	<div id="meta">
		<h1></h1>
		<div id="counts"></div>
	</div>
	<div id="user">
		<img id="avatar"/>
		<div id="name"></div>
		<div id="location"></div>
	</div>
	<style>
		img {border:none;}
		body{margin:0; background-color:blue; font-family: 'Signika', sans-serif;}
		#shot, #standbyShot{
			background:url(cover.png) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		width:100%; height:100%;position:fixed; left:0; top:0;}
		#shot{z-index:10;}
		#astandbyShot{visibility:hidden; width:0; height:0;}
		#meta, #user{position:absolute; z-index:20; top:0; background-color:rgba(0,0,0,0.7); color:white;} 
		#meta{min-height:50px; left:0; padding:5px 8px} 
		#meta h1{margin:0; padding:0;font-size:30px;font-weight:normal;}
		#counts {opacity:0.8; font-size:14px;font-weight:bold;}
		#user{height:50px; right:0; padding:5px}
		#avatar{position:absolute; right:5px; top:5px; width:50px; height:50px;}
		#name, #location {margin-right:60px; }
		#name {font-size:16px; font-weight:bold;}
		#location{font-size:14px; opacity:0.8}
		
		
	</style>
<script>
<?php
	$pages = 5;
	$per_page = 50;//up to 50
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
			$newShot['player']['url'] = $shot->player->url;
			array_push($shots,$newShot);
			
		}
	}
	echo "var shots = " . json_encode($shots) . ";";
?>

//console.log(shots);

var delay = 6;//seconds
setInterval(changeImage,delay*1000);

function changeImage(){
	//setTimer(function(){},500);
	
	$('#shot').fadeOut(1000,function(){
			$(this).css("background-image", $('#standbyShot').css("background-image"));
			console.log($('#standbyShot').css("background-image"));
			$(this).show();
			setImageMeta();
			setNextShot();
	});
	
}

var totalShots = shots.length;
var nextImageIndex;
function setNextShot(){
	nextImageIndex = Math.floor(Math.random() * totalShots)
	var nextShotUrl = shots[nextImageIndex].image;
	$('#standbyShot').css("background-image", 'url('+nextShotUrl+')');
}
setNextShot();

function setImageMeta(){
	var nextShot = shots[nextImageIndex];
	$('#meta h1').text(nextShot.title);
	$('#counts').html("V " + nextShot.views + " L " + nextShot.likes + " C " + nextShot.comments);
	$('#avatar').attr('src',nextShot.player.avatar);
	$('#name').text(nextShot.player.name);
	$('#location').text(nextShot.player.location);
	
	$('#shot').click(function(){
		window.open(nextShot.url);
	});
	$('#user').click(function(){
		window.open(nextShot.player.url);
	});
}

function setShotsSize(){
	$('#shot').css({width:window.width,height:window.height});
}
</script>

</body>
</html>