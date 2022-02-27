<?php include 'templates/header.php' ?>


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







<div class="container">
<div class="col-md-10 mt-5 mx-auto">



<div class="card mb-3">
<div class="card-body">
<form method="post" action="/student/resetpassword">
<?=  csrf_field(); ?>
  <div class="row">
    <div class="col-sm-3">
      <h6 class="mb-0">Current Password</h6>
    </div>


    <div class="col-sm-9 text-secondary">
        <input class="input-group-text input-group" name='current_password' type="password" value="">
    </div>

  </div>
  <hr>


  <div class="row">
    <div class="col-sm-3">
      <h6 class="mb-0">New password</h6>
    </div>


    <div class="col-sm-9 text-secondary">
        <input class="input-group-text input-group" name='student_password' type="password"  value="">
    </div>

  </div>
  <hr>

  <div class="row">
    <div class="col-sm-3">
      <h6 class="mb-0">New pass_confirm</h6>
    </div>


    <div class="col-sm-9 text-secondary">
        <input class="input-group-text input-group" name='password_confirm' type="password"  value="">
    </div>

  </div>
  <hr>
 
  
 
  
  
  <div class="row">

  <div class="col-sm-3">
      <h6 class="mb-0"></h6>
    </div>
    <div class="col-sm-9 ">
      <button class="btn bg-blue  w-25 "> Submit </button>
    </div>
  </div>

  

  </form>
</div>
<div class="container ">
  <div class="w-100  ">
  <?php
if(session()->get('failed')):?>
<div class="alert alert-danger " role="alert">
<?= session()->get('failed'); ?>
</div>
<?php endif?>

  </div>
</div>

<?php if(isset($validation)):?>

<div class="w-100 ">
  <div class="alert alert-danger" role="alert">
    <?= $validation->listErrors();?>
  </div>
</div>

<?php endif?>

</div>
</div>

<?php include 'templates/footer.php' ?>


 

