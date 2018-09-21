//initialization of materialize plugins
$('.modal').modal();
$('select').material_select();
var currentyear = $('#currentyear').attr('value').toString();

//global variables
var preload = "<div style='position:fixed; margin:0.90% 0% 0% 17%;' class='col s1'>\
					   		<div class='preloader-wrapper small active'>\
								<div class='spinner-layer spinner-blue-only'>\
									<div class='circle-clipper left'>\
										<div class='circle'></div>\
									</div>\
									<div class='gap-patch'>\
										<div class='circle'></div>\
									</div>\
									<div class='circle-clipper right'>\
										<div class='circle'></div>\
									</div>\
								</div>\
							</div>\
		        		</div>";

$(document).ready(function(){

	//Disables "enter" key submission of setyear form 
	$('#setyear').submit(function(e){
		e.preventDefault();
	});

	// currentyear(){
	// 	$.ajax({
	// 	  url: 'data_admin.php',
	// 	  data: data,
	// 	  success: success
	// 	});
	// }

	//Dynamic Select
	function dynamicSelect(){	
		$("#div_update").load("dynamicSelectStudentUpdate.php");	
	}

	//Loads Content Tabs on Click
	function pageload(){
		$('#tabmain').click(function(){
			$('#pageload').load('main.php',function(){
				formSubmit();
			});			
		});
		$('#tabadd').click(function(){
			$('#pageload').load('insertform.html',function(){
				formSubmit();
			});			
		});
		$('#tabupdate').click(function(){
			$('#pageload').load('updateform.php', function(){
				formSubmit();	
			});
		});
		$('#tabgraphs').click(function(){
			$('#pageload').load('graphs.php', function(){
				formSubmit();	
				graph();
			});
		});
	}

	function modal(data){

		if (data.error == "false" && data.confirm == "false" && data.update=="false") {
            //alert("Testing callback...");
            $('#modal1').modal('open');
			$("#message").html("<p>" + data.message + "</p>");
			$("#title").html("<h4 class='green-text lighten-2'>SUCCESS</h4>");
		
         }else if(data.error == "false" && data.confirm == "false" && data.update == "true"){
			$('#modal1').modal('open');
			$("#message").html(data.message);
			$("#title").html("<h4 class='center-align'>Update</h4>");
			$("#form_do_update").submit(function(e){
				e.preventDefault();
				$.ajax({
					url:"data_admin.php",
					method: "POST",
					data:$('#form_do_update').serialize(),
					dataType:'json',
					success: function(data){
						setTimeout(function(){
							modal(data);							
							$('#form_update')[0].reset();
							dynamicSelect();
						},200);
					}
				});
			});
		}else{
			$('#modal1').modal('open');
            $("#message").html("<p>" + data.message + "</p>");
			$("#title").html("<h4 class='red-text'>ERROR</h4>");
          }
	}

	function formSubmit(){

		$('input[name=theme]').change(function(){
			$.ajax({
				url:"backend.php",
				method: "POST",
				data:$("#form_theme").serialize(),
				dataType:'html',
				success: function(data){
				}
			});
		});
	
		$("#form_insert").submit(function(e){
			e.preventDefault();
			 // var file_data = $('#sortpicture').prop('files')[0];   
    // var form_data = new FormData();                  
    // form_data.append('file', file_data);
    // alert(form_data);               
			$.ajax({
				url:"data_admin.php",
				method: "POST",
				data:$(this).serialize(),
				dataType:'json',
				success: function(data){
					setTimeout(function(){
						modal(data);
						dynamicSelect();	
						$('#form_insert')[0].reset();
					},200);
				}
			});
		});

		$("#form_update").submit(function(e){
			e.preventDefault();
			$.ajax({
				url:"data_admin.php",
				method: "POST",
				data:$(this).serialize(),
				dataType:'json',
				success: function(data){
					setTimeout(function(){
						modal(data);
					},200);
				}
			});
		});

		$("#currentyear").keyup(function(e){
			if($(this).val().length == 4){
			$('#preload').fadeIn('fast').html(preload);
				$.ajax({
					url:'backend.php',
					method: 'POST',
					data:$(this).serialize(),
					dataType:'html',
					success: function(data){
						pageload();
						dynamicSelect();
						setTimeout(function(){
							$('#preload').fadeOut('slow');
						},700);
					}
				});
				currentyear = $('#currentyear').attr('value').toString();
			}
		});
	}                     
	function graph(){
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);


		function drawChart(result) {
		
			$.getJSON("graphJson.php", function(jsonData){
			
				var data = new google.visualization.DataTable();
				
				data.addColumn('string', 'Candidate');
				data.addColumn('number', 'Number of Votes');
		
				for (var i = 0; i < jsonData.length; i++) {
					if(jsonData[i].year == currentyear){
					data.addRow([jsonData[i].name, parseInt(jsonData[i].votes)]);
					}
				}	

				var piechart_options = {
					fontSize:16,
					height: '420',
					legend: {
						position:'left',
					},
					chartArea: {
						left:0,
						width:'100%',
					},
				};

				var barchart_options = {
					fontSize:14,

					legend: {
						position:'none',
					},
					vAxis: {
						format: '0',
						gridlines: { 
							count: 10 ,
						},
					},
					animation:{
						startup:true,
					    duration: 500,
					    easing: 'out',
					},
					chartArea: {
						left:20,
						width:'100%',
					},
					colors:['#64b5f6'],
					height:'300',
				 };

				var bar_chart = new google.visualization.ColumnChart(document.getElementById('barchart_div'));
				bar_chart.draw(data, barchart_options);
					 

				var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
				chart.draw(data, piechart_options);
				
			 });
		 }
	}

	pageload();
	formSubmit();
});
