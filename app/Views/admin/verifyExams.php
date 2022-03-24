

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Verify Exams</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Admin') ?>">Dashboard</a>
						</li>
            
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin') ?>">Home</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i>
						
						<li>
							<a class="active" href="">Verify Exams</a>
						</li>
						
					</ul>
				</div>
				
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-layer'></i>
					<span class="text">
						<h3><?= $examVerification['verified'] ?></h3>
						<p> Total Exams <br /> Verified</p>
					</span>
				</li>

				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text">
						<h3><?= $examVerification['notVerified'] ?></h3>
						<p> Total Exams <br /> Not Verified</p>
					</span>
				</li>
			</ul>
			
			
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>All Exams</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>Course</th>
								<th>Exam</th>
								<th>Type</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php for($i = 0; $i < count($examVerification['exams']['title']); $i++): ?>
								<tr>
									<td>
										<p><?= $examVerification['exams']['title'][$i] ?></p>
									</td>
									
									<td>
										<p><?= $examVerification['exams']['examTitle'][$i] ?></p>
									</td>
									
									<td>
										<p><?= $examVerification['exams']['type'][$i] ?></p>
									</td>
									
									<?php if($examVerification['exams']['admin_verified'][$i] == 'true'): ?>
									<td>
										
										<span class="status completed">Verified</span>
										
									</td>
									
									<td> </td>
									<?php else: ?>
										<td>
										
											<span class="status pending">Not Verified</span>
											
										</td>
										
										<td>
											<form method="POST"><?= csrf_field(); ?>
												<button name="accept" value="<?= $examVerification['exams']['examID'][$i] ?>" style="border: none;"> Accept </button>
											</form>
										</td>
									<?php endif; ?>
								</tr>
							<?php endfor; ?>
							
							
						</tbody>
					</table>
				</div>