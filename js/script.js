$(document).ready(function(){
	$("#btn-index").click(function(){
		$('.scene_element--fadeinfast').addClass('scene_element--fadeout');
		history.pushState('index.php',null,'voteapp.php');
		$("#main").load('voteapp.php');
	});
});