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

	$errors = array(); 

	session_start();
		
	if(empty($_POST['user_name']))
	{
		$errors[] = 'The username field must not be empty.';
	}
		
	if(empty($_POST['user_pass']))
	{
		$errors[] = 'The password field must not be empty.';
	}
		
	if(!empty($errors)) 
	{
		echo 'Uh-oh.. something is not filled in correctly..';
		echo '<ul>';
		foreach($errors as $key => $value) 
		{
			echo '<li>' . $value . '</li>'; 
		}
		echo '</ul>';
	}
	else
	{
		$user_name = addslashes($_POST['user_name']);
		$pass = sha1($_POST['user_pass']);
		$query = "SELECT user_id, user, user_email FROM users WHERE user_name = '$user_name' AND user_pass = '$pass'";
						
		$result = mysqli_query($server,$query);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while signing in. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			//the query was successfully executed, there are 2 possibilities
			//1. the query returned data, the user can be signed in
			//2. the query returned an empty result set, the credentials were wrong
			if(mysqli_num_rows($result) == 0)
			{
				echo 'You have supplied a wrong user/password combination. Please try again.';
			}
			else
			{
				//set the $_SESSION['signed_in'] variable to TRUE
				$_SESSION['signed_in'] = true;
				
				//we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
				while($row = mysqli_fetch_assoc($result))
				{
					$_SESSION['user_id'] 	= $row['user_id'];
					$_SESSION['user'] 	= $row['user'];
					$_SESSION['user_email'] = $row['user_email'];
					$_SESSION['username'] = $row['username'];
				}
					
				header( 'Location: http://liuzy.net/BorrowMe/jquerysite.php#signedin' );
			}
		}
	}