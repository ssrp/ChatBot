<?php

    // Resume The Session
    session_start();
    if(!isset($_SESSION['chatname']))
    {
        header("location: ../index.php");
    }

	$userid = $_SESSION['chatname'];
	echo "Welcome $userid!"; 
?>