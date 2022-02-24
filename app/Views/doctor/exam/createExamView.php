
<main id="main" data-aos="fade-in">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
	<div class="container">
		<h2>Create Exam</h2>
		<h4><?php echo $error; ?></h4>
	</div>
</div>
<!-- End Breadcrumbs -->







<div class="cr_exam ">
	<div class="three_btn">

		<!-- exam detail form -->

		<div class="w3-container ">
			<button onclick="document.getElementById('id02').style.display='block'" class="btn btn-success  single_btn">Exam Detail</button>

			<div id="id02" class="w3-modal ">
				<div class="w3-modal-content w3-card-4 w-25">
					<header class="w3-container w3-teal"> 
						<span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<h2>Enter Exam Detail</h2>
					</header>
					<form method="POST">
					<?php echo csrf_field(); ?>
						<div class="w3-container exam_detail ">
							<label>Course:</label>
							<select name="courseID" required>
								<option selected disabled>Course Title</option>
								<?php foreach($courses as $row): ?>
									<option value="<?= $row->course_id ?>"><?= $row->course_title ?></option>
								<?php endforeach; ?>
							</select>
							
							
							<label>Title </label>
							<input type="text" name="examTitle">
							
							

							<label>Type</label>
							<select name="examType" class="rounded" >
								<option value="Final">Final</option>
								<option value="Midterm">Midterm</option>
								<option value="Quize">Quiz</option>
							</select>

							<label>Date & Time</label>
							<input type="datetime-local" name="examDate">

							<label>Duration (in Hours):</label>
							<input type="time" value="03:00" name="examDuration">
							<!--
								Hide AM/PM in input type="time"
								input[type=time]::-webkit-datetime-edit-ampm-field {
								  display: none;
								}
							-->
							
							<label>No. of Questions:</label>
							<input type="number" name="noOfQuestions">


							<label>Total Grade</label>
							<input type="number" name="examGrade">

						</div>

						<footer class="w3-container w3-teal ">
							<button name="examDetailSave" class="btn btn-light btn_ex_detail">Save</button>
						</footer>
					</form>
				</div>
			</div>
		</div>   

		<!-- Choose form -->

		<div class="w3-container   ">
			<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success  single_btn">Choose Question</button>

			<div id="id01" class="w3-modal  ">
				<div class="w3-modal-content w3-card-4 w-25">
					<header class="w3-container w3-teal"> 
						<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<h2>Enter Question</h2>
					</header>
					
					<form method="POST">
					<?php echo csrf_field(); ?>
						<div class="w3-container exam_detail">
							<label>Choose Exam</label>
							<?php if(empty($exams)): ?>
								Pleas Create Exam First
							<?php else: ?>
								<select name="examID" required>
									<option selected disabled>Title</option>
									<?php foreach($exams as $exam): ?>
									<option value="<?php echo $exam->exam_id ?>"><?php echo $exam->exam_title ?></option>
									<?php endforeach; ?>
								</select>
							<?php endif; ?>
							
							<label>Question  </label>
							<textarea name="question" id="" cols="1" rows="1"></textarea>

							<label>choice : 1</label>
							<input type="text" name="options[]">

							<label>choice : 2</label>
							<input type="text" name="options[]">

							<label>choice : 3</label>
							<input type="text" name="options[]">
							
							<label>choice : 4</label>
							<input type="text" name="options[]">
							

							<label>Correct Anwser</label>
							<input type="text" name="answer">
							<label> Question Grade</label>
							<input type="number" name="grade">
						</div>

						<footer class="w3-container w3-teal ">
							<div class=" d-flex justify-content-center">
								<button name="saveChoose" class="btn btn-light  m-1">Save</button>
								<button class="btn btn-light  m-1">Add Choice</button>
							</div>
						</footer>
					</form>
				</div>
			</div>
		</div> 

		<!-- True and false form -->

		<div class="w3-container   ">
			<button onclick="document.getElementById('id00').style.display='block'" class="btn btn-success  single_btn">True/False Question</button>
			
			<div id="id00" class="w3-modal ch ">
				<div class="w3-modal-content w3-card-4 w-25">
					<header class="w3-container w3-teal"> 
						<span onclick="document.getElementById('id00').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<h2>Enter Question</h2>
					</header>
					
					<form method="POST">
					<?php echo csrf_field(); ?>
						<div class="w3-container exam_detail ">
							<label>Choose Exam</label>
							<?php if(empty($exams)): ?>
									Pleas Create Exam First
							<?php else: ?>
								<select name="examID" required>
									<option selected disabled>Title</option>
									<?php foreach($exams as $exam): ?>
									<option value="<?php echo $exam->exam_id ?>"><?php echo $exam->exam_title ?></option>
									<?php endforeach; ?>
								</select>
							<?php endif; ?>
							
							<label>Question  </label>
							<textarea name="question" cols="1" rows="1"></textarea>
							
							<label class="mt-2" for="">Anwser</label>
							<div class="mt-2">
								<div class="d-flex">
									<input name="answer" type="radio" value="True" class="mt-2"> <label class="mt-1" for="">True</label>
								</div>

								<div class="d-flex">
									<input name="answer" type="radio" value="False" class="mt-2"> <label class="mt-1" for="">False</label>
								</div>
							</div>
							
							<label class="mt-2"> Question Grade</label>
							<input name="grade" type="number">
						</div>

						<footer class="w3-container w3-teal ">
							<div class=" d-flex justify-content-center">
								<button name="saveTF" class="btn btn-light m-1 ">Save</button>
							</div>
						</footer>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</main>