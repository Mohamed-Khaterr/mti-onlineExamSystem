<?php include "templates/header.php";
?>

<div class="container ">
  <div class="w-50 mx-auto mt-3 ">
  <?php
if(session()->get('failed')):?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?= session()->get('failed'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif?>

  </div>
</div>

    <div class="mt-4">

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
    <div class=" d-grid mt-5 ">
      <button id='upload'  class="btn bg-blue "  >Upload Photo</button>
      <a href='/student/del_pic' class="btn bg-blue mt-3 " >Delete Photo</a>
    </div>
  </div>
</div>
</div>

</div>

<div class="modal d-none" id="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      
        <h5 class="modal-title">Change profile Photo</h5>
        <button type="button" class="close" id='close' data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class=" container">
      <div class="alert alert-danger d-none  " id= 'alert_pic'>invalid file</div>
      </div>
      <form  method="post" action="/student/update_pic" enctype="multipart/form-data">
      <?=  csrf_field(); ?>
      <div class="modal-body">
        <input required type="file" id="file" class="my-5"  name="student_pic">
      </div>
      <div class="modal-footer">
        
        <button type="submit" id="save" class="btn btn-primary">Save</button>
        </div>  
      </form>

      
    </div>
  </div>
</div>



<!-- information part -->


<div class="col-md-8">
<div class="card mb-3">
<form method="post" action="/student/update">
<?=  csrf_field(); ?>
<div class="card-body">
  <div class="row">
    <div class="col-sm-3">
      <h6 class="mb-0">First Name</h6>
    </div>


    <div class="col-sm-9 text-secondary">
        <input class="input-group-text input-group" name='student_fname' type="text" value=" <?= set_value('student_fname',$student['student_fname'])?>">
    </div>

  </div>
  <hr>
  <div class="row">
    <div class="col-sm-3">
      <h6 class="mb-0">Last Name</h6>
    </div>


    <div class="col-sm-9 text-secondary">
        <input class="input-group-text input-group" name='student_lname' type="text"  value="<?= set_value('student_lname',$student['student_lname'])?>">
    </div>

  </div>
  <hr>

  <div class="row">
    <div class="col-sm-3">
      <h6 class="mb-0">Birth Date</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        <input class="input-group-text input-group" name='student_BD' type="date" value="<?= set_value('student_BD',$student['student_BD'])?>">
    </div>
  </div>
 

  
  <hr>
  
  
  <?php if(isset($validation)):?>

<div class="col-12">
  <div class="alert alert-danger" role="alert">
    <?= $validation->listErrors();?>
  </div>
</div>

<?php endif?>
  <div class="row">
    <div class="col-sm-12">
      <button class="btn bg-blue "> Save </button>
    </div>
  </div>
</div>

</form>
</div>



</div>
 
</div>

</div>
  </div>
  </div>
  

<?php include "templates/footer.php";
?>