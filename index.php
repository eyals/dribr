<!DOCTYPE html>
<html lang="en">
<head>
	<title>DRIBR - Inspirational dribbble slideshow for designers</title>
	<meta name="description" content="Get today's dribbble popular shots, or those of the dribbble players you follow, presented to you in full screen slideshow."/>
	<!--link href="css/bootstrap.min.css" rel="stylesheet" media="screen"-->
	<link rel="stylesheet" tyle="text/css" href="/css/start.css"/>
	<link href='http://fonts.googleapis.com/css?family=Exo:400,700' rel='stylesheet' type='text/css'>
	<link rel="image_src" href="http://dribr.com/img/icon.png" />
</head>
<body>


	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=217602848375251";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>


	<div id="wrapper">
		<header>
			<img src="img/logo-dribr.png"/>
			<h2>Inspirational dribbble slideshow for designers</h2>
				<div id="credit">
				By <a href="http://shahar.co.il">Eyal Shahar</a> | 
				<div class="fb-like" data-href="http://dribr.com" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false" data-font="lucida grande"></div>
			</div>
		</header>
		<div id="options">
			<form class="startOption" id="f_popular">
				<img src="img/option_icon_popular.png"/>
				<div class="frm">
					Today's popular shots
				</div>
				<button type="submit" class="btn">Play</button>
			</form>
			<form class="startOption" id="f_player">
				<img src="img/option_icon_player.png"/>
				<div class="frm">
					Shots by
					<input type="text" placeholder="Player Username" required/>
				</div>
				<button type="submit" class="btn">Play</button>
			</form>
			<form class="startOption" id="f_stream">
				<img src="img/option_icon_stream.png"/>
				<div class="frm">
					Followed by
					<input type="text" placeholder="Player Username" required/>
				</div>
				<button type="submit" class="btn">Play</button>
			</form>
		</div>
		<footer>

		<div id="tip">
			Tip: Run dribr on an unused PC or tablet in your studio for constant dribbble inspiration
		</div>
		<div id="disclaimer">
			Disclaimer: dribr is in no way associated or affiliated with dribbble.
		</div>

	

		</footer>
	</div>


	<?php require_once('analytics.php'); ?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<!--script type="text/javascript" src="js/bootstrap.min.js"></script-->
<script type="text/javascript" src="/js/start.js"></script>


</body>

