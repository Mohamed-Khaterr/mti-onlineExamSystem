
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
						
						<tr>
							<td>
								Mohamed Khater
							</td>
							
							<td>
								<span class='status completed'>Not Cheating</span>
							</td>
								
							<td id="view">
								<button class="btn btn-info" style="background-color:#3C91E6;" onclick="showStudent()"> View </button>
							</td>
						</tr>
								
						<tr>
								<td>
									<img 	style="width: 150px;  	height: 150px;" id = 'img1' >
									<p id='n1'></p>
								</td>

								<td> <button class="btn btn-info" style="background-color:#3C91E6;" onclick="togell()" id='btn1'> Monitor </button>
								
									
								</td>
								
							
								<td >
									<p	id='s1'></p> </td>
							
							</tr>
							<tr>
								<td>
									<img  style="width: 150px;  	height: 150px;" id = 'img2' >
									<p id='n2'></p>
								</td>

								<td>  <button class="btn btn-info" style="background-color:#3C91E6;" onclick="togell2()" id='btn2'> Monitor </button>
								
									
								</td>
								
							
								<td >
									<p	id='s2'></p></td>
							</tr>
							-->
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
				<div class="content">
						<div class="close-btn" onclick="stopPopupModel()">&times;</div>
						<!--<div id="receivedImage"></div>-->
						<img id="receivedImage" width="50" height="50">
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
	
	
	/* Web Socket */
	// var conn = new WebSocket("ws://192.168.1.6:8080?access_token=");
	//var conn = new WebSocket("ws://172.20.10.4:8080?access_token=");

	// Start Connection
	// conn.onopen = function(e) {
	// 	console.log("====> Admin is in Connection :) <====");
	// };
	
	// //window.onload = function(){
	// 	// receive  Data
	// 	conn.onmessage = function(e) {
	// 		console.log(e.data);
	// 		/* NEW */
	// 		if(data = JSON.parse(e.data)){
	// 			//console.log(data);
	// 			var html = '';

	// 			if('student' in data){
	// 				//console.log(data);
	// 				const students = data.student;
	// 				document.getElementById('studentList').innerHTML = '';
					
	// 				// Number of student in the Exam
	// 				document.getElementById('studentCount').innerHTML = students.length;
					
					
					
	// 				students.forEach(function (e) {
						
	// 					if (e.student_isCheating == 'yes'){
	// 						html = "<tr>  <td id='s"+ e.student_id +"'></td>  <td><p id='studentName'> " + e['student_name'] + "</p></td>      <td><span class='status pending'>Cheating</span></td> <td><a title='Student Video' > <button style='border: none;' onclick='showStudent("+e.student_id+")'>Show</button> </a> </td> </tr>";
						
	// 					}else{
	// 						html = "<tr> <td id='s"+ e.student_id +"'></td>  <td><p id='studentName'> " + e['student_name'] + "</p></td><td><span class='status completed'>Not Cheating</span></td>  <td> <a title='Student Video' > <button style='border: none;' onclick='showStudent("+e.student_id+")'>Show</button> </a> </td>  </tr>";
	// 					}
						
	// 					document.getElementById('studentList').innerHTML += html
						
	// 				});
					
					
	// 			}else if ('image' in data && studentID == data.id){
	// 				//receivedImage
	// 				html = '<p>Student Name: '+data.name+' (ID: '+data.id+') <hr /></p><img height="200" width="200"   id="img" src="'+data.image+'">';
	// 				document.getElementById('receivedImage').innerHTML = html;
	// 				studentID = data.id;
	// 				//console.log(data.image);
				
	// 			}
	// 		}
			
	// 	};
	// //}
	
	// var studentID = null;
	/*
	 function showStudent(){
		showPopupModel();
	 }
	
	
	 function showPopupModel(){
		document.getElementById("popup-1").classList.toggle("active");
	 }
	
	 function stopPopupModel(){
		document.getElementById("popup-1").classList.toggle("active");
	 }
	*/
	// conn.addEventListener('close', function(e){
	// 	console.log("Connection is Closed");
	// });
	
	// conn.addEventListener('error', function(e){
	// 	console.log("Error! Connection Faild: " + e);
	// });
	

	
</script>

<script>
	  const conn = new WebSocket('ws://localhost:8080/?token=<?php
	  echo $userObj->sessionID;
	  ?>');
</script>

	<script src="/assets/js/admin.js"></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>