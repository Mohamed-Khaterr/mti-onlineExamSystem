<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	
	<link href="/assets/img/MTI.png" rel="icon">
  <link href="/assets/img/MTI.png" rel="apple-touch-icon">
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/css.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/popupModel.css">
	

	<title>Online Exam System</title>
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
			<li class="<?= $uri->getSegment(2) == '' ? "active": null  ?>">
				<a href="<?= base_url('Admin') ?>">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			
			<li class="<?= $uri->getSegment(2) == 'current-exam' ? "active" : null  ?>">
				<a href="<?= base_url("Admin/current-exam") ?>">
					<i class='bx bxs-news' ></i>
					<span class="text">Current Exams</span>
				</a>
			</li>
			<!--
			<li class="<?= $uri->getSegment(2) == 'verify-exams' ? "active" : null  ?>">
				<a href="<?= base_url('Admin/verify-exams') ?>">
					<i class='bx bx-task' ></i>
					<span class="text">Accept Exams</span>
				</a>
			</li>
			-->
			

			<li class="<?= $uri->getSegment(2) == 'reports'|| $uri->getSegment(2) == 'report' ? "active" : null  ?>">
				<a href="<?= base_url("Admin/reports") ?>">
					<i class='bx bxs-news' ></i>
					<span class="text">Reports</span>
				</a>
			</li>

			<li class="<?= $uri->getSegment(2) == 'create-user' ? "active" : null  ?>">
				<a href="<?= base_url('Admin/create-user') ?>">
					<i class='bx bxs-user-plus' ></i>
					<span class="text">Users</span>
				</a>
			</li>


			<li class="<?= $uri->getSegment(2) == 'profile' ? "active" : null  ?>">
				<a href="<?= base_url("Admin/profile") ?>">
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
			<a href="" class="nav-link"><h3>Admin</h3></a>
			<form action="">
				<div class="form-input">
					
				</div>
			</form>


			<!--
			<a href="" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			-->
			<div>
			</div>
			<!--
			<a href="<?= base_url() ?>/Admin/profile" class="profile">
				<img src="<?= base_url() ?>/module/admin/assets/img/profile-img.jpg">
			</a>
			-->
		</nav>
		<!-- NAVBAR -->