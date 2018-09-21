<?php
// database configurations
$db_servername = "localhost";
$db_username = "INSERT_DB_USERNAME";
$db_password = "INSERT_DB_PASSWORD";
$db_databasename = "INSERT_DB_NAME";

//************************************************************************
// Connect to MySQL Database
//************************************************************************
$db = mysql_connect($db_servername,$db_username,$db_password);
if (!$db) {
    die('Could not connect to database: ' . mysql_error());
} else {
    mysql_select_db($db_databasename,$db);
   
}
?>