

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
						<h3>All Sudents</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<!--<th> Details </th>-->
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($allStudentsName as $student): ?>
								<tr>
									<td>
										<!--<img src="img/people.png">-->
										<p><?= $student ?></p>
									</td>
									<!--<td> <button> See </button></td>-->
									<td><span class="status completed">Not Cheating</span></td>
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
						<a href="Admin/create-exam" title="Create Exam"><i class='bx bx-plus' ></i></a> 
						<!--<i class='bx bx-filter' ></i>-->
					</div>
					<ul class="todo-list">
						<?php if(count($upcomingExams['title']) == 0): ?>
							<br />
							<h4 style="text-align: center;"> No Exams </h4>
						<?php else: ?>
							<?php for($i = 0; $i < count($upcomingExams['title']); $i++): ?>
								<br />
								<form method="post" action="<?= base_url('Admin') ?>">
								<?= csrf_field(); ?>
									<li class="<?php echo $upcomingExams['isPast'][$i] ? "completed" : "not-completed" ?>">
										
										<p>
											<?= $upcomingExams['title'][$i] ?> 
											
											(<?= $upcomingExams['type'][$i] ?>) 
											<br /> <br /> 
											<?= $upcomingExams['datetime'][$i] ?>
										<p>
										
										<p></p>
										
										<!--<a href="" title="edit">  <i  class='bx bx-edit p'></i>  </a>-->
										
										<a href="" title="delete permanently" >
											<button name="deleteExam" value="<?= $upcomingExams['examID'][$i] ?>" style="border: none;"><i class='bx bx-x p'></i></button>
										</a>
									</li>
								</form>
							<?php endfor; ?>
						<?php endif; ?>
						
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->