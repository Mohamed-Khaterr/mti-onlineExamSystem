



<!-- MAIN -->
<main>
			<div class="head-title">
				<div class="left">
					<h1> <?= $exam->exam_title?> Report</h1>
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
						<li><i class='bx bx-chevron-right' ></i></li>

						<li>
							<a class="active" href="/Admin/report/<?=$exam->exam_id?>"> <?= $exam->exam_title?></a>
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
                        <table style = " border-collapse: collapse; border-radius: 10px; overflow: hidden;" >
						<thead>
						<tr  style=' border-bottom:3px solid transparent;'>

<td style= 'font-weight:bold; text-align:center;' >Student Id</td>
<td style= 'font-weight:bold;text-align:center;'>Student Name</td>
<td style= 'font-weight:bold;text-align:center;' >Exam title</td>
<td style= 'font-weight:bold;text-align:center;'>Image</td>

</tr>
						</thead>

						
<tbody>
						<?php foreach($reports as $r): ?>

								
							    <tr class = 'completed' style=' background-color:#eee; border-bottom:6px solid #f9f9f9; height:400px '>

								    <td style= 'font-weight:bold; text-align:center;padding-top:185px'> <?=$r->userID?></td>
									<td style= 'font-weight:bold; text-align:center; '><?= $r->userName?> </td>
									<td style= 'font-weight:bold; text-align:center; '> <?= $exam->exam_title?></td>
									<td style= 'text-align:center; '><img alt="No Photo Now" src="<?= ''.$r->image?>" class="" style="width: 460px; height: 300px; border-radius: 5px;"> </td>
								

									
									
								</tr>
								
								
							<?php endforeach; ?>
						</tbody>
						</table>
                    </div>

				</div>
			</div>



			

						</main>