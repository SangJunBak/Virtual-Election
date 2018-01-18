<div class='row'>
	<div class='card'>
		<div class='card-content'>
			<span class='card-title'><h4>Update Information</h4></span>
			<form id='form_update' method='post'>
					<div id='div_update' class='input-field col s12'>
					<?include("connectToDB.inc.php");?>

					<?//Current Year Query
					$query_year="SELECT * FROM valedictorian_small_data WHERE id='1'";
					$result_year=mysql_query($query_year,$db);
					while($myrow=mysql_fetch_array($result_year)){
						$currentyear=$myrow['value'];
					}
					?>

					<?//Group Select
						echo" <select id='select_update' name='name' required>
						<option value= ''>Please Select a Student</option>";
						$sql = "SELECT * FROM valedictorian WHERE year='$currentyear'";
						$result = mysql_query($sql,$db);
						while($myrow = mysql_fetch_array($result)){
							echo "<option value='" . $myrow['student_id'] . "'>" . $myrow['name'] . "</option>";
						}
					echo"</select>";
					?>



					<?mysql_close($db);?>
					</div>
					<button class="btn waves-effect waves-light blue lighten-2" id='btn_update' type="submit" name="btn_update">Update
						<i class="material-icons right">send</i>
					</button>
					<input name='update' type='hidden' value='update'></input>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
    	$('select').material_select();
	});
</script>