


<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Create Exam</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Doctor/dashboard') ?>">Dashboard</a>
						</li>
            
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Doctor/dashboard') ?>">Home</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Doctor/exams') ?>">Exams</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i>
						
						<li>
							<a class="active" href="">Create Exam</a>
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
						
						<br />

                            <form method="POST" class="row g-3">
                                <?= csrf_field() ?>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">Course Title </label>
									
                                    <select name="course_id" id="inputState" class="form-select">
										<option disabled selected>Choise Course...</option>
										
										<?php foreach($courseTitle['courses'] as $course): ?>
											<option value="<?= $course['id'] ?>"><?= $course['title'] ?></option>
										<?php endforeach; ?>
										
                                    </select>
									<?= isset($error['course_id']) ? "Choose Course please" : "" ?>
                                 </div>
								 
								<div class="col-md-4">
                                    <label for="inputCity" class="form-label">Exam Title</label>
                                    <input name="exam_title" type="text" class="form-control" id="inputCity" placeholder="Exam Title....">
									
									<?= isset($error['exam_title']) ? "Add a Title for this exam please" : "" ?>
                                </div>

                                  <div class="col-md-4">
                                    <label for="inputState" class="form-label">Type</label>
                                    <select name="exam_type" id="inputState" class="form-select">
									
										<option disabled selected>Choise Type...</option>
										<option>Final</option>
										<option>Midterm</option>
										<option>Quiz</option>
										
                                    </select>
									
									<?= isset($error['exam_type']) ? "Choose Type please" : "" ?>
                                  </div>
								
								
								

                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Total Grade</label>
                                    <input name="total_grade" type="number" class="form-control" id="inputCity" placeholder="Grade...">
									
									<?= isset($error['total_grade']) ? "Add Grade for this exam please" : "" ?>
                                 </div>


                                 <div class="col-4">
                                    <label for="inputAddress" class="form-label">Date & Time</label>
                                    <input name="dateTime" type="datetime-local" class="form-control" id="inputAddress" >
                                  
									<?= isset($error['dateTime']) ? "Choose Date and Time for this exam please" : "" ?>
								  </div>



                                <div class="col-4">
                                    <label for="inputAddress2" class="form-label">Duration</label>
                                    <input name="duration" type="time" class="form-control" id="inputAddress2">
									
									<?= isset($error['duration']) ? "Set Duration for this exam please" : "" ?>
								</div>


                               
                                <div class="col-md-4 mt-5">
                                  <button name="createExam" type="submit" class="btn btn-primary">Create</button>
                                </div>
                              </form>
					</div>


				</div>
			</div>

		</main>
		<!-- MAIN -->
		
		
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
	const errorMessage = "<?= $errorMessage ?>";

	if(errorMessage != ""){
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
</script>