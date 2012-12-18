
var delay = 6;//seconds

var shots;
var totalShots;
var playInterval;
$.getJSON('/shotsdata.php'+dataApi,function(data){
	shots = data;
	totalShots = shots.length;
	console.log(shots);
	resume();
});



function changeImage(){
	//setTimer(function(){},500);
	$('#shot').fadeOut(1000,function(){
			$(this).css("background-image", $('#standbyShot').css("background-image"));
			if (nextImageIndex>-1) ;//console.log(nextImageIndex + ": " + shots[nextImageIndex].title);
			$(this).show();
			setImageMeta();
			setNextShot();
			
	});
	
}

var nextImageIndex = -1;
function setNextShot(){
	nextImageIndex ++;
	if (nextImageIndex==totalShots || nextImageIndex<0) nextImageIndex=0;
	var nextShotUrl = shots[nextImageIndex].image;
	$('#standbyShot').css("background-image", 'url('+nextShotUrl+')');
}

var nextShot;
function setImageMeta(){
	if(nextImageIndex<0) return;
	nextShot = shots[nextImageIndex];
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

function pause(){
	clearInterval(playInterval);
	playInterval=null;
}
function resume(){
	changeImage();
	if (playInterval) clearInterval(playInterval);//in case it runs for some weird reason
	playInterval = setInterval(changeImage,delay*1000);
}

function togglePlay(){
	if (playInterval){
		pause();
		showFeedback('Pause');
	}else{
		resume();
		showFeedback('Resume');
	}
}

function goToPrevious(){
	if (nextImageIndex<=1){
		jumpToShot(totalShots-1);
	}else{
		jumpToShot(nextImageIndex-2);
	}
	showFeedback('Previous');
}
function goToNext(){
	if (nextImageIndex<totalShots){
		jumpToShot(nextImageIndex);
	}else{
		jumpToShot(0);
	}
	showFeedback('Next');
}
function jumpToShot(imageIndex){
	pause();
	console.log(imageIndex)
	$('#shot').css("background-image", 'url('+shots[imageIndex].image+')');
	$('#standbyShot').css("background-image", 'url('+shots[imageIndex].image+')');
	setImageMeta();
	nextImageIndex = imageIndex;
	//changeImage();
	resume();
}

$("#shot").click(function(e){
	clickPosition = (e.pageX/$(document).width());
	if (clickPosition<0.3){
		goToPrevious();
	}else if (clickPosition>0.7){
		goToNext();
	}else{
		togglePlay();
	}
})

function showFeedback(type){
	switch (type){
		case "Resume":
			$('#playback_feedback').css("background-position","50% 0");
			break;
		case "Pause":
			$('#playback_feedback').css("background-position","50% -100px");
			break;
		case "Next":
			$('#playback_feedback').css("background-position","50% -300px");
			break;
		case "Previous":
			$('#playback_feedback').css("background-position","50% -200px");
			break;
		default:
	}
	$('#playback_feedback').show().delay(500).fadeOut('slow');


	//console.log('Feedback: '+type)
}
/*
function setShotsSize(){
	$('#shot').css({width:window.width,height:window.height});
}*/