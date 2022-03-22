	
	<main id="main" data-aos="fade-in">
		<div class="breadcrumbs">
			<div class="container">
				<h2>Courses</h2>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="dr_search">
					<input type="search" placeholder=" Search for Title...." onkeyup="searchBar()" id="userInput" name="search">
				</div>

				<table class="table table-striped dr_course_table " id="tableID">
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
						<?php foreach($courses['courses'] as $course): ?>
							<tr>
								<td scope="row"><?php echo $counter; $counter+= 1; ?></td>
								<td><?= $course['title'] ?></td>
								<td><?= $course['code'] ?></td>
								<td><?= $course['level'] ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
