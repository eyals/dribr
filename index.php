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
	$pages = 2;
	$per_page = 50;//up to 50
	$shots = array();
	for ($i=1;$i<=$pages;$i++){
		$results = json_decode(file_get_contents("http://api.dribbble.com/shots/popular?per_page=".$per_page."&page=".$i));
		foreach ($results->shots as $shot){
			array_push($shots,'"'.$shot->image_url.'"');
		}
	}
	echo "var shots = new Array(" . implode(",",$shots) . ");";
?>

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
	var nextShotUrl = shots[Math.floor(Math.random() * totalShots)];
	$('#standbyShot').css("background-image", 'url('+nextShotUrl+')');
}
setNextShot();

function setShotsSize(){
	$('#shot').css({width:window.width,height:window.height});
}
</script>

</body>
</html>