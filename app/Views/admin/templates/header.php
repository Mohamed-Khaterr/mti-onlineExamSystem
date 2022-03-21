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
	
</head>
<body>

<?php
	$dashboard = false;
	$currentExam = false;
	$createExam = false;
	$profile = false;
	$verifyExams = false;
	
	if($sideBar == 'dashboard'){
		$dashboard = true;
	}elseif ($sideBar == 'currentExam'){
		$currentExam = true;
	}elseif ($sideBar == 'profile'){
		$profile = true;
	}elseif ($sideBar == 'verifyExams'){
		$verifyExams = true;
	}
	
?>

<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Welcome</span>
		</a>
		<ul class="side-menu top">
			<li class="<?php echo $dashboard ? "active": ""?>">
				<a href="<?= base_url('Admin') ?>">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			
			<li class="<?php echo $currentExam ? "active":"" ?>">
				<a href="<?= base_url("Admin/current-exam") ?>">
					<i class='bx bxs-group' ></i>
					<span class="text">Current Exams</span>
				</a>
			</li>
			
			<li class="<?php echo $verifyExams ? "active":"" ?>">
				<a href="<?= base_url('Admin/verify-exams') ?>">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Verify Exams</span>
				</a>
			</li>


			<li class="<?php echo $profile ? "active":"" ?>">
				<a href="<?= base_url("Admin/profile") ?>">
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
			<a href="" class="nav-link">Categories</a>
			<form action="">
				<div class="form-input">
					
				</div>
			</form>


			
			<a href="" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="<?= base_url() ?>/Admin/profile" class="profile">
				<img src="<?= base_url() ?>/module/admin/img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->