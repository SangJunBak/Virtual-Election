$(document).ready(function(){

	$('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      starting_top: '4%', // Starting top style attribute
      ending_top: '10%', // Ending top style attribute
      ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
      	var student_id=$(trigger).data('id');
      	$("button").attr('id', student_id);
      	console.log(student_id);
      },
      complete: function() {} // Callback for Modal close
    });
	
  	$(".btn-modal").click(function(){
  		var student_id=$(this).attr('id');
		$.ajax({
			url:"backend.php",
			method: "POST",
			data:$("#form"+student_id).serialize(),
			success: function(data){
				$('.scene_element--fadeinslow').addClass('scene_element--fadeout');
				$('.scene_element--slidetop').addClass('scene_element--slidebottom');
				$('.scene_element--slidetopinverse').addClass('scene_element--slidebottominverse');
				setTimeout(function(){
					 history.pushState(null,null,'confirmation.php');
					 $('#main').load('confirmation.php',function(){
					 	setTimeout(openURL,1500);
					 	function openURL(){
					 		window.location.href='index.php';
					 	}
					 });
				},750);

			}
		});
	});

});