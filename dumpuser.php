<?php
//This file dumps the current username into $current_username
include("dbconfig.php");
$username = $db->query("SELECT * FROM user_sessions WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "'");

$obj = $username->fetch_object();
$current_user = "nulluser";
if (!$obj)
{
	$current_user = "logged out";
}
else 
{
	$current_user = $obj->username;
}

?>
