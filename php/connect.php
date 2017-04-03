<?php
	// The Name Of The Connection Server.
	$servername = 'localhost';
	
	// Username To Connect To MySQL
	$username = 'root';
	
	// Password Corresponding To The Username
	$password = 'root';
	
	// The Database Name Which Has The Tables
	$dbname = 'chatBots';
	
	// Choose The Database System Here. Values are either "PostgreSQL" or "MySQL"
	$system = 'MySQL';
	
	// Prefix is stored here.
	$prefix = ''; // PUT YOUR PREFIX HERE. BUT IF YOU DO IT, CHANGE THE TABLE NAMES IN THE DATABASE ACCORDINGLY	
	
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check The Connection
		if (!$conn)
		{
			die("Connection Failed: " . mysqli_connect_error());
		}
		
		// Set charset to UTF-8
		if (!$conn->set_charset("utf8"))
		{
			printf("Error loading character set utf8: %s\n", $conn->error);
		}
		// Set charset to UTF-8
		if (!$conn->set_charset("utf8"))
		{
			printf("Error loading character set utf8: %s\n", $conn->error);
		}
		include 'functions.php';
?>