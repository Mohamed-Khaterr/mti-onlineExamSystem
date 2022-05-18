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
	
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/popupModel.css">

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
			<i class='bx '></i>
			<span class="text">MTI UNVERSITY</span>
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
					<i class='bx bxs-news' ></i>
					<span class="text">Current Exams</span>
				</a>
			</li>
			
			
			<li class="">
				<a href="<?= base_url("Admin/report") ?>">
					<i class='bx bxs-news' ></i>
					<span class="text">Report</span>
				</a>
			</li>


			<li class="active">
				<a href="<?= base_url('Admin/create-user') ?>">
					<i class='bx bxs-user-plus' ></i>
					<span class="text">Users</span>
				</a>
			</li>

			<li class="">
				<a href="<?= base_url('Admin/profile') ?>">
					<i class='bx bxs-group' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			
			
			
			
			
		</ul>

		<ul class="side-menu p-0">
			<li>
				<a href="<?= base_url('Logout') ?>" class="logout">
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
			<form action="#">
				<div class="form-input">
					
				</div>
			</form>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Create User</h1>
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
							<a class="active" href="<?= base_url('Admin/create-user') ?>">Create User</a>
						</li>
						
					</ul>
				</div>
				
			</div>






			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3>New User</h3>
                            
                        </div>
                    </div>






                    <section class="section profile">
                        <div class="row">
                  
                  
                          <div class="col-xl-8">
                  
                            <div class="card">
                              <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                  
                                  <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#regist-doctor">Regist Doctor</button>
                                  </li>
                  
                                  <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#regist-student">Regist Student</button>
                                  </li>
                  
                                  <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#enroll-doctor">Enroll Doctor</button>
                                  </li>
                  
                                  <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#enroll-student">Regist Student</button>
                                  </li>
                  
                                </ul>
                  
                                <div class="tab-content pt-2">
								
                  
                                    <div class="tab-pane fade pt-3 show active" id="regist-doctor">
                  
										<!-- Regist Doctor -->
										<form method="POST">
										<?= csrf_field(); ?>
										
											<div class="row mb-3">
												<label for="faculty" class="col-md-4 col-lg-3 col-form-label">Faculty</label>
												<div class="col-md-8 col-lg-9">
													<select name="faculty" class="form-control" id="faculty">
														<option disabled selected>Choose Faculty</option>
														<?php foreach($faculties as $faculty): ?>
															<option value="<?= $faculty['id'] ?>"><?= $faculty['name'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
					  
										  <div class="row mb-3">
											<label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
											<div class="col-md-8 col-lg-9">
											  <input name="fullName" type="text" class="form-control" id="fullName" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="Gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
											<div class="col-md-8 col-lg-9">
												<select name="gender" class="form-control" id="Gender">
													<option disabled selected>Choose Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										  </div>
					  
					  
					  
										  <div class="row mb-3">
											<label for="Birthday" class="col-md-4 col-lg-3 col-form-label">Birthday</label>
											<div class="col-md-8 col-lg-9">
											  <input name="birthday" type="date" class="form-control" id="Birthday">
											</div>
										  </div>
					  
					  
					  
										  <div class="row mb-3">
											<label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
											<div class="col-md-8 col-lg-9">
											  <input name="email" type="email" class="form-control" id="Email" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="currentPassword" class="col-md-4 col-lg-3 col-form-label"> Password</label>
											<div class="col-md-8 col-lg-9">
											  <input name="password" type="password" class="form-control" id="currentPassword">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="ConfirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
											<div class="col-md-8 col-lg-9">
											  <input name="confirmPassword" type="password" class="form-control" id="ConfirmPassword">
											</div>
										  </div>
					  
					  
										  <div class="text-center">
											<button type="submit" name="submitDoctor" class="btn btn-primary">Sumit</button>
										  </div>
										</form>
                                    </div>
									<!-- End Regaster Doctor Form -->
									
									
									<!-- Regist Student -->
                                    <div class="tab-pane fade pt-3" id="regist-student">
										<form method="POST">
										<?= csrf_field(); ?>
											<div class="row mb-3">
												<label for="faculty" class="col-md-4 col-lg-3 col-form-label">Faculty</label>
												<div class="col-md-8 col-lg-9">
													<select name="faculty" class="form-control" id="faculty">
														<option disabled selected>Choose Faculty</option>
														<?php foreach($faculties as $faculty): ?>
															<option value="<?= $faculty['id'] ?>"><?= $faculty['name'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
					  
										  <div class="row mb-3">
											<label for="firstName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
											<div class="col-md-8 col-lg-9">
											  <input name="firstName" type="text" class="form-control" id="firstName" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="lastName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
											<div class="col-md-8 col-lg-9">
											  <input name="lastName" type="text" class="form-control" id="lastName" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="level" class="col-md-4 col-lg-3 col-form-label">Level</label>
											<div class="col-md-8 col-lg-9">
											  <input name="level" type="number" class="form-control" id="level" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="gpa" class="col-md-4 col-lg-3 col-form-label">GPA</label>
											<div class="col-md-8 col-lg-9">
											  <input name="gpa" type="number" step="0.001" class="form-control" id="gpa" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="Gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
											<div class="col-md-8 col-lg-9">
												<select name="gender" class="form-control" id="Gender">
													<option disabled selected>Choose Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										  </div>
					  
					  
					  
										  <div class="row mb-3">
											<label for="Birthday" class="col-md-4 col-lg-3 col-form-label">Birthday</label>
											<div class="col-md-8 col-lg-9">
											  <input name="birthday" type="date" class="form-control" id="Birthday">
											</div>
										  </div>
					  
					  
					  
										  <div class="row mb-3">
											<label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
											<div class="col-md-8 col-lg-9">
											  <input name="email" type="email" class="form-control" id="Email" value="">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="currentPassword" class="col-md-4 col-lg-3 col-form-label"> Password</label>
											<div class="col-md-8 col-lg-9">
											  <input name="password" type="password" class="form-control" id="currentPassword">
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="ConfirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
											<div class="col-md-8 col-lg-9">
											  <input name="confirmPassword" type="password" class="form-control" id="ConfirmPassword">
											</div>
										  </div>
					  
					  
										  <div class="text-center">
											<button type="submit" name="submitStudent" class="btn btn-primary">Sumit</button>
										  </div>
										</form>
                                    </div>
									<!-- End Regaster Student Form -->
									
									
									<!-- Enroll Doctor -->
                                    <div class="tab-pane fade pt-3" id="enroll-doctor">
										<form method="POST">
										<?= csrf_field(); ?>
											<div class="row mb-3">
												<label for="faculty" class="col-md-4 col-lg-3 col-form-label">Faculty</label>
												<div class="col-md-8 col-lg-9">
													<select name="faculty" class="form-control" id="Drfaculty">
														<option disabled selected>Choose Faculty</option>
														<?php foreach($faculties as $faculty): ?>
															<option value="<?= $faculty['id'] ?>"><?= $faculty['name'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											
											<div class="row mb-3">
											<label for="registDoctorName" class="col-md-4 col-lg-3 col-form-label">Dr. Name</label>
											<div class="col-md-8 col-lg-9">
												<select name="registDoctorName" class="form-control" id="registDoctorName">
													<option disabled selected>Choose Dr</option>
												</select>
											</div>
										  </div>
											
											
										  <div class="row mb-3">
											<label for="doctorCourseTitle" class="col-md-4 col-lg-3 col-form-label">Course</label>
											<div class="col-md-8 col-lg-9">
												<select name="doctorCourseTitle" class="form-control" id="doctorCourseTitle">
													<option disabled selected>Choose Course</option>
												</select>
											</div>
										  </div>
					  
					  
										  <div class="text-center">
											<button type="submit" name="submitEnrollDoctor" class="btn btn-primary">Sumit</button>
										  </div>
										</form>
                                    </div>
									<!-- End Enroll Doctor Form -->
									
									
									<!-- Enroll Student -->
                                    <div class="tab-pane fade pt-3" id="enroll-student">
										<form method="POST">
										<?= csrf_field(); ?>
										
										
											<div class="row mb-3">
												<label for="faculty" class="col-md-4 col-lg-3 col-form-label">Faculty</label>
												<div class="col-md-8 col-lg-9">
													<select name="faculty" class="form-control" id="StudentFaculty">
														<option disabled selected>Choose Faculty</option>
														<?php foreach($faculties as $faculty): ?>
															<option value="<?= $faculty['id'] ?>"><?= $faculty['name'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										<!--
										  <div class="row mb-3">
											<label for="registStudentName" class="col-md-4 col-lg-3 col-form-label">Student Name</label>
											<div class="col-md-8 col-lg-9">
												<select name="registStudentName" class="form-control" id="registStudentName">
													<option disabled selected>Choose Student</option>
													<?php foreach($students as $stu): ?>
														<option value="<?= $stu['id'] ?>"><?= $stu['name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										  </div>
										-->
										  <div class="row mb-3">
											<label for="registStudentName" class="col-md-4 col-lg-3 col-form-label">Student Name</label>
											<div class="col-md-8 col-lg-9">
												<select name="registStudentName" class="form-control" id="registStudentName">
													<option disabled selected>Choose Student</option>
												</select>
											</div>
										  </div>
					  
										  <div class="row mb-3">
											<label for="studentCourseTitle" class="col-md-4 col-lg-3 col-form-label">Course</label>
											<div class="col-md-8 col-lg-9">
												<select name="studentCourseTitle" class="form-control" id="studentCourseTitle">
													<option disabled selected>Choose Course</option>
												</select>
											</div>
										  </div>
											<!--
										  <div class="row mb-3">
											<label for="studentCourseTitle" class="col-md-4 col-lg-3 col-form-label">Course</label>
											<div class="col-md-8 col-lg-9">
												<select name="studentCourseTitle" class="form-control" id="studentCourseTitle">
													<option disabled selected>Choose Course</option>
													<?php foreach($courses as $course): ?>
														<option value="<?= $course['id'] ?>"><?= $course['title'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										  </div>
										-->
					  
										  <div class="text-center">
											<button type="submit" name="submitEnrollStudent" class="btn btn-primary">Sumit</button>
										  </div>
										</form>
                                    </div>
									<!-- End Enroll Student Form -->
                  
                                </div>
								<!-- End Bordered Tabs -->
                  
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
	
	
<!-- POPUP MODEL -->
<div class="popup" id="popup-1">
	<div class="overlay"></div>
	<div class="content">
			<div class="close-btn" onclick="stopPopupModel()">&times;</div>
			<h1 id="title"></h1>
			<hr>
			<h3 id="body"></h3>
	</div>
</div>
<!-- END POPUP MODEL -->

<script>

const error = "<?= $error ?>";
const errorMessage = "<?= $errorMessage ?>";
const success = "<?= $successMessage ?>";


if(success !== ""){
	document.getElementById('title').innerHTML = "Success";
	document.getElementById('body').innerHTML = success;
	
	showPopupModel();
}

if(error){
	document.getElementById('title').innerHTML = "Error!";
	document.getElementById('body').innerHTML = errorMessage;
	showPopupModel();
}



function showPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}

function stopPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}


// Enroll
const courses = <?= json_encode($courses) ?>;


// Doctor Enroll
const doctorFaculty = document.getElementById("Drfaculty");
const doctors = <?= json_encode($doctors) ?>;

var registDoctorName = document.getElementById('registDoctorName');
var doctorCourseTitle = document.getElementById('doctorCourseTitle');

doctorFaculty.addEventListener('change', (event) => {
	//console.log(event.target.value);
	registDoctorName.innerHTML = "";
	doctorCourseTitle.innerHTML = "";
	for (const [key, value] of Object.entries(doctors)) {
		if(doctors[key].faculty == doctorFaculty.value)
			registDoctorName.innerHTML += "<option value="+doctors[key].id+">"+doctors[key].name+"</option>";
	}
	
	
	for (const [key, value] of Object.entries(courses)) {
		if(courses[key].faculty == doctorFaculty.value)
			doctorCourseTitle.innerHTML += "<option value="+courses[key].id+">"+courses[key].title+"</option>";
	}
});


// Student Enroll
const studentFaculty = document.getElementById("StudentFaculty");
const students = <?= json_encode($students) ?>;

var registStudentName = document.getElementById('registStudentName');
var studentCourseTitle = document.getElementById('studentCourseTitle');

studentFaculty.addEventListener('change', (event) => {
	registStudentName.innerHTML = "";
	studentCourseTitle.innerHTML = "";
	for (const [key, value] of Object.entries(students)) {
		if(students[key].faculty == studentFaculty.value)
			registStudentName.innerHTML += "<option value="+students[key].id+">"+students[key].name+"</option>";
	}
	
	
	for (const [key, value] of Object.entries(courses)) {
		if(courses[key].faculty == studentFaculty.value)
			studentCourseTitle.innerHTML += "<option value="+courses[key].id+">"+courses[key].title+"</option>";
	}
});



</script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	

	<script src="<?= base_url() ?>/module/admin/script.js"></script>
    <script src="<?= base_url() ?>/module/admin/js.js"></script>

</body>
</html>