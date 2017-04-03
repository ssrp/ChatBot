<?php
	// Resume a session.
	session_start();
	
	// If not started, then go back to index.php
	if(!isset($_SESSION['chatname']))
	{
		header("location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title class = "interface_title">The ChatBot</title>

	<!--
		Including the CSS Files Required!
		-->
	<link href = "css/fonts.css" rel = "stylesheet" type = "text/css" />
	<link href = "css/bootstrap.min.css" rel = "stylesheet" type = "text/css" />
	<link href = "css/index.css" rel = "stylesheet" type = "text/css" />
	<!--
		Using UTF-8 Font Type 
		-->
	<meta charset="utf-8">
</head>
	<!--
		Setting The Logo!
		-->
	<link rel="shortcut icon" href="images/chatbotlogo.png">

	<!--
		The Code Starts with the 'start()' function in javascript. It does a lot of jobs, like loading the data from the database, loading up the fields etc.
		-->
<body onload = "start();">

	<!--
		The Main Navigation Bar (At The Top)
		-->
	<div id = "toolbar">
		<ul class="nav nav-tabs">
			<li class="navbar-header"><img src = "images/chatbotlogo.png" style ="height:2em; margin-top: 0.5em;margin-left: 0.5em;margin-right:0.2em; transform:scale(1.4)"></li>
			<li role="presentation" id = "toolbar_users" onclick = "switch_users()"><a href="#">Users on The ChatBot Server</a></li>
			<li role="presentation" id = "toolbar_messages" onclick = "switch_messages()"><a href="#">Inbox</a></li>
			<li role="presentation" id = "toolbar_msgoutput" onclick = "switch_msgoutput()"><a href="#">Message Thread</a></li>
			<li role="presentation" class="navbar-right"></li>
			<li role="presentation" id = "logout" class="navbar-right" onclick = "sign_out()"><a href="#"><span class = "interface_toolbar_logout">Logout</span></a></li>
		</ul>
	</div>
	<center>
		<h1 id = "welcomeData">
		</h1>
	</center>
	<div id = "form_users">
		<h2 style = "margin-left:1em">Users</h2>
		<h5 style = "margin-left:2.7em; margin-right:2.7em;">Following users are connected to The ChatBot:</h5>
		<div style = "width:100%; padding-top:1%; padding-left:5%; padding-right:5%; padding-bottom:2%">	
			<table id = "form_users_table" class="table table-striped table-bordered" cellspacing="0">

			</table>
		</div>
	</div>


	<div id = "form_messages">
		<h2 style = "margin-left:1em">Your Conversations</h2>
		<h5 style = "margin-left:2.7em; margin-right:2.7em;">Here are the people with whom you have exchanged messages:</h5>
		<div style = "width:100%; padding-top:1%; padding-left:5%; padding-right:5%; padding-bottom:2%">
			<table id = "form_messages_table" class="table table-striped table-bordered" cellspacing="0">

			</table>
		</div>
	</div>

	<div id = "createMessageOutput">
		<div id = "elseTimeData">
			<h2 style = "margin-left:1em" id = "message_id"></h2>
			<h5 style = "margin-left:2.7em; margin-right:2.7em;"></h5>
			<div style = "width:100%; padding-top:1%; padding-left:5%; padding-right:5%; padding-bottom:2%">	
				<table id = "form_oldM_table" class="table table-striped table-bordered" cellspacing="0">
				</table>
				<br>
				<center>
					<textarea id = "messageData"></textarea>
					<br>
					<button id = "sendMessage" onclick = "sendMessage()">Send</button>
				</center>
			</div>
		</div>
		<div id = "firstTimeData" style = "width:100%; padding-top:1%; padding-left:5%; padding-right:5%; padding-bottom:2%">
			<h3>Here you can see all the messages from a specific person. Please choose a person from Inbox to see the conversation.</h3>
		</div>
	</div>


	<!--
		Include The Script Files
		-->
	<script src="js/jquery.min.js"></script>
	<script type = "text/javascript" src = "js/index.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>