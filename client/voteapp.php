<? include("protect.inc.php");
include("connectToDB.inc.php");?>
<?
//initialize colour theme
$query = "SELECT * FROM valedictorian_small_data WHERE id='2'";
$result=mysql_query($query,$db);
while($myrow=mysql_fetch_array($result)){
  $themecolour = $myrow['value'];
}
?>
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
    <style>
    <?echo"
    .background-1{
      background-color:#". $themecolour .";
    }
    .nav-red{
      background-color:#". $themecolour .";
    }
    ";?>
    </style>
</head>
<?include("backend.php");?>

<body id='main'>
    <div class='m-scene'>
    <div style='overflow:initial; z-index:100' class='background-1 scene_element scene_element--slidetopinverse'></div>
        <div class='navbar-fixed'>
        	<nav class='scene_element scene_element--slidetop nav-red'>
        		<div class='nav-wrapper'>
        		</div>
        	</nav>
        </div>
    <div id='student_output' class='scene_element scene_element--fadeinslow'>
            <div class='row'>
            <?echo $student?>
            </div>
        </div>

     <!-- modal -->
      <div id="modal1" class="modal">
        <div class="modal-content">
          <h4>Vote Confirmation</h4>
          <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
        <button class="btn-modal modal-action modal-close waves-effect waves-light btn-flat">Yes</button>
        </div>
      </div>

    </div>
<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
     <script type="text/javascript" src="voteapp.js"></script>


    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>
</html>