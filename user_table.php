<?php

$friend = $_POST['friend_list'];
$friend_list = explode(',', $friend);

$uid = $_POST['uid'];
$userName = $_POST['userName'];




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

//$query = "create table if not exists " . $userName . " (userName varchar(255), friend_list varchar(30) )";

$query = "create table if not exists abc (userName varchar(255), friend_list varchar(30) )";

//$query="CREATE TABLE if not exists Persons(FirstName CHAR(30),LastName CHAR(30),Age INT)";
mysqli_query($server,$query);

	$query="INSERT INTO " . $uid . "(friend_list) VALUES('$friend_list[0]')";



if(!mysqli_query($server,$query)){ 
	echo "<script type='text/javascript/>alert('Unsuccessfully entered')</script>";
	header( 'Location: http://liuzy.net/BorrowMe/jquerysite.php#failed' );
}
else {
	echo "query success:  $query";
	header( 'Location: http://liuzy.net/BorrowMe/jquerysite.php#confirmed' );
}



?>