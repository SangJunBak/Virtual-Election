<?
// start the session and register the session variables
session_start();


if ($_SESSION['valid_session'] == "true") {
   // autentication verified, simply load the page
   header ("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0"); 
   header ("Pragma: no-cache");
}
else {
	// redirect login error: permission to page unauthorized
	header("location: login.php?cmd=unauth");
}
?>
