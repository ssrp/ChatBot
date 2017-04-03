<?php

    // Resume The Session
    session_start();
    if(!isset($_SESSION['chatname']))
    {
        header("location: ../index.php");
    }
	include 'connect.php';

	$userid = $_SESSION['chatname'];
	$user = $_POST['user'];
	//Getting the query from the called JS function.
	$query = "SELECT fromID, time, data FROM " . $prefix ."messages WHERE (fromID = '$userid' AND toID = '$user') OR (fromID = '$user' AND toID = '$userid') ORDER BY time";
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
		foreach ($row as $val) {
			if($type == 0)
			{
				$FROM = $val;
				$type = 1;
			}
			else if($type == 1)
			{
				$time = $val;
				$type = 2;
			}
			else if($type == 2)
			{
				$data = $val;
				$type = 0;
			}

			$newuser = $FROM;
			if($FROM == $userid)
				$newuser = "You";
		}
		$output = $output . "#" . $newuser . "|" . $time . "|" . $data;
		$output = substr($output, 0);
	}
	echo $output;
	closeConnection($conn);
?>