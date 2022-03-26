


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
							<a class="active" href="<?= base_url('Doctor/dashboard') ?>">Exams</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i>
						
						<li>
							<a class="active" href="<?= base_url('Doctor/show-questions') ?>">Show Questions</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i>
						
						<li>
							<a class="active" href="">Edit Question</a>
						</li>
						
					</ul>
				</div>
				
			</div>
			
			
<form method="POST">
<?= csrf_field() ?>	
	<div class="table-data ">
		<div class="order">
			<div class="todo ">
				
				<?php if(empty($question['options'][0])): ?>
					<div class="head">
						<h3> True/False Question</h3>
					</div>
					
					<div class="col-md-12">
						<label for="inputCity" class="form-label">Question</label>
						<textarea name="tfQuestion" class="form-control" id="inputCity"><?= $question['question'] ?></textarea>
						<?= isset($error['tfQuestion']) ? "Add Question":"" ?>
					</div>
					
					<div class="d-flex justify-content-between mt-3">

						<div class="col-md-3">
							
							<div class="form-check">
								<label for="inputState" class="form-label">Correct Anwser </label>
								<select name="tfAnswer" id="inputState" class="form-select">
									<?php if($question['answer'] == 'True'): ?>
										<option value="True" selected >True < </option>
										<option value="False">False</option>
									<?php else: ?>
										<option value="True">True</option>
										<option value="False" selected >False < </option>
									<?php endif; ?>
								</select>
								<?= isset($error['tfAnswer']) ? "Choose answer for Question":"" ?>
							</div>
						</div>

						<div class="col-md-3">
							<label for="inputCity" class="form-label">Question Mark</label>
							<input name="tfGrade" value="<?= $question['mark'] ?>" type="number" class="form-control" id="inputCity">
							<?= isset($error['tfGrade']) ? "Add Grade for Question":"" ?>
						</div>
					</div>


					<div class="d-flex justify-content-between mt-4">
						<div class="">
							<button name="updatetfQuestion" type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				
			
			
					<?php else: ?>
				
				
					<div class="head">
						<h3> MCQ Question</h3>
					</div>

					<div class="col-md-12">
						<label for="inputCity" class="form-label">Question</label>
						<textarea name="chooseQuestion" type="text" class="form-control" id="inputCity"><?= $question['question'] ?></textarea>
						
						<?= isset($error['chooseQuestion']) ? "Add Question please":"" ?>
					</div>


					<div class="d-flex justify-content-between mt-3" id="addChoice">
						<?php $counter = 1 ; ?>
						<?php foreach($question['options'] as $option): ?>
							<div class="col-md-3">
								<label for="inputCity" class="form-label" id="deleteInput">Option : <?= $counter ?> </label>
								<input name="options[]" value="<?= $option ?>" type="text" class="form-control  deleteInput" id="deleteInput">
							</div>
						<?php $counter++; ?>
						<?php endforeach; ?>
					</div>
					<?= isset($error['options']) ? "There is empty Option":"" ?>


					<div class="d-flex justify-content-between mt-3">
						<div class="col-md-3">
							<label for="inputCity" class="form-label">Correct Anwser</label>
							<input name="chooseAnswer" value="<?= $question['answer'] ?>" type="text" class="form-control" id="inputCity">
							
							<?= isset($error['chooseAnswer']) ? "Add correct Answer":"" ?>
						</div>

						<div class="col-md-3">
							<label for="inputCity" class="form-label">Question Mark</label>
							<input name="chooseGrade" value="<?= $question['mark'] ?>" type="number" class="form-control" id="inputCity">
							
							<?= isset($error['chooseGrase']) ? "Add Grade for Question":"" ?>
						</div>
					</div>


					<div class="d-flex justify-content-between mt-4">
						<div class=" ">
							<button name="updateChooseQuestion" type="submit" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-primary" onclick="addChoice(<?= $counter;  ?>)">Add Choise </button>
							<button type="button" class="btn btn-danger" onclick="deleteChoice(<?= $counter ?>)">Delete last Choise </button>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="table-data d-none" id="BoxMCQ">
		<div class="order">
			
		</div>
	</div>
</form>



</main>
<!-- MAIN -->
		