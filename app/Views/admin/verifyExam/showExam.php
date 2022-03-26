




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
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin/verify-exams') ?>">Verify Exam</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="">Exam</a>
						</li>
						
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
		<li>
			<i class='bx bx-layer'></i>
			<span class="text">
				<h3><?= $exam['course_title'] ?></h3>
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
							<form method="POST">
							<?= csrf_field() ?>
								<button name="accept" value="<?= $exam['id'] ?>" class="btn btn-primary">Accept</button>
							</form>
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
							<?php foreach($exam['questions'] as $question): ?>
								<tr>
									<td><?= $question['question'] ?></td>
									
									<td><?= $question['answer'] ?></td>
									
									<td><?= $question['options'] ?></td>
									
									<td><?= $question['type'] ?></td>
									
									<td><?= $question['mark'] ?></td>
								</tr>
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
	
	