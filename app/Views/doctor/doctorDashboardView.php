


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
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
				
				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<h3><?= $doctorCourses['totalCourses'] ?></h3>
						<p> Total Courses</p>
					</span>
				</li>
			</ul>










			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Courses</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>#</th>
								<th> Title </th>
								<th> Subject Code </th>
								<th> Level </th>
							</tr>
						</thead>
						<tbody>
							<?php $counter = 0 ?>
							<?php foreach($doctorCourses['courses'] as $course): ?>
								<?php $counter++ ?>
								<tr>
									<td><?= $counter ?></td>
									
									<td> <?= $course['title'] ?></td>
									
									<td> <?= $course['code'] ?></td>
									
									<td> <?= $course['level'] ?></td>
									
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	
	