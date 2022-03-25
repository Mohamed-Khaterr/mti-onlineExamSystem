


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
										<td style="text-align: center;"><?= $exam['course_title'] ?></td>
										
										<td><?= $exam['title'] ?></td>
										
										<td><?= $exam['type'] ?></td>
										
										<td><?= $exam['dateTime'] ?></td>
										
										<td><?= $exam['duration'] ?></td>
										
										<td><?= $exam['total_grade'] ?></td>
										
										<td><?= $exam['admin_verified'] ? "YES" : "NO" ?></td>
										
										<td>
											<a href="<?= base_url('Doctor/show-exam/'. $exam['id'])?>" title="Show Exam">
												<button class="btn btn-primary btn-sm" style="border: none;">Show</button> 
											</a>
											
											<br /> <br />
											
											<a href="<?= base_url('Doctor/update-exam/'. $exam['id'])?>" title="Edit Exam">
												<button class="btn btn-primary btn-sm" style="border: none;"> Edit </button> 
											</a>
											
											<br /> <br />
											
											<button type="button" class="btn btn-danger btn-sm" onclick="display()">Delete</button>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
			
			
			<!-- Section -->
			
			<section id="fixedBox" class=" w-100 vh-100 d-flex align-items-center justify-content-center d-none">

				<div id="smallBox" class=" bg-body  w-75 h-75">
				
					<i id="closeBtn" class=" bx bxs-x-circle mt-2" ></i>
					
					<div class="d-flex w-100  flex-wrap" id="">


						<div class=" w-100  d-flex justify-content-between m-1   ">  
							<h2 class="m-3 ">Deleting Exam</h2>
						</div>



						<div class="  w-100 h-auto  m-2" style="text-align: center;">

							<h1> Are you sure that you want to DELETE exam Permanently! </h1>
									
							<br /><br />
							<form method="POST">
								<?= csrf_field() ?>
								<button name="deleteExam" type="submit" class="btn btn-danger"> YES </button> 
								<button type="submit" class="btn btn-primary "> NO </button>
							</form>
						</div>

					</div>
				</div>

			</section>
			
			<!-- End Section -->
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	
	