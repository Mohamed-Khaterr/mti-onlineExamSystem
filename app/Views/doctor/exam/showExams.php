


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Exams</h1>
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
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
				
				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<h3><?= count($courses['courses']) ?></h3>
						<p> Total Courses</p>
					</span>
				</li>
				
				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text">
						<h3><?= $examsCount ?></h3>
						<p> Total Exams</p>
					</span>
				</li>
			</ul>










			<div class="table-data">
				<div class="order">
				
					
					
					<!-- -->
					<form method="POST"><?= csrf_field() ?>	
						<div class="head">
							<h3>Exams</h3>
							<!--<i class='bx bx-search' ></i>-->
							<div>
								<select name="selectedCourse" class="form-select">
									<option selected disabled> Choose Course...</option>
									<?php foreach($courses['courses'] as $course): ?>
										<option value="<?= $course['id'] ?>"><?= $course['title'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<button name="showExamsOfCourse" class="btn btn-primary">Show</button>
						</div>
						
					</form>
					
					
					<table>
						<thead>
							<tr>
								<th>Course</th>
								<th> Title </th>
								<th> Type </th>
								<th> Date </th>
								<th> Duration </th>
								<th> Grade </th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($exams)): ?>
								<?php foreach($exams as $exam): ?>
									<form method="POST">
										<?= csrf_field() ?>
										<tr>
											<td style="text-align: center;"><?= $exam['course_title'] ?></td>
											
											<td><?= $exam['title'] ?></td>
											
											<td><?= $exam['type'] ?></td>
											
											<td><?= $exam['dateTime'] ?></td>
											
											<td><?= $exam['duration'] ?></td>
											
											<td><?= $exam['total_grade'] ?></td>
											
											<td>
												<a href="" title="Show Questions">
													<button name="showExam" value="<?= $exam['id'] ?>" type="submit" class="btn btn-primary btn-sm">Show</button> 
												</a>
												
												<a href="" title="Edit Exam">
													<button name="editExam" value="<?= $exam['id'] ?>" type="submit" class="btn btn-primary btn-sm"> Edit </button> 
												</a>
												
												<a href="" title="Delete Perminatly">
													<button name="deleteExam" type="submit" class="btn btn-danger btn-sm" value="<?= $exam['id'] ?>">Delete</button>
												</a>
											</td>
										</tr>
									</form>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
			
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	
	<script type="text/javascript">
		window.addEventListener('beforeunload', function(e){
			<?php 
				unset($_SESSION["showExamWithID"]) ;
				unset($_SESSION["editExamWithID"]) ;
				unset($_SESSION['editQuestionWithId']);
			?>
		})
	</script>