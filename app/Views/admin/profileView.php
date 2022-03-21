<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    

	<!-- Favicons -->
	<link href="<?= base_url() ?>/module/admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>/module/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/module/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>/module/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/module/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="<?= base_url() ?>/module/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="<?= base_url() ?>/module/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url() ?>/module/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->


	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- My CSS -->
    <link href="<?= base_url() ?>/module/admin/assets/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/css.css">

	<title>Online Exam System</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Welcome</span>
		</a>
		<ul class="side-menu top p-0">
			<li>
				<a href="<?= base_url('Admin') ?>">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="">
				<a href="<?= base_url('Admin/current-exam') ?>">
					<i class='bx bxs-group' ></i>
					<span class="text">Current Exams</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Create Exam</span>
				</a>
			</li>


			<li class="active">
				<a href="<?= base_url('Admin/profile') ?>">
					<i class='bx bxs-cog' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			
			
			
			
			
		</ul>

		<ul class="side-menu p-0">
			<li>
				<a href="<?= base_url('Logout') ?>" class="logout">
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
			<a href="<?= base_url('Admin/profile') ?>" class="profile">
				<img src="<?= base_url() ?>/module/admin/img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Profile</h1>
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
							<a class="active" href="<?= base_url('Admin/profile') ?>">Profile</a>
						</li>
						
					</ul>
				</div>
				
			</div>






			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3> Profile</h3>
                            
                        </div>
                    </div>




					<h4><?= $isErrorInEditProfile ? "There is error in Edit Profile": "" ?></h4>
					<h4><?= $isErrorChangePassword ? "There is error Changing Password": "" ?></h4>
                    
					
					<section class="section profile">
                        <div class="row">
                          <div class="col-xl-4">
                  
                            <div class="card">
                              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                  
                                <img src="<?= base_url() ?>/module/admin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                <h2><?= $firstName . " " . $lastName ?></h2>
                                <div class="social-links mt-2">
                                </div>
                              </div>
                            </div>
                          </div>
                  
                  
                   
                          <div class="col-xl-8">
						  
						 
                  
                            <div class="card">
                              <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                  
                                  <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                  </li>
                  
                                  <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                  </li>
                  
                                  <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                  </li>
                  
                                </ul>
                  
                                <div class="tab-content pt-2">
                  
                                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    
                                    <h5 class="card-title"></h5>
                  
                                    <div class="row"> 
                                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                      <div class="col-lg-9 col-md-8"><?= $firstName . " " . $lastName ?></div>
                                    </div>
                  
                  
                  
                                    <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Email</div>
                                      <div class="col-lg-9 col-md-8"><?= $email ?></div>
                                    </div>
                  
                                  </div>
                  
                  
                  
                  
                                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  
                                    
                                    <!-- Profile Edit Form -->
                                    <form method="POST">
									<?= csrf_field(); ?>
									
                                      <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                          <img src="<?= base_url() ?>/module/admin/assets/img/profile-img.jpg" alt="Profile">
                                          <div class="pt-2">
                                            <a href="" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                            <a href="" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                          </div>
                                        </div>
                                      </div>
                  
                                      <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="firstName" type="text" class="form-control" id="fullName" value="<?= $firstName ?>">
											
											<?php
												if(isset($firstNameError)){
													echo $firstNameError;
													
												}
											?>
										</div>
                                      </div>
                  
									  <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="lastName" type="text" class="form-control" id="fullName" value="<?= $lastName ?>">
											<?php
												if(isset($lastNameError)){
													echo $lastNameError;
													
												}
											?>
									   </div>
                                      </div>
                  
                                      <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="email" type="email" class="form-control" id="Email" value="<?= $email ?>">
											<?php
												if(isset($emailError)){
													echo $emailError;
													
												}
											?>
										</div>
                                      </div>
                  
                  
                                      <div class="text-center">
                                        <button name="saveChanges" type="submit" class="btn btn-primary">Save Changes</button>
                                      </div>
                                    </form>
									<!-- End Profile Edit Form -->
                  
                                  </div>
                  
                  
                                  <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="POST">
									<?= csrf_field(); ?>
                  
                                      <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="password" type="password" class="form-control" id="currentPassword">
											<?php
												if(isset($passwordError)){
													echo $passwordError;
													
												}elseif(isset($oldPasswordError)){
													echo $oldPasswordError;
												}
											?>
										</div>
                                      </div>
									  
									 
                  
                                      <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="newpassword" type="password" class="form-control" id="newPassword">
											<?php
												if(isset($newpasswordError)){
													echo $newpasswordError;
													
												}
											?>
									   </div>
                                      </div>
									  
									  
                  
                                      <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                          <input name="renewpassword" type="password" class="form-control" id="renewPassword">
											<?php
												if(isset($renewpasswordError)){
													echo $renewpasswordError;
													
												}
											?>
										</div>
                                      </div>
									  
									  
                  
                                      <div class="text-center">
                                        <button name="saveChangePassword" type="submit" class="btn btn-primary">Change Password</button>
                                      </div>
                                    </form><!-- End Change Password Form -->
                  
                                  </div>
                  
                                </div><!-- End Bordered Tabs -->
                  
                              </div>
                            </div>
                  
                          </div>
                        </div>
                      </section>











				</div>
			</div>





            

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	

	<script src="<?= base_url() ?>/module/admin/script.js"></script>
    <script src="<?= base_url() ?>/module/admin/js.js"></script>

</body>
</html>