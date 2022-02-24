	
	<main id="main" data-aos="fade-in">
		<div class="breadcrumbs">
			<div class="container">
				<h2>Courses</h2>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="dr_search">
					<input type="search" placeholder=" Search...."  class=""  name="" id="">
				</div>

				<table class="table table-striped dr_course_table      ">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">TiTle</th>
							<th scope="col">Subject code</th>
							<th scope="col">level</th>
							<th scope="col"></th>
						</tr>
					</thead>
					
					<tbody>
						<?php $counter = 1; ?>
						<?php foreach($result as $row): ?>
							<tr>
								<th scope="row"><?php echo $counter; $counter+= 1; ?></th>
								<td><?= esc($row->course_title) ?></td>
								<td><?= $row->course_code ?></td>
								<td><?= $row->course_level ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
