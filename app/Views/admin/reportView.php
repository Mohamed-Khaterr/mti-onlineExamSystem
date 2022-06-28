



<!-- MAIN -->
<main style="padding-top:10px;">

<div class="header" style="display:flex; flex-wrap:wrap; justify-content:space-between">
<div class="l" style="padding-left:10px; margin:10px 0px;">
	<h3 style="font-weight:bold;">Mti University for Technology and Information</h3>
	<h4>Course Title: <?= $exam->exam_title?></h4>
	<h4>Course Code: cs61516</h4>
</div>
<div class="r" style="margin-right:50px;">
<img src="/img/MTI-Logo.png" style="width:80%" alt="">
</div>

</div>
<div class="" style="text-align:center; margin-bottom:20px; text-decoration:underline;">
<h2><?= $exam->exam_title?> Report</h2>
</div>

                    <div class="" style="width:100%;">
                      
                        <table style = "background-color:#F9F9F9;;border-radius: 10px;  width:100%; padding-bottom:25px;" >
						<thead>
						<tr  style='height:80px'>

                            <td style= 'font-weight:bold; font-size:20px;text-align:left; padding-left:20px;' >Student Id</td>
                            <td style= 'font-weight:bold;text-align:center;font-size:20px;'>Student Name</td>
                            <td style= 'font-weight:bold;text-align:center;font-size:20px;' >Exam title</td>
                            <td style= 'font-weight:bold;text-align:center;font-size:20px;' >Status</td>
                            <td style= 'font-weight:bold;text-align:center;font-size:20px;'>Image</td>

                        </tr>
						</thead>

						
                        <tbody>
						<?php foreach($reports as $r): ?>

								
							    <tr  style='background-color:#eee;'>

								    <td style= 'font-weight:bold; text-align:left; padding-left:30px'> <?=$r->userID?></td>
									<td style= 'font-weight:bold;text-align:center;'><?= $r->userName?> </td>
									<td style= 'font-weight:bold;text-align:center;'> <?= $exam->exam_title?></td>
									<td style= 'font-weight:bold;text-align:center;' > <span style="
									background-color:#FD7238; padding:5px; border-radius:20px; color:white;">Not Cheating</span> </td>
									<td style= 'text-align:center; padding-top:8px '><img alt="No Photo Now" src="<?= ''.$r->image?>" class="" style="width: 300px; height: 150px; border-radius: 5px;"> </td>
								

									
									
								</tr>
								
								
							<?php endforeach; ?>
						</tbody>
						</table>
                    </div>

			



			

						</main>