<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/module/admin/assets/css/css.css">

	<title>Online Exam System</title>
</head>
<body>
<?= base_url() ?>/module/admin/style.css

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="../Admin" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Welcome</span>
		</a>
		<ul class="side-menu top p-0">
			<li>
				<a href="../Admin">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="current-exam">
					<i class='bx bxs-group' ></i>
					<span class="text">Current Exams</span>
				</a>
			</li>
			<li class="active">
				<a href="create-exam">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Create Exam</span>
				</a>
			</li>


			<li>
				<a href="">
					<i class='bx bxs-cog' ></i>
					<span class="text">Register Admin</span>
				</a>
			</li>
			
			
			
			
			
		</ul>

		<ul class="side-menu p-0">
			<li>
				<a href="/Logout" class="logout">
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


			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="" class="profile">
				<img src="<?= base_url() ?>/module/admin/img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Create Exam</h1>
					<ul class="breadcrumb">
						<li>
							<a href="../Admin">Dashboard</a>
						</li>
            
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="" href="../Admin">Home</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="" href="">Exams</a>
						</li>
            <li><i class='bx bx-chevron-right' ></i>
							<a class="active" href="create-exam">Create Exam</a>
						</li>
						
					</ul>
				</div>
				
			</div>


















			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3>  Exam Details </h3>
                            
                        </div>
                        
                        


                            <form class="row g-3">
                                
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">Course Title </label>
                                    <select id="inputState" class="form-select">
                                      <option disabled selected>Choise...</option>
                                      <option>Database</option>
                                      <option>Computer Graphic</option>

                                    </select>
                                  </div>


                                  <div class="col-md-4">
                                    <label for="inputState" class="form-label">Course Type </label>
                                    <select id="inputState" class="form-select">
                                      <option disabled selected>Choise...</option>
                                      <option>Final</option>
                                      <option>Midterm</option>
                                      <option>Quize</option>
                                    </select>
                                  </div>


                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Total Grade</label>
                                    <input type="text" class="form-control" id="inputCity">
                                 </div>


                                 <div class="col-4">
                                    <label for="inputAddress" class="form-label">Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="inputAddress" >
                                  </div>



                                <div class="col-4">
                                  <label for="inputAddress2" class="form-label">Duration</label>
                                  <input type="time" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                </div>


                               
                                <div class="col-md-4 mt-5">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>

                    </div>


                    


				</div>
			</div>
            



            <div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3>  Question Type </h3>
                            
                        </div>
                        
                        <div class="d-flex justify-content-center">

                        <div class="form-check me-5">
                          
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="TrueFalse()"  >
                            <label class="form-check-label" for="flexRadioDefault1">
                              True/False Question
                            </label>
                          </div>
                        
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="MCQ()" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                             MCQ Question
                            </label>
                          </div>

                        </div>
                    </div>
				</div>
			</div>




        


            <div class="table-data d-none " id="BoxTrueFalse">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3> True/False Question</h3>
                            
                        </div>
                        
                        


                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Question</label>
                            <textarea type="" class="form-control" id="inputCity"></textarea>
                         </div>



                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              True
                            </label>
                          </div>
                        
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                False
                            </label>
                          </div>

                        <div class="d-flex justify-content-between mt-3">

                          <div class="col-md-3">
                            <label for="inputCity" class="form-label">Correct Anwser</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputCity" class="form-label">Question Grade</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputState" class="form-label">Exams </label>
                            <select id="inputState" class="form-select">
                              <option disabled selected>Choise...</option>
                              <option>Database</option>
                              <option>Computer Graphic</option>

                            </select>
                          </div>

                        </div>


                         <div class="d-flex justify-content-between mt-4">

                         <div class="">
                            <label for="inputCity" class="form-label"> Is Correct Anwser ?</label>
                            <input type="checkbox" class="" id="">
                         </div>


                         <div class=" ">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="submit" class="btn btn-primary">New</button>

                          </div>

                        </div>



                    </div>


                    


				</div>
		      	</div>


       





            <div class="table-data d-none" id="BoxMCQ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3> MCQ Question</h3>
                            
                        </div>
                        
                        


                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Question</label>
                            <textarea type="" class="form-control" id="inputCity"></textarea>
                         </div>


                         <div class="d-flex justify-content-between mt-3">

                            <div class="col-md-3">
                              <label for="inputCity" class="form-label">Choise : 1 </label>
                              <input type="" class="form-control" id="inputCity">
                           </div>
  
                           <div class="col-md-3">
                              <label for="inputCity" class="form-label">Choise : 2</label>
                              <input type="" class="form-control" id="inputCity">
                           </div>
  
                           <div class="col-md-3">
                            <label for="inputCity" class="form-label">Choise : 3</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>
  
                          </div>
                        

                        <div class="d-flex justify-content-between mt-3">

                          <div class="col-md-3">
                            <label for="inputCity" class="form-label">Correct Anwser</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputCity" class="form-label">Question Grade</label>
                            <input type="" class="form-control" id="inputCity">
                         </div>

                         <div class="col-md-3">
                            <label for="inputState" class="form-label">Exams </label>
                            <select id="inputState" class="form-select">
                              <option disabled selected>Choise...</option>
                              <option>Database</option>
                              <option>Computer Graphic</option>

                            </select>
                          </div>

                        </div>


                         <div class="d-flex justify-content-between mt-4">

                         <div class="">
                            <label for="inputCity" class="form-label"> Is Correct Anwser ?</label>
                            <input type="checkbox" class="" id="">
                         </div>


                         <div class=" ">
                            <button type="submit" class="btn btn-primary">Add Choise </button>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="submit" class="btn btn-primary">New</button>


                          </div>

                        </div>



                    </div>


                    


				</div>
			</div>


             

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	
	<script src="<?= base_url() ?>/module/admin/assets/js/script.js"></script>
	<script src="<?= base_url() ?>/module/admin/assets/js/js.js"></script>
</body>
</html>