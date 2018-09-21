<? include("protect.inc.php");?>
<?include("connectToDB.inc.php");?>
<!DOCTYPE html>
<html>
<head>
 <!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="styles.css" media="screen,projection"/>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Vote App</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
	<?
	$query="SELECT * FROM valedictorian_small_data WHERE id='2'";
	$result = mysql_query($query,$db);
	while($myrow=mysql_fetch_array($result)){
		$themeVal = $myrow['value'];
	}
	?>
<body>
	<div class='nav-wrapper'>
		<div class='row'>
			<ul class="tabs">
				<li class="tab"><a href='javascript:void(0)' class="active" id='tabmain'>Main</a></li>
				<li class="tab"><a href='javascript:void(0)' id='tabadd'>Add</a></li>
				<li class="tab"><a href='#modal2'>Year</a></li>
				<li class="tab"><a href='javascript:void(0)' id='tabupdate'>Update</a></li>
				<li class="tab"><a href='javascript:void(0)' id="tabgraphs">Graphs</a></li>
				<li class="tab"><a href='javascript:void(0)' onClick="window.location.href='login.php?cmd=logout'">Logout</a></li>

			</ul>
		</div>
	</div>
	<div class='container2'>
		<div id='pageload' class='section'>
			<div class='row '>
				<div class='col s12'>
					<h2 class='right-align blue-text text-lighten-2 thin'>Welcome to the Management Page</h2>
				</div>
				<div class='col s12'>
				<p class='thin grey-text right-align'>
				Here you will add, update, or remove valedictorian candidates of the current year. You can view populated data dynamically during the voting process through the GRAPHS tab.
				It is important to set the correct year of the graduating year of the senior class. To remove candidates, go into the UPDATE tab and set the student to "hide". To view previous valedictorian candidates, input their year in the YEAR tab and their names should appear in the UPDATE tab.
				</p>
				</div>
			</div>
			<div class='row'>
				<div class='col s12'>
					<p style='font-weight:400' class='left-align'>
					Select a Theme for the Application
					</p>
					<div class='divider'></div>
				</div>
				<div class='col s12'>
					<form id="form_theme">
						<p class='redtheme'>
							<input class="with-gap theme" name="theme" type="radio" id="redtheme" value='ef5350'/>
							<label for="redtheme">Bearcat Red</label>
						</p>
						<p class='bluetheme'>
							<input class="with-gap theme" name="theme" type="radio" id="bluetheme" value='8c9eff'/>
							<label for="bluetheme">Indigo Blue</label>
						</p>
						<p class='greytheme'>
							<input class="with-gap theme" name="theme" type="radio" id="greytheme" value='757575'/>
							<label for="greytheme">Monochrome</label>
						</p>
						<p class='orangetheme'>
							<input class="with-gap theme" name="theme" type="radio" id="orangetheme" value='ff8a65'/>
							<label for="orangetheme">Deep Orange</label>
						</p>
						<p class='greentheme'>
							<input class="with-gap theme" name="theme" type="radio" id="greentheme" value='a5d6a7'/>
							<label for="greentheme">Clover Green</label>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>			

	<div id="modal1" class="modal">
        <div class="modal-content">
        	<div id='title'></div>
        	<div id='message'></div>
        </div>
    </div>
    <div id="modal2" class="modal bottom-sheet">
	    <div class='row'>
			<nav class='grey lighten-5 z-depth-0'>
				<div class='nav-wrapper'>
				<div class='modal-header thin brand-logo blue-text text-lighten-2'>What Year is it?</div>
					<div id='preload'></div>
				<ul class='right'><li><a onclick='javascript:void(0)' class='modal-action modal-close btn-modal'><i class='material-icons grey-text small'>close</i></a></li></ul>
				</div>
				<div class='divider'></div>
			</nav>
		</div>
	    <div class="modal-footer">
			<div class='row'>	
			  	<form id='setyear'>
					<div class='input-field col s12'>
						<?$query="SELECT * FROM valedictorian_small_data WHERE id='1'";
						$result = mysql_query($query,$db);
						while($myrow=mysql_fetch_array($result)){
				echo    "<input id='currentyear' type='text' value=".$myrow['value']." maxlength='4' name='currentyear' autocomplete='off'></input>";
						}
						?>
						<label for='setyear'>Year</label>
					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="management.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
	$('#modal2').modal('open');
	//set 'theme' to input with the same value of colour as the one in the database
	var theme = document.getElementsByClassName('theme');
	for(var i=0; i<theme.length; i++){
		if(theme[i].value == '<?echo $themeVal;?>'){
			var theme=theme[i];
			break;
		}
	}
	theme.setAttribute("checked", "true");
});
</script>
</body>
<?mysql_close($db);?>
</html>