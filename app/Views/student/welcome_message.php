<?php include "templates/header.php";
use CodeIgniter\classes\User;
// use CodeIgniter\classes\User;
use CodeIgniter\init;
?>



 <h1 class="fadeInDown display-1 text-center m-auto mt-5">welcome student: <span style="color:#003771;"><?= session()->get('student_fname').' '.session()->get('student_lname')?></span></h1>
 <?php

 echo session()->get('student_id')?>



 




  <?php include "templates/footer.php";
?>



 
