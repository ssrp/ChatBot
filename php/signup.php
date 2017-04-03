<?php
	// Connect With The Database
	include 'connect.php';

	// Get The Username, Password, Re-entered Password And The Authentication Key From The Caller
	$uname = $_POST["username"];
	$pass = $_POST["password"];
	$repass = $_POST["repassword"];

		// If Password And Re-Entered Passwords Are Same
		if($pass == $repass)
		{
			// Add The Username and Password in the USERS Table. Signed Up!
			$order = "INSERT INTO " . $prefix . "users (username, password) VALUES	('$uname', '$pass')";

			$result = runQuery($conn, $order);
			if(!$result)
			{
				echo "Error: " . returnError($conn);
				exit();
			}
			if($result)
			{
				echo("<br>Registration Successful");
				//START A SESSION
				if(isset($_POST['username']))
				{
		    	   	session_start();
		    		$_SESSION['chatname']=$_POST['username'];
		    	  	//Storing the name of user in SESSION variable.
					header( "refresh:0; url=../chatBots.php" ); 
				}
			}
			else
			{
				echo("<br>There was some problem in registration.");
				header( "refresh:1; url=../index.php" ); 
			}
		}
		else{
			echo("<br>Password do not match.");
				header( "refresh:1; url=../index.php" );
			}

	closeConnection($conn);
?>