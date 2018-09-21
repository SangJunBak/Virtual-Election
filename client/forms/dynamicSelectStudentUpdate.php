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

<script>
  $(document).ready(function() {
    $('select').material_select();
  });
</script>