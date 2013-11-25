<?php

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
	if(empty($_POST['name']))
	{
		$errors[] = 'The name field cannot be empty.';
	}	
	
	if(empty($_POST['phone']))
	{
		$errors[] = 'The phone number field cannot be empty.';
	}
	if(empty($_POST['email']))
	{
		$errors[] = 'The email field cannot be empty.';
	}	
	if(!empty($_POST['username']))
	{
		if(strlen($_POST['username']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	
	if(!empty($_POST['pass']))
	{
		if($_POST['pass'] != $_POST['pass_check'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}
	
	if(!empty($errors))
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..';
		echo '<ul>';
		foreach($errors as $key => $value) 
		{
			echo '<li>' . $value . '</li>'; 
		}
		echo '</ul>';
	}
	else
	{
		$username = addslashes($_POST['username']);
		$name = addslashes($_POST['name']);
		$email = addslashes($_POST['email']);
		$phone = addslashes($_POST['phone']);
		$pass = sha1($_POST['pass']);
		$query="INSERT INTO users (user_name,user_pass,user_email,user_phone, user) VALUES('$username', '$pass', '$email', '$phone', '$name')";
	
	
	
	if(!mysqli_query($server,$query)){ 
		echo "<script type='text/javascript/>alert('Unsuccessfully entered')</script>";
		header( 'Location: http://liuzy.net/BorrowMe/jquerysite.php#signupfailed' );
	}
	else {
		echo "query success:  $query";
		header( 'Location: http://liuzy.net/BorrowMe/jquerysite.php#signupconfirmed' );
	}
}
   

?>