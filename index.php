<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Dribbble Slideshow</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	</head>
	<body>
	<img id="shot" src="cover.png"/><img id="standbyShot"/>
	<style>
		body{margin:0; background-color:black}
		#shot, #standbyShot{width:800px; height:600px;position:absolute; left:0; top:0;}
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
			$(this).attr("src", $('#standbyShot').attr("src"));
			$(this).show();
			setNextShot();
	});
	
}

function setNextShot(){
	$('#standbyShot').attr("src", shots[Math.floor(Math.random() * totalShots)]);
}
setNextShot();
</script>

</body>
</html>