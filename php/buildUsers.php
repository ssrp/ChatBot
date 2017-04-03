<?php

    // Resume The Session
    session_start();
    if(!isset($_SESSION['chatname']))
    {
        header("location: ../index.php");
    }
	include 'connect.php';

	$userid = $_SESSION['chatname'];
	//Getting the query from the called JS function.
	$query = "SELECT username FROM " . $prefix ."users";
	$query_run = runQuery($conn, $query);
	if(!$query_run)
	{
		echo "Error: " . returnError($conn);
		exit();
	}
	$num_rows = getRows($query_run);
    $num_cols = getColumns($query_run);
	
	$output = "";
	while ($row = fetchAssoc($query_run)) {
		foreach ($row as $val) {
				$Q = $val;
		}
		if($Q != $userid)
			$output = $output . "#" . $Q;
		$output = substr($output, 0);
	}
	echo $output;
	closeConnection($conn);
?>