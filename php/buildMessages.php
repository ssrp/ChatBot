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
	$query = "SELECT fromID, toID FROM " . $prefix ."messages WHERE fromID = '" . $userid . "' OR toID = '" . $userid . "'";
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
		$type = 0;
		$TO = "";
		$FROM = "";
		foreach ($row as $val) {
			if($type == 0)
			{
				$FROM = $val;
				$type = 1;
			}
			else if($type == 1)
			{
				$TO = $val;
				$type = 0;
			}

			if($TO == $userid)
				$newuser = $FROM;
			else
				$newuser = $TO;

		}

		if(!(strpos($output, $newuser) !== false))
			$output = $output . "#" . $newuser;
		$output = substr($output, 0);
	}
	echo $output;
	closeConnection($conn);
?>