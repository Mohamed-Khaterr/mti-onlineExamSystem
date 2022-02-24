
<main id="main" data-aos="fade-in">
	<div class="breadcrumbs">
		<div class="container">
		<h2>Questions</h2>
		</div>
	</div>
	<table style="width:100%">
		<tr>
			<th>Type</th>
			<th>Question</th>
			<th>Choices</th>
			<th>Answer</th>
			<th>Grade</th>
		</tr>
		<?php foreach($result as $row): ?>
			<form method="POST">
			<?php echo csrf_field(); ?>
				<tr>
					<td><?php echo $row->question_type ?></td>
					
					<td><?php echo $row->question_description ?></td>
					<td>
						<?php if(!empty($row->question_choices)): ?>
							<?php echo str_replace('#@',', ',$row->question_choices) ?>
						<?php else: ?>
							NULL
						<?php endif; ?>
					</td>
					<td><?php echo $row->question_answer?></td>
					
					<td><?php echo $row->question_grade ?></td>
					
					<td><button name="editQuestion" value="<?php echo $row->question_id ?>" class="btn btn-secondary"> Edit </button></td>
				</tr>
			</form>
		<?php endforeach; ?>
	</table>
</main>