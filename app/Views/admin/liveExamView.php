
		<style>
			#content main .table-data .todo {
				flex-grow: 0;
				margin-bottom: 30%;
				flex-basis: 23%;
			}
		</style>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Live Exam</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Admin') ?>">Dashboard</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin') ?>">Home</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin/current-exam') ?>">Current Exams</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="">Live Exam</a>
						</li>
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
				
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<p>Total Student</p>
						<h3 id="studentCount">0</h3>
					</span>
				</li>

				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<p>Courses</p>
						<h3><?= $courseTitle ?></h3>
					</span>
				</li>

				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text">
						<p>Exam Title</p>
						<h3><?= $examTitle ?></h3>
					</span>
				</li>
			</ul>










			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Sudents</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th> Status </th>
								<th> Details </th>
								<!-- <th>Status</th> -->
							</tr>
						</thead>
						<tbody id="studentList">
						
						</tbody>
					</table>
				</div>
				
				<div class="todo">
					<div class="head">
						<h3>Time Remaning</h3>
					</div>
					<br />
					<h2 id="time" style="text-align: center;"></h2>
					<h1 id="endTime"></h1>
				</div>
			</div>
			
			
			<!-- POPUP MODEL -->
			<div class="popup" id="popup-1">
				<div class="overlay"></div>
				<div class="content" style= " width:500px; height:auto">
						<div class="close-btn" onclick="stopPopupModel()">&times;</div>
						<!--<div id="receivedImage"></div>-->

						<div id="model-stuname-div">
							<p style="margin:10px 0px;" id="model-stuname"></p>
						</div>
						
						<video id="receivedVideo" width="100%" height="100%" autoplay poster="/img/Loading_icon.gif"></video>
						<img id="receivedImage" src="/img/Loading_icon.gif" width="100%" height="100%">
						<div id="capture-model" style="width: 100%;text-align:center;">

						</div>

				</div>
			</div>
			<!-- END POPUP MODEL -->
			
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	
<script>

	// Calculate The Remaning Time
	const endTime = new Date("<?= $endTime ?>").getTime();
	setInterval(function () {
		
		var now = new Date().getTime();
		var timeleft = endTime - now;
		
		var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
		
		if(hours == 0 && minutes <= 30)
			document.getElementById("time").style.color = "red";
		
		
		if (seconds >= 0){
			document.getElementById('time').innerHTML = hours + ":" + minutes + ":" + seconds;
		}else{
			document.getElementById('time').innerHTML = "Exam End";
			clearInterval();
			
		}	
	}, 
	1000);
	
</script>

<script>
// Show number of student in Exam
setInterval(function(){
	document.getElementById("studentCount").innerHTML = document.getElementById("studentList").rows.length;
}, 200);
</script>


<script src="<?= base_url() ?>/module/admin/script.js"></script>
<script src="<?= base_url() ?>/module/admin/js.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>

/*
	WebSocket ****************************************
	---------------------------------------------------------------------------------------------------
*/
const conn = new WebSocket('ws://localhost:8080/?user=admin&user_id=<?= session()->get("admin_id") ?>&examID=<?= $examID ?>');

conn.onopen = function(e) {
    console.log("Connection Established!");
};

conn.onclose = function(e){
	console.log("Connection is Closed!");
};

conn.onerror = function(error) {
  console.error('WebSocket Error: ' + error);
};
</script>

<script>
var studentImgID = 0;

var html = "";

var captureButtonHtml = "";


conn.onmessage = function(e) {
	
	console.log(JSON.parse(e.data));
	
	if(JSON.parse(e.data).hasOwnProperty('user') && JSON.parse(e.data).hasOwnProperty('name')){
		// Data from student
		let student = JSON.parse(e.data);
		
		html = "";
		captureButtonHtml = "";
		
		var data = {
			'<?= csrf_token() ?>':'<?= csrf_hash() ?>',
			userId: student.id,
			userName: student.name,
			// image: "data:image/png;base64," + student.img
		};
		
		html = "<tr id='stu-"+ student.id +"'><td>"+student.name+"</td><td><span class='status completed' id="+student.id+">Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent("+student.id+")'> View </button></td><td></td></tr>";
		
		// New ------------------------------------
		
		// Check if id exists if not create row for this student
		var studentIdElement = document.getElementById('stu-' + student.id);
		if(!studentIdElement){
			document.getElementById('studentList').innerHTML += html;
		}
		
		// Show Image and name of specific student
		if(studentImgID == student.id){
			// document.getElementById('receivedImage').src = "data:image/png;base64," + student.img;
			document.getElementById('model-stuname').innerHTML = "Student Name: " + student.name;
			
			// update Capture Button with new data
			captureButtonHtml = "<div id='c"+student.id+"'><button class='btn btn-info' style='background-color:#3C91E6;' name='add' type='button' onclick='ajaxRequest("+ JSON.stringify(data) +")'> Capture </button></div>";
			document.getElementById('capture-model').innerHTML = captureButtonHtml;
		}
		
	}else if(JSON.parse(e.data).hasOwnProperty('pythonResult')){
		let result = JSON.parse(e.data).pythonResult;
		if(result.id !== 0){
			if(result.status == 'Not Cheating'){
				document.getElementById('stu-' + result.id).innerHTML = "Not Cheating";
					
				document.getElementById('stu-' + result.id).classList.remove("pending");
				document.getElementById('stu-' + result.id).classList.add("completed");

			}else{
				document.getElementById('stu-' + result.id).innerHTML = "Cheating";
				
				document.getElementById('stu-' + result.id).classList.remove("completed");
				document.getElementById('stu-' + result.id).classList.add("pending");
			}
		}
		
	}else if(JSON.parse(e.data).hasOwnProperty('isClosed')){
		// Remove student from HTML table
		let studentClose = JSON.parse(e.data).isClosed;
		
		document.getElementById('stu-' + studentClose.studentId).remove();
		
	}else if(JSON.parse(e.data).hasOwnProperty('offer')){
		console.log('Offer is here!');
		peer.setRemoteDescription(JSON.parse(e.data).offer);
		createAndSendAnswer(JSON.parse(e.data).studentId);
		
	}else if(JSON.parse(e.data).hasOwnProperty('candidate')){
		console.log('candidate is here!');
		peer.addIceCandidate(JSON.parse(e.data).candidate);
	}
	
}



function showStudent(stuID){
	studentImgID = stuID;
	showPopupModel();
	
	connectStream(stuID);
}


function showPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}

function stopPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
	studentImgID = 0;

	// document.getElementById('receivedImage').src ='/img/Loading_icon.gif';
	document.getElementById('model-stuname').innerHTML = "Student Name: ";
	
	conn.send(JSON.stringify({user: 'admin', disconnectWebRTC: true, studentID: studentIDConnection, adminID: '<?= session()->get("admin_id") ?>'}));
	// peer.close();
}
</script>



<script>
// AJAX Request --------------------------------------------


// ******* NOTE ******* 

// When AJAX Request the auth redirect the request to Admin Page which is the Dashboard
// So we need to create new filter for function that handle AJAX request

// When i add JSON.stringify(data) and contentType it sended
// You are not sending JSON, but a key = value pair
// You need to convert JS object to JSON
// data : JSON.stringify({'<?= csrf_token() ?>':'<?= csrf_hash() ?>'}),


function ajaxRequest(data){
	
	let endPoint = "/handleAjax/";
	
	$.ajax({
		url: endPoint,
		type: "POST",
		contentType: "application/json",
		
		// Data need to be sended in JSON format
		data: JSON.stringify(data),
		
		success: function (suc){
			console.log("Success!");
			
		},
		error: function(xhr, status, error) {
		  console.log("Error: " + error);
		  
		},
		complete: function(response) {
			console.log(response.responseText)
		}
	});
	
}
</script>


<script type="text/javascript" src="/assets/js/peerjs.js"></script>

<script>
/*
	WebRTC ******************************************
*/
let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302", 
                    "stun:stun1.l.google.com:19302", 
                    "stun:stun2.l.google.com:19302"]
                }
            ]
        }
let pcConfig = {
	'iceServers': [
		{
			'urls': 'stun:stun.l.google.com:19302'
		},
		{
			'urls': 'turn:192.158.29.39:3478?transport=udp',
			'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
			'username': '28224511:1379330808'
		},
		{
			'urls': 'turn:192.158.29.39:3478?transport=tcp',
			'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
			'username': '28224511:1379330808'
		}
	]
};

var studentIDConnection;

var peer = new RTCPeerConnection(pcConfig);

peer.ontrack = function(e){
	console.log('On Tracker!');
	console.log(e.streams[0]);
	document.getElementById('receivedVideo').srcObject = e.streams[0];
};

peer.onicecandidate = function(e){
	if (e.candidate == null)
		return
	
	console.log('Sending Canidate!');
	conn.send(JSON.stringify({user: 'admin', candidate: e.candidate, studentID: studentIDConnection, adminID: '<?= session()->get("admin_id") ?>'}));
}


function connectStream(studentId) {
	studentIDConnection = studentId;
	conn.send(JSON.stringify({user: "admin", studentID: studentId, adminID: '<?= session()->get("admin_id") ?>'}));
}

function createAndSendAnswer(studentID){
	peer.createAnswer().then(function(answer) {
		console.log('Sending Answer!');
		conn.send(JSON.stringify({user: 'admin', answer: answer, studentID: studentID, adminID: '<?= session()->get("admin_id") ?>'}));
		return peer.setLocalDescription(answer);
	})
	.catch(function(error){
		console.log('Error Create Answer! + ' + error);
	});
}



</script>


<script>
var receivedVideo = document.getElementById('receivedVideo');
var receivedImage = document.getElementById('receivedImage');
receivedImage.style.display = 'none'; 

</script>