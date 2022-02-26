
<main id="main" data-aos="fade-in">
	<!-- ======= Breadcrumbs ======= -->
	<div class="breadcrumbs">
		<div class="container">
			<h2>Profile Edit</h2>
		</div>
	</div>
	<!-- End Breadcrumbs -->


	<div class="mt-4">
			<!-- image part -->
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

					<!-- information part -->
					<form method="POST" >
					<?php echo csrf_field(); ?>
						<?php foreach($result as $row): ?>
						<div class="col-md-8">
							<div class="card mb-3">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Full Name</h6>
										</div>

										<div class="col-sm-9 text-secondary">
											<input name="fullName" value="<?php echo $row->doctor_full_name ?>" class="input-group-text input-group" type="text">
											<div class="red-text"><?php echo $fullNameError; ?></div>
										</div>
									</div>
									<hr>

									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Username</h6>
										</div>
										
										<div class="col-sm-9 text-secondary">
											<input name="username" value="<?php echo $row->doctor_username ?>" class="input-group-text input-group" type="text">
											<div class="red-text"><?php echo $usernameError; ?></div>
										</div>
									</div>
									<hr>
									
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Password</h6>
										</div>
										
										<div class="col-sm-9 text-secondary">
											<input name="password" placeholder="New Password" class="input-group-text input-group" type="text">
											<div class="red-text"><?php echo $passwordError; ?></div>
										</div>
									</div>
									<hr>
									
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Confirm Password</h6>
										</div>
										
										<div class="col-sm-9 text-secondary">
											<input name="confirmPassword" placeholder="Confirm Password" class="input-group-text input-group" type="text">
											<div class="red-text"><?php echo $confirmPasswordError; ?></div>
										</div>
									</div>
									<hr>

									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Email</h6>
										</div>

										<div class="col-sm-9 text-secondary">
											<input name="email" value="<?php echo $row->doctor_email ?>" class="input-group-text input-group" type="email">
											<div class="red-text"><?php echo $emailError; ?></div>
										</div>
									</div>
									<hr>
									
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Gender</h6>
										</div>

										<div class="col-sm-9 text-secondary">
											<select name="gender" class="input-group-text input-group">
												<option value="<?php echo $row->doctor_gender ?>" selected ><?php echo $row->doctor_gender ?></option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
									<hr>
									
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0">Birth Date</h6>
										</div>

										<div class="col-sm-9 text-secondary">
											<input name="birthday" value="<?php echo $row->doctor_BD ?>" class="input-group-text input-group" type="date">
										</div>
									</div>
									<hr>

									<div class="row">
										<div class="col-sm-12">
											<button name="save" class="btn btn-success "> Save </button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</form>
					<!-- End information part -->
				</div>
			</div>
		</div>
	</div>
</main>
