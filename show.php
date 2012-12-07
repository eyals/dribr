<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Dribbble Slideshow</title>
		<link href='http://fonts.googleapis.com/css?family=Exo:400,700' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	</head>
	<body>
	<div id="shot"></div>
	<div id="standbyShot"></div>
	<div id="meta">
		<h1></h1>
		<div id="counts">
			<span id="count_views"></span>
			<span id="count_likes"></span>
			<span id="count_comments"></span>
		</div>
	</div>
	<div id="user">
		<img id="avatar"/>
		<div id="name"></div>
		<div id="location"></div>
	</div>
	<style>
		img {border:none;}
		body{margin:0; background-color:black; font-family: 'Exo', sans-serif;}
		#shot, #standbyShot{
			background:url(cover.png) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		width:100%; height:100%;position:fixed; left:0; top:0;}
		#shot{z-index:10;}
		#astandbyShot{visibility:hidden; width:0; height:0;}
		#meta, #user{position:absolute; z-index:20; left:0; background-color:rgba(0,0,0,0.7); color:white;cursor:pointer; display:none;} 
		#meta{bottom:0; padding:5px 8px} 
		#meta h1{margin:0; padding:0;font-size:30px;font-weight:normal;}
		#counts {opacity:0.6; font-size:14px;font-weight:bold;}
		#counts span{background-repeat:no-repeat; margin-right:10px; padding-left:18px;background-position:left 2px;}
		#count_views{background-image:url('icon_views.png');}
		#count_likes{background-image:url('icon_likes.png');}
		#count_comments{background-image:url('icon_comments.png');}
		#user{min-height:50px; top:0; padding:5px}
		#avatar{position:absolute; left:5px; top:5px; width:50px; height:50px; border:1px solid #666;}
		#name, #location {margin-left:55px; }
		#name {font-size:16px; font-weight:bold;}
		#location{font-size:14px; opacity:0.8}
		
		
	</style>
<script>
<?php
	$pages = 5;
	$per_page = 50;//up to 50
	$shots = array();
	for ($i=1;$i<=$pages;$i++){
		if (isset($_GET['player'])){
			$sourceApi = "http://api.dribbble.com/players/".$_GET['player']."/shots";
		}else if(isset($_GET['stream'])){
			$sourceApi = "http://api.dribbble.com/players/".$_GET['stream']."/shots/following";
		}else{
			$sourceApi = "http://api.dribbble.com/shots/popular";
		}
		
		$results = json_decode(file_get_contents($sourceApi."?per_page=".$per_page."&page=".$i));
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
	$('#count_views').text(nextShot.views);
	$('#count_likes').text(nextShot.likes);
	$('#count_comments').text(nextShot.comments);
	$('#avatar').attr('src',nextShot.player.avatar);
	$('#name').text(nextShot.player.name);
	$('#location').text(nextShot.player.location);
	
	$('#meta').fadeIn().click(function(){
		window.open(nextShot.url);
	});
	$('#user').fadeIn().click(function(){
		window.open(nextShot.player.url);
	});
}

function setShotsSize(){
	$('#shot').css({width:window.width,height:window.height});
}
</script>

</body>
</html>