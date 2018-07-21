
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$bookFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) 
{
	if (file_exists($target_file)) 
	{
    		echo "Sorry, we already have this file.";
    		$uploadOk = 0;
	}
	if ($_FILES["fileToUpload"]["size"] > 20000000) 
	{
    		echo "Sorry, your file is too large. The limit is 20 MB";
    		$uploadOk = 0;
	}
	if($bookFileType != "pdf" && $bookFileType != "epub") 
	{
    		echo "Sorry, only EPUB and PDF files are allowed.";
    		$uploadOk = 0;
	}
	//Initiate upload if everything worked.
	if ($uploadOk)
	{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		{
			include("dbconfig.php");
			include("dumpuser.php");
			//Add the upload into the sql database
			$db->query("INSERT INTO useruploads (username, filename)
			VALUES ('" . $current_user . "','" . $_FILES["fileToUpload"]["name"] . "');");
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded, and is waiting in review";

		} 
		else 
		{
        		echo "Sorry, there was an error uploading your file.";
    		}
	}
}
?>

