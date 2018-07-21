<?php
	define('DB_SERVERNAME', 'localhost');
	define('DB_USERNAME', 'mysql');
	define('DB_PASSWORD', 'some_pass');
	define('DB_DATABASE', 'sessions');
	$db = new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	if (!$db)
	{
		die("Could not connect: " . mysqli_connect_error());
	}
?>
