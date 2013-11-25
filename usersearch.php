<?php


	$uid= $_GET['q'];
	$is_owner = $_GET['p'];
	$uname = "";
	
	
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
	$query = "SELECT * FROM items WHERE item_owner = $uid";
	$result = mysqli_query($server, $query);

	
	$html = "";
  	if($result) 
   	{
		$html = "<div>";
		$html .= "<ul class = \"result_listview\" id = \"user_post_listview\" data-role = \"listview\"> ";

   	while($row=mysqli_fetch_row($result)) {
   	     

		$uname = $row[8];
		$html .= "<li id = \"";
		$html .= $row[0] . "\"";
		$html .= "class = \"user_post_items\"><a style = \"width: 90%;\" href='http://liuzy.net/BorrowMe/jquerysite.php#iteminfo' onclick='getItemInfo( ";
		$html .= $row[0];
		$html .= ")'>";
		
		$html .= "<h2>";
		$html .= $row[1];
		$html .= "</h2>";
		$html .= "<p>" . $row[2] . "</p>";
		$html .= "</a>";
		if ($is_owner == 1){
			$html .= "<a href=\"#\" style = \"width: 10%;\"  data-icon = \"delete\" data-iconpos=\"right\" onclick = \"delete_item(";
			$html .= $row[0] . ")\"";
			$html .= ">Delete</a>";
		} 


		$html .= "</li>";



   	}
   	$html .= "</ul>";
   	$html .= "</div>"; 
   	$html = "<div id = \"profile_name\" ><h1><b><align='center'>" . $uname . "'s Items:</b></h1> </div><div id = \"DeleteHint\"> <br><br><br></div>" . $html;
   	
   	echo utf8_encode ($html);
   	}
   	$server->close();
 ?>