<?php
	$MYSQL_server_name = "mysql21.freehostia.com";
	$MYSQL_server_username = "zhaliu0_market";
	$MYSQL_server_password = "0077049";
	$DB_name = "zhaliu0_market";
	$owner_id = "";

	$server = @mysqli_connect($MYSQL_server_name, $MYSQL_server_username, $MYSQL_server_password, $DB_name );

	if (!$server) {
	echo "Could not get server";
	exit();
	}

	mysqli_select_db($server,"zhaliu0_market");
	$query = "SELECT * FROM `items` WHERE `item_owner`='$owner_id'";
	$result = mysqli_query($server, $query);


  	if($result) 
   	{
   	while($row=mysqli_fetch_row($result)) {
   	     
   		echo "<h3><a href='http://liuzy.net/BorrowMe/jquerysite.php#iteminfo' onclick='getItemInfo(" . $row[0] . ")'>" . $row[1] . "</a></h3>";
   		echo "<p>" . $row[2] . "</p>";
   		echo "<br><br>";
   		}
   	}
   	$server->close();
 ?>