<?php

include 'templates/header.php';

$i = 0 ; foreach($noq as $n){
    $i++;
    }
    
    
    $total_pages = ceil($i / 1);     
      

 ?>

<div class="container mt-5 pt-5">
    <div class="row">
<div class="col-lg-8 text-center">
<h1 class= 'mb-4' >Exam information </h1>

<table class="table table-secondary text-ceter">

<tr>
    <th class="text-center">Exam Title </th>
    <th class="text-center" col-span='2'><?= $exam->exam_title ?></th>
</tr>

<tr>
<th class="text-center">Exam duration </th>
    <th class="text-center" col-span='2'><?= $exam->exam_duration ?></th>
</tr>
<tr>
<th class="text-center">Exam Questions </th>
    <th class="text-center" col-span='2'><?= $total_pages ?></th>
</tr>
<tr>
<th class="text-center">Exam Score </th>
    <th class="text-center" col-span='2'><?= $exam->total_grade ?></th>
</tr>


</table>
<h1 class="mb-5"></h1>

<form action="" method="POST">


<?=  csrf_field(); ?>

<input class="btn bg-blue" type="hidden" value="<?= $exam->exam_id ?>"  name="examid">
<input class="btn bg-blue" type="submit" value="Submit"  name="subexam" >


</form>
</div>
</div>
</div>


<div class="container mt-5">
    <h2 style="color:red">Exam Rules:</h2> 
<ul style="list-style-type:circle">
  <li style="color:black; font-weight:bold">You Must Allow Camera Access.</li>
  <li style="color:black; font-weight:Bold">If you Leave Exam or Open Another Tab The Exam Will Close.</li>
  <li style="color:black; font-weight:Bold">Becareful Don't Press any Button Outside Exam Window.</li>
  <li style="color:black; font-weight:Bold">If You Minize Browser window The Exam Will Close.</li>
</ul>
</div>






<center class="d-none"><video class="d-none" id="video" width="640" height="480" autoplay></video></center>









<?php

include 'templates/footer.php';

 ?>
 <script>
     var video = document.getElementById('video');
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
 navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
 video.src = window.URL.createObjectURL(stream);
 video.play();
 });
}
 </script>