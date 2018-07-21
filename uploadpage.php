<?php
include("dumpuser.php");
if ($current_user === "logged out")
{
	print("<h1> You must be logged in to upload a book! </h1>");
}
else
{
	print('
		
	<form action="upload.php" method="post" enctype="multipart/form-data">
    		Select book to upload:
    		<input type="file" name="fileToUpload" id="fileToUpload">
    		<input type="submit" value="Upload Book" name="submit">
	</form>');
}
