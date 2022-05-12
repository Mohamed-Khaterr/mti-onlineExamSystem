<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/css.css">
	
	

	<title>Online Exam System</title>
	
	
	<script type="text/javascript">
		var countBox = 4;
		function addChoice(){
			
			document.getElementById("addChoice").innerHTML += '<div class="col-md-3"><label for="inputCity" class="form-label">Choose : '+countBox+' </label><input name="options[]" type="text" class="form-control" id="inputCity"></div>';
			countBox += 1;
			
			
		}
		
		function addChoice(counter){
			if(counter > countBox)
				countBox = counter;
			document.getElementById("addChoice").innerHTML += '<div class="d-flex justify-content-between mt-3"><div class="col-md-3"><label for="inputCity" class="form-label" id="deleteInput">Choose : '+countBox+' </label><input name="options[]" type="text" class="form-control" id="deleteInput"></div></div>';
			countBox ++;
		}
		
		function addChoice2(counter){
			if(counter > countBox){
				countBox = counter;
				document.getElementById("addChoice2").innerHTML += '<br />---- NEW ----';
			}
			
			document.getElementById("addChoice2").innerHTML += '<div class="d-flex justify-content-between mt-3"><div class="col-md-3"><label for="inputCity" class="form-label" id="deleteInput">Choose : '+countBox+' </label><input name="options[]" type="text" class="form-control" id="deleteInput"></div></div>';
			
			countBox ++;
		}
		
		function deleteChoice(){
			var arr = document.querySelectorAll("#deleteInput");
			var len = document.querySelectorAll("#deleteInput").length;
			arr[len - 2].remove();
			arr[len - 1].remove();
		}
		
		
		
		
		function searchBar() {
		  // Declare variables
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("userInput");
		  
		  filter = input.value.toUpperCase();
		  table = document.getElementById("tableID");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[1];
			if (td) {
			  txtValue = td.textContent || td.innerText;
			  if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}
		  }
		}
	</script>
	
</head>
<body>

<?php
	
	// get uri to get second Segment
	$uri = service('uri');
	
?>

<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="" class="brand">
			<i class='bx '></i>
			<span class="text">MTI UNVERSITY</span>
		</a>
		<ul class="side-menu top">
			<li class="<?= $uri->getSegment(2) == 'dashboard' || $uri->getSegment(2) == ''? "active": null ?>">
				<a href="<?= base_url('Doctor/dashboard') ?>">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			
			<li class="<?= $uri->getSegment(2) == 'create-exam'? "active": null ?>">
				<a href="<?= base_url("Doctor/create-exam") ?>">
					<i class='bx bxs-news' ></i>
					<span class="text">Create Exam</span>
				</a>
			</li>
			
			<li class="<?= $uri->getSegment(2) == 'exams'? "active": null ?>">
				<a href="<?= base_url('Doctor/exams') ?>">
					<i class='bx bx-task' ></i>
					<span class="text">Exams</span>
				</a>
			</li>


			<li class="<?= $uri->getSegment(2) == 'profile'? "active": null ?>">
				<a href="<?= base_url("Doctor/profile") ?>">
					<i class='bx bxs-group' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			
			
			
			
		</ul>
		<ul class="side-menu">
		
			
			<li>
				<a href="<?= base_url("Logout") ?>" class="logout">
					<i class='bx bx-log-out' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="" class="nav-link"><h3>Doctor</h3></a>
			<form action="">
				<div class="form-input">
					
				</div>
			</form>
			
		</nav>
		<!-- NAVBAR -->