<?php


	$del_id = $_GET['q'];
	
	
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

	$query = "SELECT * FROM items WHERE item_id = $del_id";
	$result = mysqli_query($server, $query);
	
	$row=mysqli_fetch_row($result);
	$itemName = $row[1];

	$query = "DELETE FROM items WHERE item_id = $del_id";
	$result = mysqli_query($server, $query);


	$html = "";
  	if($result) 
   	{
		$html .= $itemName;
		$html .= " has been deleted !";
   	echo utf8_encode ($html);
   	}
   	$server->close();
 ?>