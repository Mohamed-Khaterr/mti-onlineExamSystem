
<main id="main" data-aos="fade-in">
	<div class="breadcrumbs">
		<div class="container">
			<h2>Edit Exam</h2>
			<h3><?php echo (isset($error) ? $error : '') ?></h3>
		</div>
	</div>
	<br>
	
	<?php if(isset($exam)): ?>
		<?php foreach($exam as $row): ?>
			<table style="width:90%">
				<form method="POST">
				<?php echo csrf_field(); ?>
					<tr>
						<th>Title</th>
						<td><input name="title" type="text" value="<?php echo $row->exam_title ?>" class="input-group-text input-group"></td>
					</tr>
					<tr>
						<th>Type</th>
						<td>
							<select name="type" class="input-group-text input-group">
								<option selected value="<?php echo $row->exam_type ?>"><?php echo $row->exam_type ?></option>
								<option value="Final" >Final</option>
								<option value="Midterm" >Midterm</option>
								<option value="Quiz" >Quiz</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>No. of Questions</th>
						<td><input name="noOfQuestions" type="number" value="<?php echo $row->no_of_questions ?>" class="input-group-text input-group"></td>
					</tr>
					<tr>
						<th>Total Grade</th>
						<td><input name="grade" type="number" value="<?php echo $row->total_grade ?>" class="input-group-text input-group"></td>
					</tr>
					<tr>
						<th>Duration</th>
						<td><input name="duration" type="time" value="<?php echo $row->exam_duration ?>" class="input-group-text input-group"></td>
					</tr>
					<tr>
						<th>Date & Time</th>
						<td><input name="dateTime" type="datetime-local" value="<?= str_replace(" ","T",$row->exam_date_time) ?>" class="input-group-text input-group"
							min="2018-06-07 00:00" max="2023-06-14 00:00"
						></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td><input name="save" class="btn btn-light" type="submit" value="Save"></td>
						<td><input name="delete" class="btn btn-secondary" type="submit" value="Delete"><td>
					</tr>
				</form>
			</table>
		<?php endforeach; ?>
	<?php endif; ?>
	<br>
	<?php if(isset($_POST['delete'])): ?>
		<form method="POST">
		<?php echo csrf_field(); ?>
			<div class="container">
				<h3>Are you SURE! the exam will no longer avilable</h3>
				<input name="yesDelete" class="btn btn-secondary" type="submit" value="YES">
				<input name="noDelete" class="btn btn-light" type="submit" value="NO">
			</div>
		</form>
	<?php endif; ?>
	<br><br><br>
</main>