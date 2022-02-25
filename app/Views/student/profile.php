<?php include "templates/header.php";
?>


<div class="container ">
  <div class="w-50 mx-auto mt-3 ">
  <?php
if(session()->get('success')):?>
<div class="alert alert-success " role="alert">
<?= session()->get('success'); ?>
</div>
<?php endif?>

  </div>
</div>


<div class="mt-5">

<!-- image part -->


<div class="container ">
  <div class="main-body">
        <div class="row gutters-sm">

          <div class="col-md-4 mb-3">
            <div class="card w-100 h-100">
              <div class="card-body ">
                <div class="d-flex flex-column align-items-center text-center">
                  <?php if($student['student_pic']): ?>
                
                    <img src="<?= '/uploads/students/'.$student['student_pic'] ?>" alt="Admin" class="rounded-circle mt-4" width="150">
                   <?php else:?>
                    <img src="/assets/img/avatar7.png" alt="Ad" class="rounded-circle mt-4" width="150">
                  <?php endif; ?>
                    <div class="col-sm-9 mt-4">
                  <h4><?= $student['student_fname'].' '.$student['student_lname']?> </h4>


                  </div>
                </div>
              </div>
            </div>
            
          </div>




              <!-- information part -->

          <div class="col-md-8">
            <div class="card mb-3">
              
              <div class="card-body">
                <div class="row">
                  
                <div class="col-sm-3">
                    <h6 class="mb-0">First Name</h6>
                  </div>
                
                  <div class="col-sm-9 text-secondary">
                  <?= $student['student_fname']?> 
                  </div>

                </div>
                <hr>

                <div class="row">
                
                <div class="col-sm-3">
                    <h6 class="mb-0">Last Name</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                  <?= $student['student_lname']?> 
                  </div>
                </div>
                <hr>
                <div class="row">
                
                <div class="col-sm-3">
                    <h6 class="mb-0">Level</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                  <?= $student['student_lvl']?> 
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Birth Date</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                  <?= $student['student_BD']?> 
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>

                  <div class="col-sm-9 text-secondary">
                  <?= $student['student_email']?> 
                  </div>

                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Gender</h6>
                  </div>

                  <div class="col-sm-9 text-secondary">
                  <?= $student['student_gender']?>
                  </div>

                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-12">
                    <a class="btn bg-blue "  href = "/student/update">Edit</a>
                  </div>
                </div>
              </div>


            </div>

            



          </div>
        </div>

      </div>
  </div>










</div>
















<?php include "templates/footer.php";
?>