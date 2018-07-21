

<?php
//This file creates a login prompt and requests a password. It then creates a user session.
if (isset($_POST['submitted']) )
{
	if ((!empty($_POST['username'])) && (!empty($_POST['password'])))
	{
		include("dbconfig.php");
		$users = $db->query( "SELECT * FROM user_credentials WHERE username = '" . $_POST['username'] . "'") or die("failed");
		if($users->num_rows == 0) {
			print("<h1>Password or username incorrect!</h1>");
			exit();
		}
		
		$obj = $users->fetch_object();

		if (password_verify($_POST['password'], $obj->password_hash)) 
		{
			print('<h1>Login successful.</h1>');

			//Create a new user session, if one doesn't exist
			$db->query("DELETE FROM user_sessions WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "'");
			$db->query("DELETE FROM user_sessions WHERE username = '" . $_POST['username'] . "'");
			$db->query("INSERT INTO user_sessions (username, ipaddress, logintime) 
			VALUES ('" . $_POST['username'] . "','" . $_SERVER['REMOTE_ADDR'] . "'," . strval(time()) . ")");
		}
		else
		{
			print("<h1>Password or username incorrect!</h1>");
		}

			
		
	} 
	else 
	{
		print('<br><h1>Login form empty or incomplete</h1>');
	}

}
else
{
	include("dumpuser.php");
	if ($current_user === "logged out")
	{

		print('<form action="login.php" method="post">
		<p>Username: <input type="text" name="username" size="20"/></p>
		<p>Password: <input type="password" name="password" size="20"/></p>
		<p><input type="submit" name="submit" value="Log In!" /></p>
		<input type="hidden" name="submitted" value="true"/>
		</form>');
	}
	else
	{
		print('<h3 align = "center">You are logged in as: ' . $current_user . "</h3><br>");
		print('<form action="logout.php" method="post"><p align="center"><input type="submit" name="submit" value="Log out"/></p></form>');

	}
}	

?>
