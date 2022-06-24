



<!-- MAIN -->
<main>
			<div class="head-title">
				<div class="left">
					<h1>Reports</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Admin') ?>">Dashboard</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin') ?>">Home</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						
						<!-- <li><i class='bx bx-chevron-right' ></i></li> -->
						
						<li>
							<a class="active" href="/Admin/reports">Report</a>
						</li>
					</ul>
				</div>
				
			</div>



			<div class="table-data ">
				<div class="order">
					
					


                    <div class="todo ">
                        <div class="head">
                            <!-- <h3> Reports Exams</h3> -->
                            
                        </div>
                        <table style = " border-collapse: collapse;border-radius: 10px;overflow: hidden;" >

						<?php foreach($exams as $e): ?>
								
							    <tr class = 'completed' style=' background-color:#eee; border-bottom:3px solid #fff;'>

								    <td style= 'font-weight:bold;  text-align:center; padding-left: 10px;'><?= $e->exam_title ?></td>
									<td style= 'font-weight:bold; text-align:left '><?= date('d M - h:i A',strtotime($e->exam_date_time)) ?></td>
									<td style= 'font-weight:bold; text-align:left '> <a class="btn btn-info" href="<?= base_url("Admin/report/$e->exam_id")?>">show </a> </td>
								

									
									
								</tr>
								
								
							<?php endforeach; ?>

						</table>
                    </div>

				</div>
			</div>

						</main>