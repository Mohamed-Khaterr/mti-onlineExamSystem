<?php include "templates/header.php";
date_default_timezone_set("Africa/Cairo");

$ctime = strtotime(date('d-m-Y H:i:s A',time()));
?>









<!-- ======= Exam Section ======= -->


<section >



  <div class="parent-studend-exam container  ">

  <?php if($exams):
  foreach($exams as $e):?>

  <div class="studend-exam shadow-lg col-4">

    <h2> <?= $e->exam_title; ?></h2>
    <h4> Time: <?= date("d-m-Y".'  '."H:i",strtotime($e->exam_date_time)); ?></h4>
    <h4> Duration: <?= date("H:i",strtotime($e->exam_duration)); ?></h4>
    <h4> Score: <?= $e->total_grade?></h4>

   <?php
   $ddate = strtotime($e->exam_date_time);
   $duration = strtotime($e->exam_duration);
   $sum = $ddate + $duration;
  
 
    if($ddate > $ctime ):  ?>
       <a  class="btn  bg-blue disabled">Start exam</a>



    <?php elseif($ddate <= $ctime): ?>
      <a href="student_examing.html" class="btn  bg-blue">Start Exam</a>

  
  
  
  <?php endif; ?>


  </div>
  <?php endforeach;
  
  else:
    return null; 
  endif; ?>


</div>
</section>


<!-- End Exam Section -->











<?php include "templates/footer.php";
?>