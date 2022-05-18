
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

<script src="/assets/js/admin.js"></script>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>

<script src="<?= base_url() ?>/module/admin/script.js"></script>
<script src="<?= base_url() ?>/module/admin/js.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>



/*
 WEB RTC METHODS 
 ---------------------------------------------------------------------------------------------------
*/


function add(data){
	$.ajax({
		url: "<?= base_url('send') ?>",
		type: "POST",
		data: data,
		
		headers: {'X-Requested-With': 'XMLHttpRequest'},
		
		success: function (response){
			console.log("success");
			
		},
		error: function(xhr, status, error) {
		  console.log("Error: " + error);
		  //console.log(xhr.responseText);
		  
		},
		complete: function(data) {
			console.log(data.statusText);
		}
	});
}


conn.onopen = function(e) {
    //conn.send("{'type': 'newconnection', 'content': '1'}");
    console.log("Connection established!");
};


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
		
		let data = {
			"<?= csrf_token() ?>": "<?= csrf_hash() ?>",
		}
		
		
			let name = student.User;
			
			
			var html = "";
			if(!array.includes(student.id)){
				array.push(student.id);

				const img = document.getElementById('receivedImage');
			img.src = "data:image/png;base64," + student.img;

			
			if(arr[student.id].hasOwnProperty('count')){
			if(student.status === 'ok'){
				arr[student.id]={count:5};
				 c=5
				//document.getElementById('s1').innerText ='not cheating';
				
				html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+" >Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td><td><button name='add' type='button' onclick="+add(data)+"> Add </button></td></tr>";
				
			}else{
				
				var counter = arr[student.id].count
				counter--;
				arr[student.id]={count:counter};
				// count --;
				if(arr[student.id].count <= 0 || isNaN(arr[student.id].count)){
					//document.getElementById('s1').innerText = 'Cheating';


					html = "<tr><td>"+name+"</td><td><span class='status pending' id="+student.id+">Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td><td><button name='add' type='button' onclick="+add(data)+"> Add </button></td></tr>";
			
					
				}else{
					//document.getElementById('s1').innerText ='not cheating';
					
					html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+">Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td><td><button name='add' type='button' onclick="+add(data)+"> Add </button></td></tr>";
				}
				
			}
		}else{
			html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+">Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td><td><button name='add' type='button' onclick="+add(data)+"> Add </button></td></tr>";
		}
			
			document.getElementById('studentList').innerHTML += html;



				
			}else{

				
				console.log(arr[student.id]);
				if(arr[student.id].hasOwnProperty('count')){
				if(student.status === 'ok'){
					arr[student.id]={count:5};
				
					c=5
					document.getElementById(student.id).innerHTML="Not Cheating";
				}

				else{

					var counter = arr[student.id].count
					counter--;
					arr[student.id]={count:counter};
					if(arr[student.id].count <= 0 || isNaN(arr[student.id].count)){
						
						document.getElementById(student.id).innerHTML="Cheating";
				
						
					}else{
						document.getElementById(student.id).innerHTML="Not Cheating";
					}
					
				}
			
			}else{
				document.getElementById(student.id).innerHTML="Cheating";

			}


				
			}
			

	}
}

function showStudent(){
	showPopupModel();
}


function showPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}

function stopPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}








/*
 Other JS Functionalities
 ---------------------------------------------------------------------------------------------------
*/





const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})





// -----------------------------------------------------------------------------------------------------------



function togell(){
    
    var x = document.getElementById("img1");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    
    
  }

  function togell2(){
    var x = document.getElementById("img2");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  
  function togell3(){
    var x = document.getElementById("img3");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>