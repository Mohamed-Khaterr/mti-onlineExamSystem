


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
									<?php foreach($courses['courses'] as $course): ?>
										<option value="<?= $course['id'] ?>"><?= $course['title'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<button name="showExams" class="head btn btn-primary">Show</button>
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
								<th> Verified </th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($exams)): ?>
								<?php foreach($exams as $exam): ?>
									<tr>
										<td><?= $exam['course_title'] ?></td>
										
										<td><?= $exam['title'] ?></td>
										
										<td><?= $exam['type'] ?></td>
										
										<td><?= $exam['dateTime'] ?></td>
										
										<td><?= $exam['duration'] ?></td>
										
										<td><?= $exam['total_grade'] ?></td>
										
										<td><?= $exam['admin_verified'] ? "YES" : "NO" ?></td>
										
										<td>
											<a href="<?= base_url('Doctor/show-exam/'. $exam['id'])?>" title="Show">
												<button style="border: none;">Show</button> 
											</a>
											
											<br /> <br />
											
											<a href="<?= base_url('Doctor/edit-exam/'. $exam['id'])?>" title="Edit">
												<button style="border: none;">Edit</button> 
											</a>
										</td>
									</tr>
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
	
	
	