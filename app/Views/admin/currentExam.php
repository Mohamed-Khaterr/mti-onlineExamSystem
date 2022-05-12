

<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Current Exams</h1>
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
							<a class="active" href="<?= base_url('Admin/current-exam') ?>">Curretn Exams</a>
						</li>
						
					</ul>
				</div>
				
			</div>









			<ul class="box-info ps-0">
				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text mt-3">
						<h3><?= count($processExams)?></h3>
						<p> Total Exams today</p>
					</span>
				</li>
				
				<li>
					<i class='bx bx-calendar' ></i>
					<span class="text mt-3">
						<h3><?= date('F j, Y') ?></h3>
						<p> Date </p>
					</span>
				</li>
			</ul>










			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3> Today Exams</h3>
                            
                        </div>
                        <ul class="todo-list p-0 m-0">
							<?php foreach($processExams as $exam): ?>
								<li class="<?= $exam['isPast'] ? "completed" : "not-completed"?>">
								
									<p>
										<?= $exam['title'] ?> (<?= $exam['type'] ?>)
									</p>
									
									<p></p>
									
									<p style="text-align: center;">
										<?= $exam['dateTime'] ?> - <?= $exam['endTime'] ?>
									</p>
									
									<p>
										<?= $exam['status'] ?>
									</p>
									<?php if($exam['status'] == "In Process"): ?>
										<a class="btn btn-info" href="<?= base_url('Admin/live-exam/'.$exam['id'].'/'.$exam['title'].'/'.$exam['examTitle'])?>" title="Exam Status">
											Show 
										</a>
									<?php else: ?>
										<p></p>
									<?php endif; ?>
									
								</li>
							<?php endforeach; ?>
                        </ul>
                    </div>

				</div>
			</div>

		</main>
		<!-- MAIN -->