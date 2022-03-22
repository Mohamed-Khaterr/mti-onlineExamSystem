<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	
	
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/css.css">
	
	

	<title>Online Exam System</title>
	
	
	<script type="text/javascript">
		var countBox = 4;
		function addChoice(){
			
			document.getElementById("addChoice").innerHTML += '<div class="col-md-3"><label for="inputCity" class="form-label">Option : '+countBox+' </label><input name="options[]" type="text" class="form-control" id="inputCity"></div>';
			countBox += 1;
			
			
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
	$dashboard = false;
	$createExam = false;
	$exams = false;
	$profile = false;
	$createQuestion = false;
	
	
	if($sideBar == 'dashboard'){
		$dashboard = true;
	}elseif ($sideBar == 'createExam'){
		$createExam = true;
	}elseif ($sideBar == 'profile'){
		$profile = true;
	}elseif ($sideBar == 'exams'){
		$exams = true;
	}elseif ($sideBar == 'createQuestion'){
		$createQuestion = true;
	}
	
?>

<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="" class="brand">
			<i class='bx '></i>
			<span class="text">MTI UNVERSITY</span>
		</a>
		<ul class="side-menu top">
			<li class="<?php echo $dashboard ? "active": ""?>">
				<a href="<?= base_url('Doctor/dashboard') ?>">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			
			<li class="<?php echo $createExam ? "active":"" ?>">
				<a href="<?= base_url("Doctor/create-exam") ?>">
					<i class='bx bxs-group' ></i>
					<span class="text">Create Exams</span>
				</a>
			</li>
			
			<li class="<?php echo $createQuestion ? "active":"" ?>">
				<a href="<?= base_url('Doctor/create-question') ?>">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Create Question</span>
				</a>
			</li>
			
			<li class="<?php echo $exams ? "active":"" ?>">
				<a href="<?= base_url('Doctor/exams') ?>">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Exams</span>
				</a>
			</li>


			<li class="<?php echo $profile ? "active":"" ?>">
				<a href="<?= base_url("Doctor/dashboard") ?>">
					<i class='bx bxs-cog' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			
			
			
			
		</ul>
		<ul class="side-menu">
		
			
			<li>
				<a href="<?= base_url("Logout") ?>" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
			<a href="" class="nav-link">Doctor</a>
			<form action="">
				<div class="form-input">
					
				</div>
			</form>
			
		</nav>
		<!-- NAVBAR -->