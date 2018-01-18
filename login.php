<?session_start();
// start the session and register the session variables

// get the command value (use request since both post and get are used
$cmd = $_REQUEST['cmd'];
$username = $_POST['user'];
$password = $_POST['pass'];


if ($cmd == "login") {   
	$_SESSION['valid_session'] = "false";   
	$message = "<span style='color: #ff0000;'>The username and/or password are incorrect!</span>";


	$password = md5($password);  // hash the password to check with database value
   
     // Connect to the database and select table
	include("connectToDB.inc.php");     


	$sql = "SELECT * FROM users WHERE username='" . $username . "'";
	$result = mysql_query($sql,$db);
	
	while ($myrow = mysql_fetch_array($result)) { 	 		
		if  ($username == $myrow['username'] && $password == $myrow['password'])  {
			$_SESSION['valid_session'] = "true";
			// autentication verified, simply load the page
			$landing_page = "index.php"; // your page to go to when logging in
			echo "<script language='JavaScript'> window.location='" . $landing_page . "'; </script>";			
		}
	} 
	if($username == 'admin' && $password== md5(123)){
		$_SESSION['valid_session'] = "true";
		$landing_page ="management.php";
		echo "<script language='JavaScript'> window.location='" . $landing_page . "'; </script>";		
	}
	
	mysql_close($db);  // close db connection
}


// force the destruction of the session if you logout.
if ($cmd == "logout")  { 
   session_start("ProtectVariables");
   session_destroy(); 
   $message = "<span style='color: green;'>You have logged out.</span>";
}


// error messages
if ($cmd == "unauth") {
	// default unauth message
	$message = "<span style='color: #ff0000;'>Sorry, you do not have permission to access this page.</span>";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="CACHE-CONTROL" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	 <!-- Bootstrap -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Material Design -->

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.9/css/ripples.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.9/css/bootstrap-material-design.css" rel="stylesheet">

	<style>
		body{
			font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
		  padding:0;
		  margin:0;
		}
		input:-webkit-autofill {
			transition: background-color 5000s ease-in-out 0s;
			-webkit-text-fill-color: white;
		}
		.vid-container{
		  position:relative;
		  height:100vh;
		  overflow:hidden;
		  background-size: 100% auto;
		}
		.bgvid{
			-webkit-transform: translateX(-50%) translateY(-50%);
			-moz-transform: translateX(-50%) translateY(-50%);
			-ms-transform: translateX(-50%) translateY(-50%);
			-o-transform: translateX(-50%) translateY(-50%);
			transform: translateX(-50%) translateY(-50%);
			position: absolute;
			top: 50%;
			left: 50%;
			min-width: 100%;
			min-height: 100%;
			width: auto;
			height: auto;
			z-index: -100;
		}
		.inner-container{
		  width:400px;
		  height:440px;
		  position:absolute;
		  top:calc(50vh - 200px);
		  left:calc(50vw - 200px);
		  overflow:hidden;
		}
		.bgvid.inner{
		  top:calc(-50vh);
		  left:calc(-50vw);
		  filter: url("data:image/svg+xml;utf9,<svg%20version='1.1'%20xmlns='http://www.w3.org/2000/svg'><filter%20id='blur'><feGaussianBlur%20stdDeviation='10'%20/></filter></svg>#blur");
		  -webkit-filter:blur(10px);
		  -ms-filter: blur(10px);
		  -o-filter: blur(10px);
		  filter:blur(10px);
		}
		.box{
		  position:absolute;
		  height:92%;
		  width:100%;
		  font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
		  color:#fff;
		  background:rgba(0,0,0,0.13);
		  padding:30px 0px;
		}
		.box h1{
		  text-align:center;
		  margin:30px 0;
		  font-size:30px;
		}
		.box input{
		  display:block;
		  width:300px;
		  margin:20px auto;
		  padding:15px;
		  background:rgba(0,0,0,0.2);
		  color:#fff;
		  border:0;
		}
		.box input:focus,.box input:active,.box button:focus,.box button:active{
		  outline:none;
		}
		.return{
		  display:block;
		  width:270px;
		  height:13px;
		  margin-left:50px;
		  margin-bottom:5px;
		  padding:15px;
		  background:rgba(0,0,0,0.2);
		  color:#fff;
		  border:0;
		  text-align:center;
		  font-size:0.795em;
		}
		.return:focus,.return:active{
		  outline:none;
		}
		.box p{
		  font-size:14px;
		  text-align:center;
		}
		.box p span{
		  cursor:pointer;
		  color:#666;
		}
		a:visited{text-decoration:none;}a:active{text-decoration:none;}	a:hover{text-decoration:none;}a:link{text-decoration:none;}
	</style>
</head>


<body>

<div class='navbar navbar-fixed-top navbar-info'>
		<div class='container-fluid'>
			 <div class='navbar-header'>
				<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-responsive-collapse'>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
				</button>
				<div class='input-group'>
				</div>
			</div>
			<div class='navbar-collapse collapse navbar-responsive-collapse'>
				<ul class='nav navbar-nav'>
				</ul>
				<ul class='nav navbar-nav navbar-right'>
				</ul>
			</div>
		</div>
	</div>
<?
$bg = array('http://mazwai.com/system/posts/videos/000/000/123/original/victor_ciurus--5d_mark_iii_magic_lantern_14_bits_raw_video.mp4?1412890624',
'http://mazwai.com/system/posts/videos/000/000/022/original/Timelapse_Flower.mp4?1400869691');
$i = rand(0,1);
$bg_rand = $bg[$i];
// display the message
// print login page if logout, login, or an error occurs
echo "
<div class='vid-container'>
	
  <video class='bgvid' autoplay='autoplay' muted='muted' preload='auto' loop>
      <source src='".$bg_rand."' type='video/webm'>
  </video>
  <div class='inner-container'>
    <video class='bgvid inner' autoplay='autoplay' muted='muted' preload='auto' loop>
      <source src='".$bg_rand."' type='video/webm'>
    </video>
    <div class='box'>
	  
<h1>Login</h1>
	<form action='login.php' autocomplete='new-password' method='POST'>
	<input type='hidden' name='cmd' value='login'></input>
	<input type='text' placeholder = 'Username' name='user' value='" . $_POST['user'] . "' maxlength='20' autocomplete='off' required></input><br />
	<input type='Password' placeholder ='Password' name='pass' maxlength='15' autocomplete='off' required></input>
	<input style='cursor:pointer;' type='submit' value='LOGIN'></input>
</form>
";
if ($message) {
	echo "<p>" . $message . "</p>";
}
echo "
</div>
</div>
</div>
";
?>
</body>
</html>
