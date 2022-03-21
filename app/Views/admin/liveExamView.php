


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Live Exam</h1>
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
							<a class="active" href="<?= base_url('Admin/current-exam') ?>">Current Exams</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="">Live Exam</a>
						</li>
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
				
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<p>Students No.</p>
						<h3>15</h3>
					</span>
				</li>

				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<!--<p>Courses</p>-->
						<h3><?= $courseTitle ?></h3>
					</span>
				</li>

				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text">
						<!--<p>Exam Title</p>-->
						<h3><?= $examTitle ?></h3>
					</span>
				</li>
			</ul>










			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Sudents</h3>
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
								<tr>
									<td>
										<img src="<?=base_url() ?>/module/admin/img/people.png">
										<p>Mohamed Khater</p>
									</td>
									<!--<td> <button> See </button></td>-->
									<td><span class="status completed">Not Cheating</span></td>
								</tr>

							
							<tr>
								<td>
									<img src="<?=base_url() ?>/module/admin/img/people.png">
									<p>Fady victor</p>
								</td>
								
								<td><span class="status pending">Cheating</span></td>
							</tr>
							
							
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->