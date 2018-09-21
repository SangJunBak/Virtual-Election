<?include("connectToDB.inc.php");
$query="SELECT * FROM valedictorian_small_data WHERE id='2'";
	$result = mysql_query($query,$db);
	while($myrow=mysql_fetch_array($result)){
		$themeVal = $myrow['value'];
	}?>
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
<script type='text/javascript'>
$(document).ready(function(){
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