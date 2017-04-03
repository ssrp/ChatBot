<?php
	// Resume The Session
	session_start();

	// If Logged In, Log Out!
	if(isset($_SESSION['chatname']))
	{
		unset($_SESSION['chatname']);
		// Return True, echo Works As A Return Value Here.
		echo "true";
	}

	// Redirect Anyway To The Index Page
	header("refresh:0; url=../index.php");
?>