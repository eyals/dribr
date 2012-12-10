<?php
	$pages = 10;
	$per_page = 5;//up to 50
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
	echo json_encode($shots);
?>