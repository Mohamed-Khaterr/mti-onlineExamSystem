<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?> </title>
  <style>
 

#img1{
  display: none;
}
#img2{
  display: none;
}
#img3{
  display: none;
}
#video {
  border: 1px solid black;
  box-shadow: 2px 2px 3px black;
  width:320px;
  height:240px;
}

#photo {
  border: 1px solid black;
  box-shadow: 2px 2px 3px black;
  width:320px;
  height:240px;
}

#canvas {
  display:none;
}

.camera {
  width: 340px;
  display:inline-block;
}

.output {
  width: 340px;
  display:inline-block;
  vertical-align: top;
}

#startbutton {
  display:block;
  position:relative;
  margin-left:auto;
  margin-right:auto;
  bottom:32px;
  background-color: rgba(0, 150, 0, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.7);
  box-shadow: 0px 0px 1px 2px rgba(0, 0, 0, 0.2);
  font-size: 14px;
  font-family: "Lucida Grande", "Arial", sans-serif;
  color: rgba(255, 255, 255, 1.0);
}

.contentarea {
  font-size: 16px;
  font-family: "Lucida Grande", "Arial", sans-serif;
  width: 760px;
}

  </style>

  <!-- Favicons -->
  <link href="/assets/img/MTI.png" rel="icon">
  <link href="/assets/img/MTI.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  
  <link href="/assets/css/TimeCircles.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="/assets/css/css.css">
</head>
<?php if( isset($exam)): ?>
<body style="background-color:#ecedef;">

  <?php
endif;
      $uri = service('uri');
  ?>

  <!-- ======= Header ======= -->
  
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo  me-auto py-1"><a href="/student">Mti Unversity</a></h1>
     

      <!-- .navbar -->
      <nav id="navbar" class="navbar order-last order-lg-0">

      <?php if(!session()->get('isLoggedIn')):?>
        <?php else:?>
        <ul>
        
        

        <li><a class="   <?= ($uri->getsegment(2)=='home' ? 'active' :null);?>" href="/student/home">Home</a></li>
          <li><a class="<?= ($uri->getsegment(2)=='courses' ? 'active' :null)?>" href="/student/courses">Courses</a></li>
          <li><a class="<?= ($uri->getsegment(2)=='exams' ? 'active' :null)?>" href="/student/exams">Exams</a></li>
     





            
          
         <li> <div class="dropdown ml-3">
  <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
  <span style="color:lightblack; font-weight:600;"> <?php if(isset($student)){
                 echo $student['student_fname'].' '.$student['student_lname']; 
}
  else{

    echo session()->get('student_fname').' '.session()->get('student_lname');

  }?> </span>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    
   
    <a class="<?= ($uri->getsegment(2)=='profile' ? 'active' :null)?>" href="/student/profile">Profile</a>
    
    <div class="dropdown-divider"></div>
    <a class="<?= ($uri->getsegment(2)=='resetpassword' ? 'active' :null)?>" href="/student/resetpassword">Reset Password</a>
  <a class=" dropdown-item" href="<?= base_url() ?>/Logout">logout</a>
  </div>
</div>
</li>

       
        </ul>
       
        <?php endif?>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->


    </div>
  </header>
  <!-- End Header -->
  <?php if(session()->get('isLoggedIn')):?>

    <?php if(! isset($exam)): ?>
       
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
      <div class="container">
        <h2><?= $title ?></h2>
     </div>
    </div><!-- End Breadcrumbs -->
    <?php endif;?>
    <?php endif;?>
  

    

 