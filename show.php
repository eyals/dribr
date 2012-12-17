<?php
	if (isset($_GET['player'])){
		$title="Dribbble shots by ".$_GET['player']." - dribr.com";
		$dataApi = "?player=".$_GET['player'];
	}else if(isset($_GET['stream'])){
		$title="Dribbble shots that ".$_GET['stream']." follow - dribr.com";
		$dataApi = "?stream=".$_GET['stream'];
	}else{
		$title="Popular Dribbble shots - dribr.com";
		$dataApi = "";
	}
?>
<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $title?></title>
		<link href='http://fonts.googleapis.com/css?family=Exo:400,700' rel='stylesheet' type='text/css'>
		<link href='/css/show.css' rel='stylesheet' type='text/css'>
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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>var dataApi = "<?php echo $dataApi; ?>"</script>
<script type="text/javascript" src="/js/show.js"></script>
<?php require_once('analytics.php'); ?>

</body>
</html>