<?php
	$dev = false;

	if ($dev){
		$pages = 1;
		$per_page = 5;//up to 50
		$cache_minutes = 0;
	}else{
		$pages = 10;
		$per_page = 30;//up to 50
		$cache_minutes = 5;
	}


	if (isset($_GET['player'])){
		$sourceApi = "http://api.dribbble.com/players/".$_GET['player']."/shots";
		$cachefile = "cache/player-".$_GET['player'].".js";
	}else if(isset($_GET['stream'])){
		$sourceApi = "http://api.dribbble.com/players/".$_GET['stream']."/shots/following";
		$cachefile = "cache/stream-".$_GET['stream'].".js";
	}else{
		$sourceApi = "http://api.dribbble.com/shots/popular";
		$cachefile = "cache/popular.js";
	}



	$cachetime = $cache_minutes * 60;
	// Serve from the cache if it is younger than $cachetime
	if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
	    include($cachefile);
	    //echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
	    exit;
	}
	ob_start(); // Start the output buffer



	// API calls
	$shots = array();
	for ($i=1;$i<=$pages;$i++){		
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
	shuffle($shots);
	echo json_encode($shots);




	// Cache the output to a file
	$fp = fopen($cachefile, 'ws');
	fwrite($fp, ob_get_contents());
	fclose($fp);
	ob_end_flush(); // Send the output to the browser






?>