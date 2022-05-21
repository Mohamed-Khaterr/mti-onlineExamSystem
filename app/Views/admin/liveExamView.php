
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
						<h3 id="studentCount">2</h3>
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
	
</script>

<script>
	  const conn = new WebSocket('ws://localhost:8080/?token=<?php
	  echo $userObj->sessionID;
	  ?>');
</script>

<!--<script src="/assets/js/admin.js"></script>-->
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>

<script src="<?= base_url() ?>/module/admin/script.js"></script>
<script src="<?= base_url() ?>/module/admin/js.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>

/*
 WEB RTC METHODS 
 ---------------------------------------------------------------------------------------------------
*/


conn.onopen = function(e) {
    //conn.send("{'type': 'newconnection', 'content': '1'}");
    console.log("Connection established!");
};


var studentImgID = 0;

var c=5;
var arr={

	1:{count:0},
	2:{count:0},
	3:{count:0},
	4:{count:0},
	5:{count:0},
	
	
};
var array = [];
var status=[0 ,0 ,0 ,0];
conn.onmessage = function(e) {
	if(e.data ==="hi"){
	}else{

		let student = JSON.parse(e.data);
		
		let name = student.User;
		
		
		// Show Image of specific student
		if(studentImgID == student.id){
			document.getElementById('receivedImage').src = "data:image/png;base64," + student.img;
			console.log("this Image for: " + name);
		}
		
		// AJAX Data
		let data = {
			'<?= csrf_token() ?>':'<?= csrf_hash() ?>',
			userId: student.id,
			userName: name,
			image: "data:image/png;base64," + student.img,
			examID: "<?= $examID ?>",
		};


		var html = "";
		if(!array.includes(student.id)){
			array.push(student.id);


			if(arr[student.id].hasOwnProperty('count')){
				if(student.status === 'ok'){
					arr[student.id]={count:5};
					c=5
					//document.getElementById('s1').innerText ='not cheating';

					html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+" >Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent("+ student.id +")'> View </button></td><td><button class='btn btn-info' style='background-color:#3C91E6;' name='add' type='button' onclick='ajaxRequest("+ JSON.stringify(data) +")'> Capture </button></td></tr>";

				}else{

					var counter = arr[student.id].count
					counter--;
					arr[student.id]={count:counter};
					// count --;
					if(arr[student.id].count <= 0 || isNaN(arr[student.id].count)){
						//document.getElementById('s1').innerText = 'Cheating';


						html = "<tr><td>"+name+"</td><td><span class='status pending' id="+student.id+">Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent("+ student.id +")'> View </button></td><td><button class='btn btn-info' style='background-color:#3C91E6;' name='add' type='button' onclick='ajaxRequest("+ JSON.stringify(data) +")'> Capture </button></td></tr>";


					}else{
						//document.getElementById('s1').innerText ='not cheating';

						html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+">Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent("+ student.id +")'> View </button></td><td><button class='btn btn-info' style='background-color:#3C91E6;' name='add' type='button' onclick='ajaxRequest("+ JSON.stringify(data) +")'> Capture </button></td></tr>";
					}

				}
			}else{
				html = "<tr><td>"+name+"</td><td><span class='status pending' id="+student.id+">Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent("+ student.id +")'> View </button></td><td><button class='btn btn-info' style='background-color:#3C91E6;' name='add' type='button' onclick='ajaxRequest("+ JSON.stringify(data) +")'> Capture </button></td></tr>";
			}

			document.getElementById('studentList').innerHTML += html;




		}else{


			console.log(arr[student.id]);
			if(arr[student.id].hasOwnProperty('count')){
				if(student.status === 'ok'){
					arr[student.id]={count:5};

					c=5
					document.getElementById(student.id).innerHTML="Not Cheating";
					
					document.getElementById(student.id).classList.remove("pending");
					document.getElementById(student.id).classList.add("completed");
				}

				else{

					var counter = arr[student.id].count
					counter--;
					arr[student.id]={count:counter};
					if(arr[student.id].count <= 0 || isNaN(arr[student.id].count)){

						document.getElementById(student.id).innerHTML="Cheating";
						
						document.getElementById(student.id).classList.remove("completed");
						document.getElementById(student.id).classList.add("pending");
						
					}else{
						document.getElementById(student.id).innerHTML="Not Cheating";
						
						document.getElementById(student.id).classList.remove("pending");
						document.getElementById(student.id).classList.add("completed");
					}

				}

			}else{
				document.getElementById(student.id).innerHTML="Cheating";
				
				document.getElementById(student.id).classList.remove("completed");
				document.getElementById(student.id).classList.add("pending");
			}
		}
	}
}


</script>




<script>

// POPUP Model

function showStudent(stuID){
	studentImgID = stuID;
	showPopupModel();
}


function showPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}

function stopPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
	studentImgID = 0;
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