<?
include("connectToDB.inc.php");

$query = "SELECT * FROM valedictorian";
$result = mysql_query($query,$db);

$valedictorian_data = array();

while($myrow = mysql_fetch_array($result)){
	$valedictorian_data[] = array(
		'student_id' => $myrow['student_id'],
		'name'	=>	$myrow['name'],
		'votes'	=>	$myrow['votes'],
		'year' => $myrow['year'],
		'updated' => $myrow['updated'],
	);
}

echo json_encode($valedictorian_data);

?>