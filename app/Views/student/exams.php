<?php include "templates/header.php";
date_default_timezone_set("Africa/Cairo");
$cdate = date('d-m-Y');
$cdatee = date('Y-m-d h:i:s');
$model = new \App\Models\ExamModel();



function addTimeToDatetime($date, $duration){
  $hours = date('H', strtotime($duration));
  $minutes = date('i', strtotime($duration));
  $second = date('s', strtotime($duration));
  
  $newDate = date('Y-m-d H:i:s', strtotime($date . " +" . $hours . " hours". " + " . $minutes . " minutes" .  " + " . $second . " second"));
  
  return $newDate;
}


?>






<div class="container ">
  <div class="w-50 mx-auto mt-3 ">
  <?php
if(session()->get('submit')):?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?= session()->get('submit'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif?>

  </div>
</div>
<div class="container ">
  <div class="w-50 mx-auto mt-3 ">
  <?php
if(session()->get('enroll')):?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?= session()->get('enroll'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif?>

  </div>
</div>


<!-- ======= Exam Section ======= -->


<section >



  <div style=" height : auto;  " class="container mb-5 ">
  <div class="row justify-content-around pb-3">
    <h4 style="text-decoration: underline;" class="w-100 mb-4">Today: <?= $cdate;?></h4>
    
  <?php $current_datetime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));

  if($exams):
  foreach($exams as $e):
    $duration = $e->exam_duration;
    $exam_star_time= $e->exam_date_time;
    
    $exam_end_time = addTimeToDatetime($exam_star_time, $duration);
    
    
    if((date("d-m-Y",strtotime($e->exam_date_time)) == $cdate) && !($exam_end_time <= $current_datetime) ):  
$_EX='';



?>



  <div class=" text-center bg-light border border-dark mb-2 py-3 col-5 ">

    <h2 > <?= $e->exam_title; ?></h2>
    <h4> Time: <?= date("h:i a",strtotime($e->exam_date_time)); ?></h4>
    <h4> Score: <?= $e->total_grade;?></h4>
 

    

   <?php


     if(!$model->exam_started($e->exam_id)):
 
    ?>
    <a   class="btn  bg-blue disabled">Start exam</a>

   
  <?php else:?>

       <a  href='/student/exam_info/<?= $e->exam_id?>' class="btn  bg-blue">Start exam</a>
      

    <?php endif; ?>    

</div>
  <?php 

   else:
  
  $_NOE = '' ;
  

    ?>
  
  <?php 
  endif;?>


  
  <?php endforeach;

  if(isset($_NOE) && !isset($_EX)):
?>
<div class=" text-center bg-light border border-dark mb-2 py-3 col-5">



<h2>No Exams!</h2>
  
   </div>


  <?php endif;  
  endif; 
  ?>

</div>
</div>

<div class="text-center w-100">
<button id="upcoming" class="btn  bg-blue " onclick="myFunction()" >Upcoming Exams</button>
</div>


<div style=" height : auto; display:none;"  class="container mb-5" id="UPDIV">
  <div class="row justify-content-around pb-3">
    <h4 style="  text-decoration: underline;" class="w-100 mt-5 mb-4">Upcoming Exams:</h4>


    <table class="table text-ceter">

<tr>

    
    <th class="text-center">Exam Title </th>
    <th class="text-center">Exam Date_Time</th>
    <th class="text-center">Exam Duration</th>
    
    <th class="text-center">Scroe</th>

</tr>

<tr>
    
<?php if($exams):
  foreach($exams as $e):
    if(strtotime($e->exam_date_time) > strtotime($cdate) && date('d-m-Y',strtotime($e->exam_date_time)) != date('d-m-Y',strtotime($cdate)) ):  
 
?>



  

    <td class="text-center"><?= $e->exam_title; ?></td>
    <td class="text-center"><?= date("D - d-m-Y".'  '."h:i A",strtotime($e->exam_date_time)); ?></td>
    <td class="text-center"><?= date("H:i",strtotime($e->exam_duration)); ?></td>
    <td class="text-center"><?= $e->total_grade?></td>
  
  <?php endif; ?>

</tr>

<?php endforeach;  
  endif;?>   
</table>


</div>
</div>

</section>


<!-- End Exam Section -->











<?php include "templates/footer.php";
?>