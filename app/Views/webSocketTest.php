<!DOCTYPE html>
<html>
<head>


<!-- jquery Library for ajax -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<title>Title of the document</title>
</head>

<body>

<br />

<?php
	echo '<pre style="text-align: center;">';
	echo 'Student Name: ';
	echo session()->get('student_fname') . " " . session()->get('student_lname');
	echo ' ('. session()->get('student_id') .')';
	echo '</pre>';
?>

<div style="text-align: center">
	
	<video  id="videoStream" autoplay></video>
	<p>Send Image</p>
	
	<br />
	<br />
	
	<canvas height="200" width="200" id="canvas" hidden></canvas>
	<p>Canvas Image</p>
	
</div>

</body>


<script>
	
	//var conn = new WebSocket("ws://192.168.1.3:8080?access_token="  + String(<?= session()->get('student_id') ?>));
	var conn = new WebSocket("ws://172.20.10.4:8080?access_token="  + String(<?= session()->get('student_id') ?>));
	
	// Start Connection
	conn.onopen = function(e) {
		console.log("====> (Studnet) Connection established! Now We are live :) ;) <====");
	};
	
	const studentID = <?= session()->get('student_id') ?>;
	
	// receive  Data
	conn.onmessage = function(e) {
		console.log(e.data);
		/*
		if(data = JSON.parse(e.data)){
			
		}
		*/
	};
	
	let videoStream = document.getElementById('videoStream');
	navigator.mediaDevices.getUserMedia({
		video: {
			width: 200,
			height: 200
		}
		
	}).then(function(stream){
		videoStream.srcObject = stream;
		
	});
	
	videoStream.addEventListener("playing", () => {
		//var interval = 
		setInterval(function (){
				
			let canvas = document.getElementById('canvas');
			let ctx = canvas.getContext("2d");
			
			// make size of canvas
			canvas.videoWidth = videoStream.videoWidth;
			canvas.videoHeight = videoStream.videoHeight;
			
			//void ctx.drawImage(image, sx, sy, sWidth, sHeight, dx, dy, dWidth, dHeight);
			//grab a frame from the video and place it to canvas
			ctx.drawImage(videoStream, 0, 0);
			
			//convert the image in canvas to base64 string to send it to other clients
			let base64Image = canvas.toDataURL('image/jpeg'); //canvas.toDataURL(); // PNG is the default
			
			let studentName = "<?= session()->get('student_fname') . " " . session()->get('student_lname') ?>";
			
			let sendData = {id: <?= session()->get('student_id') ?>,name: studentName, image: base64Image};
			
			conn.send(JSON.stringify(sendData));
				
		}, 100);
	});
	
	conn.addEventListener('close', function(e){
		console.log("Connection is Closed");
	});
	
</script>

</html>