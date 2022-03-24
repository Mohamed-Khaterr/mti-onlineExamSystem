<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
</head>

<body>
The content of the document......

<input id="send" type="text" >

<button type="button" onclick="send()" value="Send" >Send</button> 

<div id="recive"></div>

<ul>
	<div id="updateUI"></div>
</ul>




<?php
echo '<pre style="text-align: center;">';
	if(isset($_SESSION['query'])){
		
		print_r($_SESSION['query'] ? $_SESSION['query'] : "");
		
	}else{
		echo 'No sessions';
		echo session()->get('student_id');
	}
	echo '</pre>';
?>


</body>
<script>
	//var conn = new WebSocket("ws://localhost:8080?access_token="  + String(<?= session()->get('student_id') ?>));
	
	var conn = new WebSocket("ws://192.168.1.4:8080?access_token="  + String(<?= session()->get('student_id') ?>));
	
	// Start Connection
	conn.onopen = function(e) {
		console.log("(Studnet) Connection established! Now We are live :) ;) ");
	};
	
		
	
	// receive  Data
	conn.onmessage = function(e) {
		console.log(e.data);
		document.getElementById("recive").innerHTML += "Him: " + String(e.data) + "<br />";
		
		/* NEW */
		var data = JSON.parse(e.data);
		if('student' in data){
			console.log(data['student']['connection_name']);
		}
	};
	
	conn.addEventListener('close', function(e){
		console.log("Connection is Closed");
	});
	
	
	// Send Data
	function send(){
		var data = document.getElementById("send").value;
		if(conn.readyState === conn.OPEN){
			conn.send(data);
			document.getElementById("send").value = "";
			document.getElementById("recive").innerHTML += "Me: " + String(data) + "<br />";
		}else{
			document.getElementById("send").value = "";
			document.getElementById("recive").innerHTML += "Error: " + "WS is Closed" + "<br />";
		}
		
	}
	
</script>
</html>