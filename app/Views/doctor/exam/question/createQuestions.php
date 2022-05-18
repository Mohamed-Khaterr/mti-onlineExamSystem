


<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Create Exam</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Doctor/dashboard') ?>">Dashboard</a>
						</li>
            
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Doctor/dashboard') ?>">Home</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Doctor/dashboard') ?>">Exams</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i>
						
						<li>
							<a class="active" href="<?= base_url('Doctor/create-exam') ?>">Create Exam</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i>
						
						<li>
							<a class="active" href="">Create Questions</a>
						</li>
						
					</ul>
				</div>
				
			</div>
			
			
<form method="POST">
<?= csrf_field() ?>	
	<div class="table-data ">
		<div class="order">

			<div class="todo ">
				<div class="head">
					<h3>  Question Type </h3>
				</div>
					
				<div class="d-flex justify-content-center">
					<div class="form-check me-5">
						<input name="question_type" value="True or False" class="form-check-input" type="radio" onclick="TrueFalse()" >
						<label class="form-check-label">True or False Question</label>
					</div>

					<div class="form-check">
						<input name="question_type" value="Multiple Choices"  class="form-check-input" type="radio"   onclick="MCQ()" >
						<label class="form-check-label" >MCQ Question</label>
					</div>
					<?= isset($error['question_type']) ? "Choose type of Question":"" ?>
				</div>
			</div>
		</div>
	</div>







	<div class="table-data d-none " id="BoxTrueFalse">
		<div class="order">




			<div class="todo ">
				<div class="head">
					<h3> True or False Question</h3>
				</div>
				
				<div class="col-md-12">
					<label for="inputCity" class="form-label">Question</label>
					<textarea name="tfQuestion" class="form-control" id="inputCity"></textarea>
					<?= isset($error['tfQuestion']) ? "Add Question":"" ?>
				</div>
				
				<div class="d-flex justify-content-between mt-3">

					<div class="col-md-3">
						
						<div class="form-check">
							<label for="inputState" class="form-label">Correct Anwser </label>
							<select name="tfAnswer" id="inputState" class="form-select">
								<option disabled selected>Choise...</option>
								<option value="True">True</option>
								<option value="False">False</option>
							</select>
							<?= isset($error['tfAnswer']) ? "Choose answer for Question":"" ?>
						</div>
					</div>

					<div class="col-md-3">
						<label for="inputCity" class="form-label">Question Grade</label>
						<input name="tfGrade" type="number" class="form-control" id="inputCity">
						<?= isset($error['tfGrade']) ? "Add Grade for Question":"" ?>
					</div>
				</div>


				<div class="d-flex justify-content-between mt-4">
					<div class="">
						<button name="savetf" type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>








	<div class="table-data d-none" id="BoxMCQ">
		<div class="order">
			<div class="todo ">
				<div class="head">
					<h3> MCQ Question</h3>
				</div>




				<div class="col-md-12">
					<label for="inputCity" class="form-label">Question</label>
					<textarea name="chooseQuestion" type="text" class="form-control" id="inputCity"></textarea>
					
					<?= isset($error['chooseQuestion']) ? "Add Question please":"" ?>
				</div>


				<div class="d-flex justify-content-between mt-3" >
					<div class="col-md-3">
						<label for="inputCity" class="form-label">Choose : 1 </label>
						<input name="options[]" type="text" class="form-control" id="inputCity">
					</div>
					
					<div class="col-md-3">
						<label for="inputCity" class="form-label">Choose : 2</label>
						<input name="options[]" type="text" class="form-control" id="inputCity">
					</div>

					<div class="col-md-3">
						<label for="inputCity" class="form-label">Choose : 3</label>
						<input name="options[]" type="text" class="form-control" id="inputCity">
					</div>
					
					
					<?= isset($error['options']) ? "There is empty Option":"" ?>
				</div>
				
				<div id="addChoice">
				</div>
				
				<hr />
				
				<div class="d-flex justify-content-between mt-3">
					<div class="col-md-3">
						<label for="inputCity" class="form-label">Correct Anwser</label>
						<input name="chooseAnswer" type="text" class="form-control" id="inputCity">
						
						<?= isset($error['chooseAnswer']) ? "Add correct Answer":"" ?>
					</div>

					<div class="col-md-3">
						<label for="inputCity" class="form-label">Question Grade</label>
						<input name="chooseGrade" type="number" class="form-control" id="inputCity">
						
						<?= isset($error['chooseGrase']) ? "Add Grade for Question":"" ?>
					</div>
				</div>


				<div class="d-flex justify-content-between mt-4">
					<div class=" ">
						<button type="button" class="btn btn-primary" onclick="addChoice()">Add Choise </button>
						<button name="saveChoose" type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>



</main>
<!-- MAIN -->



<!-- POPUP MODEL -->
<div class="popup" id="popup-1">
	<div class="overlay"></div>
	<div class="content">
			<div class="close-btn" onclick="stopPopupModel()">&times;</div>
			<h1 id="title"</h1>
			<hr>
			<h3 id="body"></h3>
			
			<br>
			<button id="add" type="button" style="margin-right: 25px;" class="btn btn-primary">Add Question</button>
			<button id="back" type="button" class="btn btn-danger">Back</button>
	</div>
</div>
<!-- END POPUP MODEL -->
		
<script>
	const errorMessage = "<?= $errorMessage ?>";
	const success = "<?= $success ?>";
	
	document.getElementById("back").onclick = function () {
        location.href = "<?= base_url('Doctor') ?>";
    };
	
	document.getElementById("add").onclick = function () {
        location.reload();
    };
	
	if(success != ""){
		document.getElementById('title').innerHTML = "Success";
		document.getElementById('body').innerHTML = success;
		showPopupModel();
	}
	
	if(errorMessage != ""){
		document.getElementById('title').innerHTML = "Error!";
		document.getElementById('body').innerHTML = errorMessage;
		
		document.getElementById('add').style.display = 'none';
		document.getElementById('back').style.display = 'none';
		
		showPopupModel();
	}



	function showPopupModel(){
		document.getElementById("popup-1").classList.toggle("active");
	}

	function stopPopupModel(){
		document.getElementById("popup-1").classList.toggle("active");
	}
</script>