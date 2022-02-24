<main id="main" data-aos="fade-in">

	<!-- ======= Breadcrumbs ======= -->
	<div class="breadcrumbs">
		<div class="container">
		<h2>Exams</h2>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<form method="POST">
	<?php echo csrf_field(); ?>
		<div class=" brdr m-1">
			<select class="btn btn-light  dropdown-toggle" name="courseChoosen">
				<option selected disabled>Course</option>
				<?php foreach($courses as $row): ?>
					<option value="<?= $row->course_id ?>"><?= $row->course_title ?></option>
				<?php endforeach; ?>
			</select>
			<button name="show" class="btn btn-secondary"> Show </button>
		</div>
	</form>
	
	<?php if(isset($result)): ?>
		<table style="width:100%">
			<tr>
				<th>Exam for Course</th>
				<th>Title</th>
				<th>Type</th>
				<th>No. of Question</th>
				<th>Total Grade</th>
				<th>Duration</th>
				<th>Date & Time</th>
				<th>Creation Date</th>
			</tr>
			<?php foreach($result as $row): ?>
				<form method="POST">
				<?php echo csrf_field(); ?>
					<tr>
						<td><?= $course_title ?></td>
						<td><?= $row->exam_title ?></td>
						<td><?= $row->exam_type ?></td>
						<td><?= $row->no_of_questions ?></td>
						<td><?= $row->total_grade?></td>
						<td><?= $row->exam_duration ?></td>
						<td><?= $row->exam_date_time ?></td>
						<td><?= $row->exam_date_of_creation ?></td>
						<td><button name="showExam" value="<?php echo $row->exam_id ?>" class="btn btn-light"> Show </button></td>
						<td><button name="editExam" value="<?php echo $row->exam_id ?>" class="btn btn-secondary"> Edit </button></td>
					</tr>
				</form>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
 </main>