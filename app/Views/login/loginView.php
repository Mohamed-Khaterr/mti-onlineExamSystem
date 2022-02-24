<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    




    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body >

<div class="Login-bg">
	<div class="grand-login">
		<div class="parent-login shadow-lg ">
			<div class="img-logo" >
				<div class="chide-login ">
					<img src="img/MTI-Logo.png" alt="">
				</div>
			</div>


			<form method="POST">
				<?php 
					//function creates a hidden input with a CSRF token that helps protect against some common attacks 
					echo csrf_field(); 
				?>
				<div class="about-login chide-login text-light">
					<label for="formGroupExampleInput" class="form-label">Email :</label>
					<input type="email" name="email" class="form-control" id="formGroupExampleInput" placeholder="john@mail.com">
					<div><?php echo $emailError; ?></div>
					
					<br>
					
					<label for="formGroupExampleInput2" class="form-label">Password :</label>
					<input type="password" name="password" class="form-control " id="formGroupExampleInput2" placeholder="****">
					<div><?php echo $passwordError; ?></div>
					
					<br><br>
					
					<div class="mt-3 ms-5 w-75  btn bg-blue text-light">
						<input type="submit" name="login" value="Login" class="btn brand z-depth-0 text-light">   
					</div>
					<div class="text-light"><?php echo $validationError; ?></div> 
				</div>
			</form>
		</div>
	</div>
</div>