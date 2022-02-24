
<main id="main" data-aos="fade-in">
	<div class="breadcrumbs">
		<div class="container">
			<h2>Edit Questions</h2>
			<h3><?php echo (isset($error) ? $error : '') ?></h3>
		</div>
	</div>
	<?php foreach($question as $row): ?>
		<table style="width:90%">
			<form method="POST">
			<?php echo csrf_field(); ?>
				
				<tr>
					<th>Question</th>
					<td><input name="question" class="input-group-text input-group" type="text" value="<?php echo $row->question_description ?>"></td>
				</tr>
				<?php if($row->question_type == 'True or False'): ?>
					<tr>
						<th>Answer</th>
						<td>
						
							<select name="answer" class="input-group-text input-group">
								<option selected><?php echo $row->question_answer ?></option>
								<option value="True">True</option>
								<option value="False">False</option>
							</select>
						</td>
					</tr>
				<?php else: ?>
					<tr>
						<th>Answer</th>
						<td><input name="answer" class="input-group-text input-group" type="text" value="<?php echo $row->question_answer ?>"></td>
					</tr>
					<tr>
						<th>Choices</th>
						
						<?php foreach($choices as $option): ?>
							<td>
								<input name="options[]" class="input-group-text input-group" type="text" value="<?php echo $option ?>">
							</td>
						<?php endforeach; ?>
						
					</tr>
				<?php endif; ?>
				<tr>
					<th>Grade</th>
					<td><input name="grade" class="input-group-text input-group" type="number" value="<?php echo $row->question_grade ?>"></td>
				</tr>
				<tr>
					<td><input name="save" class="btn btn-light" type="submit" value="Save"></td>
					<td><input name="delete" class="btn btn-secondary" type="submit" value="Delete"></td>
				</tr>
			</form>
		</table>
	<?php endforeach; ?>
	<br>
	<?php if(isset($_POST['delete'])): ?>
		<form method="POST">
		<?php echo csrf_field(); ?>
			<div class="container">
				<h3>Are you SURE! the question will no longer avilable</h3>
				<button name="yesDelete" value="<?php echo $_SESSION['question_id'] ?>" class="btn btn-secondary"> YES </button>
				<button name="noDelete" value="" class="btn btn-light"> NO	 </button>
			</div>
		</form>
	<?php endif; ?>
</main>