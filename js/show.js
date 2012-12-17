
var delay = 6;//seconds

var shots;
var totalShots;
$.getJSON('/shotsdata.php'+dataApi,function(data){
	shots = data;
	totalShots = shots.length;
	console.log(shots);
	changeImage();
	setInterval(changeImage,delay*1000);
});



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

var nextImageIndex;
function setNextShot(){
	nextImageIndex = Math.floor(Math.random() * totalShots)
	var nextShotUrl = shots[nextImageIndex].image;
	$('#standbyShot').css("background-image", 'url('+nextShotUrl+')');
}


function setImageMeta(){
	if(nextImageIndex==undefined) return;
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
/*
function setShotsSize(){
	$('#shot').css({width:window.width,height:window.height});
}*/