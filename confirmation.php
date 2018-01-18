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
    .nav-red{
        background-color:#". $themecolour .";
    }
    ";?>
    </style>
</head>
<body>
<div class='m-scene'>
<div style='overflow:initial; z-index:100' class='background-1 scene_element scene_element--slidetopinverse'></div>
        <div class='navbar-fixed'>
            <nav class='scene_element scene_element--slidetop nav-red'>
                <div class='nav-wrapper'>
                </div>
            </nav>
        </div>
    <div class='center-align container scene_element scene_element--fadeinslow'>
    <h1 style='font-weight:500; font-size:5em; margin-top:25%;'>Thank You For Voting!</h1>
    </div>
</div>
</body>
</html>
