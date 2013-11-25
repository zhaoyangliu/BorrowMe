<?php


	$inputstring = $_GET['q'];
	$elements = explode(',',$inputstring);
	$category = array_shift($elements);
	$fliststr = join(',',$elements);
	
	
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
	$query = "SELECT * FROM items WHERE item_cat=$category AND item_owner IN ($fliststr)";
	$result = mysqli_query($server, $query);

	if (mysqli_num_rows($result) == 0)
	{
	   	$html = "<div>";
   		$html .= "<p>No Search Results!</p>";
   		$html .= "</div>";
   		echo utf8_encode ($html);
   	}

	$html = "";
  	if($result) 
   	{
		
		$html = "<div>";
		$html .= "<ul class = \"result_listview\" id = \"result_listview\" data-role = \"listview\"> ";

   	while($row=mysqli_fetch_row($result)) {
   	     
  //  		echo "<h3><a href='http://liuzy.net/BorrowMe/jquerysite.php#iteminfo' onclick='getItemInfo(" . $row[0] . ")'>" . $row[1] . "</a></h3>";
  //  		echo "<p>" . $row[2] . "</p>";
		// echo "<br><br>";
//		

		$html .= "<li><a href='http://liuzy.net/BorrowMe/jquerysite.php#iteminfo' onclick='getItemInfo( ";
		$html .= $row[0];
		$html .= ")'>";
		$html .= "<img src=item_photo/";
		$url = "http://www.liuzy.net/BorrowMe/Dev/item_photo/" . $row[0] . "." . $row[item_image];
		if (file_exists($url)) {
    			$html .= $row[0] . "." . $row[item_image]; }
    		else {
			$html .= "no-available-image.png"; }
		
		$html .= " height='100%' style='width: inherit'>";
		$html .= "<h3>";
		$html .= $row[1];
		$html .= "</h3>";
		$html .= "<p>" . $row[2] . "</p>";
		$html .= "</a></li>";

//$html .= "<h3>Section 1</h3>";
//$html .= "<p>I am the collapsible set content for section 1.</p> ";
//$html .= "</div>";

		// echo "<div id= ResultListview  >";
		// echo "<h3>Section 1</h3>";
		// echo "<p>I am the collapsible set content for section 1.</p> ";
		// echo "</div>";

   	}
   	$html .= "</ul>";
   	$html .= "</div>"; 
   	echo utf8_encode ($html);
   	}
   	
   	
   	$server->close();
 ?>