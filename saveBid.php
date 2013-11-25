<?php

$item_name= addslashes($_POST['itemname']);
$item_cat = $_POST['radio-choice-1'];
$item_desc = addslashes($_POST['descrip']);
$owner = addslashes($_POST['owner']);
$owner_id = $_POST['item_owner'];
$contactemail = addslashes($_POST['contactemail']);
$contactphone = addslashes($_POST['contactphone']);
$today = date("m/j/y");
date_default_timezone_set('America/Chicago'); 
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$ran = rand () ;
$ran2 = $ran.".";
$file_check = 0;
$imagename =  $extension;
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
	echo "<p>Uploading file......</p><br>";
	$file_check = 1;
	}
  }
else
  {
  echo "Invalid image file";
  echo " \n type: " . $_FILES["file"]["type"] . "  size: " . $_FILES["file"]["size"] . " extension: " . $extension;

  }

// header( 'Location: http://liuzy.net/BorrowMe/Dev/jquerysite.php#uppage');

if (empty($item_name) || empty($owner) || empty($contactphone) || empty($contactemail))
{
	echo "All fields were not filled out";
}


if(!empty($item_name) && !empty($owner) && !empty($contactphone) && !empty($contactemail) and $file_check == 1)
{
	$MYSQL_server_name = "mysql21.freehostia.com";
	$MYSQL_server_username = "zhaliu0_market";
	$MYSQL_server_password = "0077049";
	$DB_name = "zhaliu0_market";

	$server = @mysqli_connect($MYSQL_server_name, $MYSQL_server_username, $MYSQL_server_password, $DB_name );

	if (!$server) {
	echo "Could not get server";
	exit();
	}

	mysqli_select_db($server,"zhaliu0_market");
	
	//one user can still insert items with same name, do not know why 
	$query="SELECT * FROM items WHERE item_name = $item_name AND item_owner = $owner_id";
	if(!mysqli_query($server,$query)){

		$query="INSERT INTO items (item_name,item_cat,item_desc,owner,item_owner, contactphone,contactemail,postdate,item_image) 
		VALUES('$item_name','$item_cat','$item_desc','$owner','$owner_id','$contactphone','$contactemail',NOW(),'$imagename')";
		
		$result = mysqli_query($server, $query);
			
		if(!$result){ 
			echo "<script type='text/javascript'/>alert('Unsuccessfully entered')</script>";
			header( 'Location: http://liuzy.net/BorrowMe/Dev/jquerysite.php#failed' );
		}
		else {
			// $query="SELECT * FROM items WHERE item_name = $item_name AND item_owner = $owner_id";
			// $result = mysqli_query($server, $query);
			// $row=mysqli_fetch_row($result);
			$id = mysqli_insert_id($server);
			//$_FILES["file"]["name"] =  $id . "." . $extension;
			$imagename =  $id . "." . $extension;
			$query = "UPDATE items SET item_image=$imagename WHERE item_owner = $owner_id AND item_name = $item_name";
			$result = mysqli_query($server, $query);
	
			move_uploaded_file($_FILES["file"]["tmp_name"],"item_photo/" . $imagename);
			
			echo "query success:" . $_FILES["file"]["name"];

			echo "Stored in: " . "upload/" . $_FILES["file"]["name"];

			 header( 'Location: http://liuzy.net/BorrowMe/Dev/jquerysite.php#confirmed' );

		}
	}
	else {
		echo "<script type='text/javascript/>alert('You have uploaded an item with this name, please input another name')</script>";
		header( 'Location: http://liuzy.net/BorrowMe/Dev/jquerysite.php#failed' );
		
	}


}
?>