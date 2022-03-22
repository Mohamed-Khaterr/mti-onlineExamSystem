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















<?php

include 'templates/footer.php';

 ?>