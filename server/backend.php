<?	
include("connectToDB.inc.php");

	if($_POST['currentyear']){
		$query = "
			UPDATE valedictorian_small_data
			SET value = '" . $_POST['currentyear'] . "'
				WHERE id = '1'";
		$result = mysql_query($query,$db);
	}

	if($_POST['theme']){
		$query = "
			UPDATE valedictorian_small_data
			SET value = '" . $_POST['theme'] . "'
				WHERE id = '2'";
		$result = mysql_query($query,$db);
	}

	//Current Year Query
	$query = "SELECT * FROM valedictorian_small_data WHERE id='1'";
	$result=mysql_query($query,$db);
	while($myrow=mysql_fetch_array($result)){
		$currentyear = $myrow['value'];
	}
	//Query 1: Number of valedictorian candidates
	$query = "SELECT COUNT(active) 
    	AS size
    	FROM valedictorian 
    	WHERE active=0";
    $result=mysql_query($query,$db);
    $active_size=mysql_fetch_assoc($result);

    //Query 2: Valedictorians
    $query = "SELECT * FROM valedictorian ORDER BY RAND()";
    $result = mysql_query($query,$db);

    //Valedictorian Output
    while($myrow=mysql_fetch_array($result)){

    	if($myrow['active']==0 && $myrow['year']==$currentyear)
    	{
    		//Grid System Conditions
    		if($active_size['size']>=0 && $active_size['size']<=4)
    		{
        	$student .= 
	        	"<div class='candidateselection col s6 full center-align' data-id='".$myrow['student_id']."' data-target='modal1'>
	        		<div class='col s12 valign-wrapper' style='height:80%;'>
	        			<img style='width:80%' src=".$myrow['image']." class='valign center-block z-depth-4 responsive-img circle'/>
	        		</div>
	        		<div class='col s12 ' style='height:13% '>
	        			<h4 style='font-weight:200'>".$myrow['name']."</h4>
	        		</div>
	        	</div>
	        	<form id=form".$myrow['student_id']."><input type='hidden' name='student_id' value='".$myrow['student_id']."'></input></form>";
        	}
        	else if($active_size['size']>=5 && $active_size['size']<=6)
    		{
        	$student .= 
	        	"<div class='candidateselection col s4 full center-align' data-id='".$myrow['student_id']."' data-target='modal1'>
	        		<div class='col s12 valign-wrapper' style='height:80%;'>
	        			<img style='width:80%' src=".$myrow['image']." class='valign center-block z-depth-4 responsive-img circle'/>
	        		</div>
	        		<div class='col s12 ' style='height:13% '>
	        			<h4 style='font-weight:200'>".$myrow['name']."</h4>
	        		</div>
	        	</div>
	        	<form id=form".$myrow['student_id']."><input type='hidden' name='student_id' value='".$myrow['student_id']."'></input></form>";
        	}
        	else if($active_size['size']>=7)
    		{
        	$student .= 
	        	"<div class='candidateselection col s3 full center-align' data-id='".$myrow['student_id']."' data-target='modal1'>
	        		<div class='col s12 valign-wrapper' style='height:80%;'>
	        			<img style='width:80%' src=".$myrow['image']." class='valign center-block z-depth-4 responsive-img circle'/>
	        		</div>
	        		<div class='col s12 ' style='height:13% '>
	        			<h4 style='font-weight:200'>".$myrow['name']."</h4>
	        		</div>
	        	</div>
	        	<form id=form".$myrow['student_id']."><input type='hidden' name='student_id' value='".$myrow['student_id']."'></input></form>";
        	}

    	}
    }

    //Query 3:Vote processed
    if($_POST['student_id'])
    {
    	echo "success";
    	$student_id = $_POST['student_id'];
		$query = "SELECT * FROM valedictorian WHERE student_id='" . $student_id . "'";
		$result = mysql_query($query,$db);
		// basic output of the data from the table
		while ($myrow = mysql_fetch_array($result))  {  
			$newNumVotes = $myrow['votes'] + 1;
		}
		$query_update = "UPDATE valedictorian SET votes='" . $newNumVotes . "' WHERE student_id='" . $student_id . "'"; 
		$result_update = mysql_query($query_update,$db);		
    }

?>
<?mysql_close($db);?>