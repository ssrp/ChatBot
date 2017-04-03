// Switch to use the SQL Query
function switch_users()
{
	document.getElementById("form_messages").style.display = "none";
	document.getElementById("form_users").style.display = "block";
	document.getElementById("createMessageOutput").style.display = "none";
}
// Switch to use the SQL Query
function switch_messages()
{
	document.getElementById("form_messages").style.display = "block";
	document.getElementById("form_users").style.display = "none";
	document.getElementById("createMessageOutput").style.display = "none";
}
var out = 1;
function switch_msgoutput()
{
	if(out == 1)
	{
		document.getElementById("elseTimeData").style.display = "none";
	}
	else
	{
		loadOldMessages();		
		document.getElementById("elseTimeData").style.display = "block";
		document.getElementById("firstTimeData").style.display = "none";
	}
	document.getElementById("form_messages").style.display = "none";
	document.getElementById("form_users").style.display = "none";
	document.getElementById("createMessageOutput").style.display = "block";
}

// The Main Function, It Starts When The Website Is Launched
function start(){

	document.getElementById("elseTimeData").style.display = "none";
	$.ajax(
		{
			url:"php/Welcome.php", //the page containing php script
			type: "POST", //request type
			data:{}, // Passing the query to a variable named 'query' in executeQuery	
			success:function(result)
			{
				document.getElementById("welcomeData").innerHTML = result;
			}
		}
	);
	document.getElementById("form_messages").style.display = "none";
	document.getElementById("createMessageOutput").style.display = "none";
	// Zoom In The Website to 1.3 Times, It looks better!
	document.body.style.zoom = "100%";

	buildUsers();
	buildMyMessages();
}

// Signing out, call the logout.php script.
function sign_out()
{
	$.ajax(
		{
			url:"php/logout.php", //the page containing php script
			type: "POST", //request type
			data:{},
			success:function(result)
			{
				if(result == "true")
					window.location.href = "index.php";
			}
		}
	);

}
var sendName = "";
function loadMessages(name)
{
	out = 2;
	switch_msgoutput();
	sendName = name;
	loadOldMessages();
	var mystr = "Message Thread - ".concat(name);
	document.getElementById("message_id").innerHTML = mystr;
	document.getElementById("form_messages").style.display = "none";
	document.getElementById("form_users").style.display = "none";
	document.getElementById("createMessageOutput").style.display = "block";
}
function loadOldMessages()
{
	document.getElementById("form_oldM_table").innerHTML = "";
	var table = document.getElementById("form_oldM_table");
	var output = "<thead><tr><th style = 'width:7em'>User</th><th style = 'width:8em'>Time</th><th>Message</th></tr></thead>";
	$(output).appendTo("#form_oldM_table");
	$.ajax(
		{
			url:"php/buildOldMessages.php", //the page containing php script
			type: "POST", //request type
			data: {user:sendName},
			success:function(result)
			{
				var lines = result.split("#");
				for(var i = 1; i < lines.length; i++)
				{
					var infos = lines[i].split("|");
					var username = infos[0];
					var time = infos[1];
					var data = infos[2];
					var output = "<tr><td><b>".concat(username).concat("</b></td><td>").concat(time).concat("</td><td><b>").concat(data).concat("</b></td></tr>");
   			    	$(output).appendTo("#form_oldM_table");

				}

			}
		}
	);
	
}
function sendMessage()
{
	if(document.getElementById('messageData').value != "")
	{		
		var data = document.getElementById("messageData").value;
		$.ajax(
			{
				url:"php/sendMessage.php", //the page containing php script
				type: "POST", //request type
				data:{to: sendName, data: data},
				success:function(result)
				{
					loadOldMessages();
				}
			}
		);	
	}
	else{
		window.alert('Message Cannot Be Null!');
	}
}
// Building the users pane whenever the website is loaded.
function buildUsers()
{
	document.getElementById("form_users_table").innerHTML = "";
	var table = document.getElementById("form_users_table");
	var output = "<thead><tr><th>Username</th></tr></thead>";
	$(output).appendTo("#form_users_table");
	$.ajax(
		{
			url:"php/buildUsers.php", //the page containing php script
			type: "POST", //request type
			success:function(result)
			{
				var lines = result.split("#");
				for(var i = 1; i < lines.length; i++)
				{
					var infos = lines[i].split("|");
					var username = infos[0];
					
					var output = "<tr><td id = 'users_".concat(i.toString()).concat("'>").concat("</td></tr>");
   			    	$(output).appendTo("#form_users_table");

   			    	var queryId = document.getElementById(("users_").concat(i.toString()));

   			    	var querydiv = document.createElement("div");

   			    	querydiv.innerHTML = username;
   			    	querydiv.onclick = function(){
   			    		loadMessages(this.innerHTML);
   			    	};
   			    	querydiv.className = "queryClass";
   			    	queryId.appendChild(querydiv);

				}

			}
		}
	);
}


// Building the messages pane whenever the website is loaded.
function buildMyMessages()
{
	var output = "<thead><tr><th>Username</th></tr></thead>";
	document.getElementById("form_messages_table").innerHTML = "";
	$(output).appendTo("#form_messages_table");

	$.ajax(
		{
			url:"php/buildMessages.php", //the page containing php script
			type: "POST", //request type
			success:function(result)
			{
				if(result == "#" || result == "")
				{
					document.getElementById("form_messages_table").innerHTML = "<h2>You have not exchanged any messages yet, send a message to someone from users on The ChatBot.</h2>";
				}
				else
				{
					var lines = result.split("#");
					for(var i = 1; i < lines.length; i++)
					{
						var infos = lines[i].split("|");
						var username = infos[0];
						
						var output = "<tr><td id = 'users_m_".concat(i.toString()).concat("'>").concat("</td></tr>");
	   			    	$(output).appendTo("#form_messages_table");

	   			    	var queryId = document.getElementById(("users_m_").concat(i.toString()));

	   			    	var querydiv = document.createElement("div");

	   			    	querydiv.innerHTML = username;
	   			    	querydiv.onclick = function(){
	   			    		loadMessages(this.innerHTML);
	   			    	};
	   			    	querydiv.className = "queryClass";
	   			    	queryId.appendChild(querydiv);

					}
				}
			}
		}
	);
}