

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
						<h3><?= count($processExams['id'])?></h3>
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
							<?php for($i = 0; $i < count($processExams['id']); $i++): ?>
								<li class="<?= $processExams['isPast'][$i] ? "completed" : "not-completed"?>">
									<p>
										<?= $processExams['title'][$i] ?> (<?= $processExams['type'][$i] ?>)
									</p>
									<p>
										<?= $processExams['dateTime'][$i] ?>
									</p>
									
									<a href="<?= base_url('Admin/live-exam/'.$processExams['id'][$i])?>" title="Exam Status">
										<button style="border: none;">Show</button> 
									</a>
								</li>
							<?php endfor; ?>
							
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