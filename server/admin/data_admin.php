<?php
include("connectToDB.inc.php");

$return = array();
$return['error']="false";
$return['confirm']="false";
$return['update']="false";
$return['message']="";

//curent year query
$query="SELECT * FROM valedictorian_small_data WHERE id='1'";
$result=mysql_query($query,$db);
while($myrow=mysql_fetch_array($result)){
	$currentyear=$myrow['value'];
}
?>

<?//insert
if($_POST['insert']){
	//Input POST values
	$name = addslashes(htmlspecialchars($_POST['name']));
	$image = addslashes(htmlspecialchars($_POST['url']));	

	// if ( 0 < $_FILES['file']['error'] ) {
 //        //echo 'Error: ' . $_FILES['file']['error'] . '<br>';
 //    }
 //    else {
 //        move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $_FILES['file']['name']);
 //    }

	//SQL insert Statement	
	$query="INSERT INTO valedictorian (name, image, year) VALUES ('$name', '$image', '$currentyear')";
	$result=mysql_query($query,$db);
	$return['message'] = "The candidate has been added!";

}
?>
<?//update
if($_POST['update']){
	$return['update'] = "true";
	$name = $_POST['name'];
	//Query for update form
	$query = "SELECT * FROM valedictorian  WHERE student_id='" . $name . "'";
	$result = mysql_query($query,$db);

	//Form Update 2
	while($myrow = mysql_fetch_array($result)){

		if($myrow['active']==0){
			$checked = "checked";
		}

		$return['message'] = "	<form id='form_do_update'>
								<div class='row'>
									<div class='input-field col s12'>
										<input type='text' name='name' value='" . $myrow['name'] . "' autocomplete='off'></input>
										<label class='active' for='name'>Name</label>
									</div>
									<div class='input-field col s12'>
										<input type='text' name='url' value='" . $myrow['image'] . "' autocomplete='off'></input>
										<label class='active' for='url'>Image Url</label>
									</div>
									<div class='input-field col s12'>
										<input type='text' name='year' value='" . $myrow['year'] . "' autocomplete='off'></input>
										<label class='active' for='year'>Year</label>
									</div>
									<div class='input-field col s12'>
										<input type='text' name='votes' value='" . $myrow['votes'] . "' autocomplete='off'></input>
										<label class='active' for='votes'>Votes</label>
									</div>
										<div class='switch'>
											<label>
												Hide
												<input name='active' type='checkbox' value='0' ".$checked.">
												<span class='lever'></span>
												Show
											</label>
										</div>
								</div>
								<div class='row'>
									<input class='btn right waves-effect waves-light blue lighten-2' type='submit' value='Confirm' name='btn_do_update'></input>
									<input name='student_update' type='hidden' value='" . $myrow['student_id'] . "'></input>
									<input name='do_update' type='hidden' value='do_update'></input>
								</div>	
								</form>";
	}
}
?>
<?//update 2
if($_POST['do_update']){
	$student_update = $_POST['student_update'];
	$name = $_POST['name'];
	$url = $_POST['url'];
	$year = $_POST['year'];
	$votes = $_POST['votes'];
	$active=$_POST['active'];
		if($active!= '0'){
			$active = '1';
		}
	$query_update = "UPDATE valedictorian SET name = '" . $name . "',
		image = '" . $url . "',
		votes = '" . $votes . "',
		active = '" . $active . "'
		WHERE student_id = '" . $student_update . "'";
	$result_update = mysql_query($query_update,$db);
	$return['message'] = "<strong>Thank you, the records have been updated.</strong>";
}
?>
<?echo json_encode($return);
mysql_close($db);?>