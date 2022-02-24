

<main id="main" data-aos="fade-in">

	<!-- ======= Breadcrumbs ======= -->
	<div class="breadcrumbs">
		<div class="container">
			<h2>Profile</h2>
		</div>
	</div>
	<!-- End Breadcrumbs -->



	<div class="mt-5">
		<div class="container ">
			<div class="main-body">
				<div class="row gutters-sm">
					<div class="col-md-4 mb-3">
						<div class="card w-100 h-100">
							<div class="card-body ">
								<div class="d-flex flex-column align-items-center text-center">
									<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle mt-2" width="150">
									
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div class="card mb-3">

							<div class="card-body">
							<?php foreach($result as $row): ?>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Full Name</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?php echo $row->doctor_full_name ?>
									</div>
								</div>
								<hr>

								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Username</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?php echo $row->doctor_username ?>
									</div>
								</div>
								<hr>
								
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Email</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?php echo $row->doctor_email ?>
									</div>
								</div>
								<hr>
								
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Gender</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?php echo $row->doctor_gender ?>
									</div>
								</div>
								<hr>
								
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Birth Date</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?php echo $row->doctor_BD ?>
									</div>
								</div>
								<hr>
								
								<div class="row">
									<div class="col-sm-12">
										<a class="btn btn-success "  href = "edit">Edit</a>
									</div>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>