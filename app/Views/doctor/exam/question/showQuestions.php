




		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
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
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
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










			<div class="table-data">
				<div class="order">
				
						<div class="head">
							<h3>Exams</h3>
							<!--<i class='bx bx-search' ></i>-->
						</div>
					
					
					<table>
						<thead>
							<tr>
								<th>Question</th>
								<th> Answer </th>
								<th> Choices </th>
								<th> Type </th>
								<th> Marks </th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($questions as $question): ?>
								<form method="POST">
									<?= csrf_field() ?>
									<tr>
										
										<td><?= $question['question'] ?></td>
										
										<td><?= $question['answer'] ?></td>
										
										<td><?= $question['options'] ?></td>
										
										<td><?= $question['type'] ?></td>
										
										<td><?= $question['mark'] ?></td>
										
										<td>
											
											<a href="" title="Edit Exam">
												<button name="editQuestion" value="<?= $question['id'] ?>" type="submit" class="btn btn-primary btn-sm"> Edit </button> 
											</a>
											
											<a href="" title="Delete Perminatly">
												<button name="deleteQuestion" value="<?= $question['id'] ?>" type="submit" class="btn btn-danger btn-sm">Delete</button>
											</a>
										</td>
									</tr>
								</form>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			
			<div id="hello"></div>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script type="text/javascript">
		window.addEventListener('beforeunload', function(e){
			<?php  
				unset($_SESSION['editQuestionWithId']);
			?>
		})
	</script>