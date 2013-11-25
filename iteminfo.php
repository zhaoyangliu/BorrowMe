<?php
	$id = $_GET['q'];
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
	$query = "SELECT * FROM `items` WHERE `item_id`='$id'";
	$result = mysqli_query($server, $query);

  	if($result) 
   	{
   	while($row=mysqli_fetch_row($result)) {
   	        	     	
   		echo "<h1 align ='center'>" . $row[1] . "</h1>";
   		echo $row[2];
   		echo "<p><a href = 'http://liuzy.net/BorrowMe/jquerysite.php#profilepage' onclick = 'getUserInfo(" . $row[4] . ")'>" . $row[8] . "</a></p>";
   		echo "<p> Email: " . $row[5] . "</h2>";
   		echo "<p> Phone Number: " . $row[6] . "</h2>";
   		echo "<br><br>";
   		}
   	}
   	$server->close();
 ?>