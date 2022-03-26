




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
							<a class="active" href="">Update Exam</a>
						</li>
						
					</ul>
				</div>
				
			</div>


















			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3> Exam Details </h3>
                            
                        </div>
						
								<form method="POST" class="row g-3">
									<?= csrf_field() ?>
									<div class="col-md-4">
										<label for="inputState" class="form-label">Course Title </label>
										
										<select name="course_id" id="inputState" class="form-select">
											<?php foreach($courseTitle['courses'] as $course): ?>
												<?php if($exam['course_name'] == $course['title']):?>
													<option selected value="<?= $course['id'] ?>"><?= $course['title'] ?> < </option>
												<?php else: ?>
													<option value="<?= $course['id'] ?>"><?= $course['title'] ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
											
										</select>
										<?= isset($error['course_id']) ? "Choose Course please" : "" ?>
									 </div>
									 
									<div class="col-md-4">
										<label for="inputCity" class="form-label">Exam Title</label>
										<input name="exam_title" value="<?= $exam['title'] ?>" type="text" class="form-control" id="inputCity" placeholder="Exam Title....">
										
										<?= isset($error['exam_title']) ? "Add a Title for this exam please" : "" ?>
									</div>

									  <div class="col-md-4">
										<label for="inputState" class="form-label">Type</label>
										<select name="exam_type" id="inputState" class="form-select">
											<?php if($exam['type'] == 'Final'): ?>
												<option value="Final" selected>Final < </option>
												<option value="Midterm">Midterm</option>
												<option value="Quiz">Quiz</option>
											<?php elseif($exam['type'] == 'Midterm'):?>
												<option value="Final">Final</option>
												<option value="Midterm" selected>Midterm < </option>
												<option value="Quiz">Quiz</option>
											<?php elseif($exam['type'] == 'Quiz') :?>
												<option value="Final">Final</option>
												<option value="Midterm">Midterm</option>
												<option value="Quiz" selected>Quiz <  </option>
											<?php endif; ?>
											
										</select>
										
										<?= isset($error['exam_type']) ? "Choose Type please" : "" ?>
									  </div>
									
									
									

									<div class="col-md-4">
										<label for="inputCity" class="form-label">Total Grade</label>
										<input name="total_grade" value="<?= $exam['total_grade'] ?>" type="number" class="form-control" id="inputCity" placeholder="Grade...">
										
										<?= isset($error['total_grade']) ? "Add Grade for this exam please" : "" ?>
									 </div>


									 <div class="col-4">
										<label for="inputAddress" class="form-label">Date & Time</label>
										<input name="dateTime" value="<?= date("Y-m-d\TH:i:s", strtotime($exam['noFormatDateTime'])) ?>" type="datetime-local" class="form-control" id="inputAddress" >
									  
										<?= isset($error['dateTime']) ? "Choose Date and Time for this exam please" : "" ?>
									  </div>



									<div class="col-4">
										<label for="inputAddress2" class="form-label">Duration</label>
										<input name="duration" value="<?= $exam['duration'] ?>" type="time" class="form-control" id="inputAddress2">
										
										<?= isset($error['duration']) ? "Set Duration for this exam please" : "" ?>
									</div>


								   
									<div class="col-md-4 mt-5">
									  <button name="saveEdit" type="submit" class="btn btn-primary">Save</button>
									</div>
								  </form>
					</div>


				</div>
			</div>

		</main>
		<!-- MAIN -->
		