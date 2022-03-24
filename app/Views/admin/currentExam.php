

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
					<i class='bx bxs-group ' ></i>
					<span class="text mt-3">
						<h3><?= $studentCountAll ?></h3>
						<p> Total Students</p>
					</span>
				</li>

				

				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text mt-3">
						<h3><?= count($processExams)?></h3>
						<p> Total Exams today</p>
					</span>
				</li>
			</ul>










			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <h3> Inprocess Exams</h3>
                            
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
										<a href="<?= base_url('Admin/live-exam/'.$exam['id'].'/'.$exam['title'].'/'.$exam['examTitle'])?>" title="Exam Status">
											<button style="border: none;">Show</button> 
										</a>
									<?php else: ?>
										<p></p>
									<?php endif; ?>
									
								</li>
							<?php endforeach; ?>
							
							<!--
                            <li class="not-completed">
                                <p>Final Exam In Comuter Graphics</p>
                                
                                <a href="" title="Exam Status">
									<button style="border: none;">Show</button> 
								</a>
                            </li>


                             <li class="completed">
                                <p>Final Exam In Comuter Graphics </p>
                                
                                <a href="" title="Exam Status">
									<button style="border: none;">Show</button> 
								</a>
                            </li>

							<li class="not-completed">
                                <p>... Exam In ... </p>
                                
                                <a href="" title="Exam Status">
									<button style="border: none;">Show</button> 
								</a>
                            </li>
							-->

							
                        </ul>
                    </div>

				</div>
			</div>

		</main>
		<!-- MAIN -->