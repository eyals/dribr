
$('#f_popular').submit(function(){
	location="popular";
	return false;
})

$('#f_player').submit(function(){
	location="player/"+$('#f_player input').val();
	return false;
})

$('#f_stream').submit(function(){
	location="stream/"+player;
	return false;
})
