<!DOCTYPE html>
<html lang="en">
<head>
	<title>DRIBR - Inspirational dribbble slideshow for designers</title>
	<meta name="description" value="Get today's dribbble popular shots, or those of the dribbble players you follow, presented to you in full screen slideshow."/>
	<!--link href="css/bootstrap.min.css" rel="stylesheet" media="screen"-->
	<link rel="stylesheet" tyle="text/css" href="css/start.css"/>
	<link href='http://fonts.googleapis.com/css?family=Exo:400,700' rel='stylesheet' type='text/css'>
	<!--script type="text/javascript" src="js/bootstrap.min.js"></script-->
	<!--script type="text/javascript" src="js/start.js"></script-->
</head>
<body>

	<div id="wrapper">
		<header>
			<img src="img/logo-dribr.png"/>
			<h2>Inspirational dribbble slideshow for designers</h2>
		<div id="tip">
			Tip: Run dribr on an unused PC or tablet in your studio for constant dribbble inspiration
		</div>
		</header>
		<div id="options">
			<form class="startOption" name="f_popular">
				<img src="img/option_icon_popular.png"/>
				<div class="frm">
					Today's popular shots
				</div>
				<button type="submit" class="btn">Play</button>
			</form>
			<form class="startOption" name="f_player">
				<img src="img/option_icon_player.png"/>
				<div class="frm">
					Shots by
					<input type="text" placeholder="Player Username"/>
				</div>
				<button type="submit" class="btn">Play</button>
			</form>
			<form class="startOption" name="f_stream">
				<img src="img/option_icon_stream.png"/>
				<div class="frm">
					Followed by
					<input type="text" placeholder="Player Username"/>
				</div>
				<button type="submit" class="btn">Play</button>
			</form>
		</div>
		<footer>
			By <a href="http://shahar.co.il">Eyal Shahar</a>  |  Like
		</footer>
	</div>


	<?php require_once('analytics.php'); ?>

</body>

