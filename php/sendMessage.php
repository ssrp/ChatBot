<?php
	    // Resume The Session
	    session_start();
	    if(!isset($_SESSION['chatname']))
	    {
	        header("location: ../index.php");
	    }
		include 'connect.php';

		//Getting the query from the called JS function.
		$to = $_POST['to'];
		$from = $_SESSION['chatname'];
		$data = $_POST['data'];
		$query = "INSERT INTO " . $prefix . "messages (fromID, toID, data) VALUES	('$from', '$to', '$data')";
		$query_run = runQuery($conn, $query);
		if(!$query_run)
		{
			$output = "Error: " . returnError($conn);
			exit();
		}
		else
			$output = "Message Sent Successfully! Refresh the page to see the result!";
		echo $output;
		closeConnection($conn);
?>