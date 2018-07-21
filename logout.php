<?php
include('dumpuser.php');

if ($current_user === "logged out")
{
	print("You were already logged out");
}
else
{
	$db->query("DELETE FROM user_sessions WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "'");
	$db->query("DELETE FROM user_sessions WHERE username = '" . $current_user . "'");
	print("Successfully logged out user " . $current_user);
}
