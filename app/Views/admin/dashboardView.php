


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Admin') ?>">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="<?= base_url('Admin') ?>">Home</a>
						</li>
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
				
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?= $studentCountAll ?></h3>
						<p>Total Students</p>
					</span>
				</li>

				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<h3><?= $coursesCountAll ?></h3>
						<p> Total Courses</p>
					</span>
				</li>

				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text">
						<h3><?= $examCountAll ?></h3>
						<p> Total Exams</p>
					</span>
				</li>
			</ul>










			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>All Courses</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Level</th>
								<th>Code</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($allCoursesNames as $course): ?>
								<tr>
									<td>
										<!--<img src="img/people.png">-->
										<p><?= $course['title'] ?></p>
									</td>
									
									<td><?= $course['level'] ?></td>
									
									<!--<td> <button> See </button></td>-->
									<td><span class="status completed"><?= $course['code'] ?></span></td>
								</tr>
							<?php endforeach; ?>

							<!--
							<tr>
								<td>
									<img src="img/people.png">
									<p>Fady victor</p>
								</td>
								<td> <button> See </button></td>
								<td><span class="status pending">Cheating</span></td>
							</tr>
							-->
							
						</tbody>
					</table>
				</div>




				<div class="todo">
					<div class="head">
						<h3>Upcaming Exams</h3>
						<!--<a href="" title="Create Exam"><i class='bx bx-plus' ></i></a>-->
						<a href="<?= base_url('Admin/current-exam') ?>" title="Current Exam"><i class='bx bx-filter' ></i></a> 
					</div>
					<ul class="todo-list">
						<?php if(count($upcomingExams) == 0): ?>
							<br />
							<h4 style="text-align: center;"> No Exams </h4>
						<?php else: ?>
							<?php foreach($upcomingExams as $exam): ?>
								<br />
								<form method="post" action="<?= base_url('Admin') ?>">
								<?= csrf_field(); ?>
									<li class="<?php echo $exam['isPast'] ? "completed" : "not-completed" ?>">
										
										<p>
											<?= $exam['title'] ?> 
											
											<?= $exam['type'] ?>
											
											<br /> <br /> 
											<?= $exam['datetime'] ?>
										<p>
										
										<p></p>
									</li>
								</form>
							<?php endforeach; ?>
						<?php endif; ?>
						
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	