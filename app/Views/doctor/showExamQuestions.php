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
							<a class="active" href="">Show</a>
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
						<h3>Questions</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>Question</th>
								<th>Answer</th>
								<th>Choices</th>
								<th>Type</th>
								<th>Marks</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($questions as $question): ?>
								<tr>
									<td>
										<p><?= $question['question'] ?></p>
									</td>
									
									<td>
										<p><?= $question['answer'] ?></p>
									</td>
									
									<td>
										<?= $question['options'] ?>
									</td>
									
									<td>
										<p><?= $question['type'] ?></p>
									</td>
									
									<td>
										<p><?= $question['mark'] ?></p>
									</td>
									
									<td>
										<button class="btn btn-primary btn-sm">Update</button>
										
										<br />
										<br />
										
										<button class="btn btn-danger btn-sm"> Delete </button>
									</td>
									
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
