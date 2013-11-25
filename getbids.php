<?php
$q = intval($_GET['q']);

$MYSQL_server_name = "mysql21.freehostia.com:3306";
$MYSQL_server_username = "zhaliu0";
$MYSQL_server_password = "0077049";
$DB_name = "zhaliu0_market";
    
    $server = @mysql_connect($MYSQL_server_name, $MYSQL_server_username, $MYSQL_server_password);
    if (!$server) {
        echo "Could not get server";
        exit();
    }
    
    $db = @mysql_select_db($DB_name);
    if (!$db) {
        echo "Could not get database";
        exit();
    }

$query = "SELECT * FROM items WHERE category= '".$q."'";
$sorted = @mysql_query($query);
echo "<table>";
while( $info= @mysql_fetch_array($sorted))
{
	$date = date('F d', $info['date']);
	echo "<tr class='whiterows'>".$info['buyout']."</td></tr>";
}

echo "</table>";

?>