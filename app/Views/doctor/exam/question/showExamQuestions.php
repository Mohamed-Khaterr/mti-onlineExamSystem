


<!-- MAIN -->
<main>
	<div class="head-title">
		<div class="left">
			<h1>Create Exam</h1>
			<ul class="breadcrumb">
				<li>
					<a href="<?= base_url('Doctor') ?>">Dashboard</a>
				</li>
	
				<li><i class='bx bx-chevron-right' ></i></li>
				<li>
					<a class="active" href="<?= base_url('Doctor') ?>">Home</a>
				</li>
				<li><i class='bx bx-chevron-right' ></i></li>
				<li>
					<a class="active" href="<?= base_url('Doctor/exams') ?>">Exams</a>
				</li>

				<li><i class='bx bx-chevron-right' ></i>
					<a class="active" href="">Show Questions</a>
				</li>
				
			</ul>
		</div>
		
	</div>



	<ul class="box-info">
		<li>
			<i class='bx bx-layer'></i>
			<span class="text">
				<h3><?= $exam['course_name'] ?></h3>
				<p>Course Name</p>
			</span>
		</li>
		
		<li>
			<i class='bx bx-task'></i>
			<span class="text">
				<h3><?= $exam['title'] ?></h3>
				<p>Exam Title</p>
			</span>
		</li>
		
		<li>
			<i class='bx bxs-calendar-check'></i>
			<span class="text">
				<h3><?= $exam['dateTime'] ?></h3>
				<p>Date & Time</p>
			</span>
		</li>
	</ul>

	
	
	
	<div class="table-data todo">
		<div class="order  p-0">
			

			<div class="todo d-flex justify-content-center center ">
				 <h3 >  Questions  </div>                        
			</div>
		</div>
	</div>

	<?php foreach($questions as $question): ?>
		<?php if(!empty($question['options'][0])): ?>
			<div class="table-data ">
				<div class="order ">
					<p>
						<?= $question['question'] ?>
					</p>
					
					<div class="d-flex justify-content-around">
						<?php foreach($question['options'] as $option): ?>
							<div class="form-check">
								<input class="form-check-input" type="radio" disabled  <?= $question['answer'] == $option ? "checked" : "" ?> >
								<label class="form-check-label">  <?= $option ?> </label>
								
							</div>
						<?php endforeach; ?>
					</div>
					<form method="POST">
						<?= csrf_field() ?>	
						<div class="d-flex justify-content-end mt-3">
							<button type="submit" class="btn btn-primary " onclick=" MCQ_edit()">Edit </button>
							<button name="deleteQuestion" value="<?= $question['id'] ?>" type="submit" class="btn btn-danger ms-1">Delete</button>
						</div>                
					</form>
				</div>
			</div>
		<?php else: ?>
			<div class="table-data ">
				<div class="order "> 
					<p>
						<?= $question['question'] ?>
					</p>
					
					<div class="form-check ">

						<input class="form-check-input" type="radio" disabled <?= $question['answer'] == 'True' ? 'checked' : null ?>  >
						<label class="form-check-label">  True </label>
					</div>
					
					<div class="form-check">
						<input class="form-check-input" type="radio" disabled <?= $question['answer'] == 'False' ? 'checked' : null ?>>
						<label class="form-check-label" > False</label>
					</div>
					<form method="POST">
						<?= csrf_field() ?>	
						<div class="d-flex justify-content-end">
							<button name="editQuestion" value="<?= $question['id'] ?>" type="submit" class="btn btn-primary ">Edit </button>
							
							<button name="deleteQuestion" value="<?= $question['id'] ?>" type="submit" class="btn btn-danger ms-1">Delete</button>
						</div>
					</form>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</main>
<!-- MAIN -->