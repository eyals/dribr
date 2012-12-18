
$('#f_popular').submit(function(){
	//_gaq.push(['_trackEvent', 'launch', 'popular']);
	location="popular";
	return false;
})

$('#f_player').submit(function(){
	var player = $('#f_player input').val();
	//_gaq.push(['_trackEvent', 'launch', 'player', player]);
	location="player/"+player;
	return false;
})

$('#f_stream').submit(function(){
	var player = $('#f_stream input').val();
	//_gaq.push(['_trackEvent', 'launch', 'stream', player]);
	location="stream/"+player;
	return false;
})
