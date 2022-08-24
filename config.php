<?php

session_start();
error_reporting(-1);

//Create connection for new database
$dbObj = new mysqli("localhost","root","","simplelogin");
//Check connection
if ($dbObj->connect_error) {
	die("Connection failed: " . $dbObj->connect_error);
}

?>