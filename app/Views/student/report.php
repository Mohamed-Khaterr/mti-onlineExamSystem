
<?php include "templates/header.php";
?>

<div class="   p-0  mt-5 container">

<table class="table table-striped dr_course_table ">
    <thead>
      <tr>
        <th scope="col">#</th>
        
        <th scope="col">Cousre Title</th>
        <th scope="col">Exam Date</th>
        <th scope="col">Duration</th>
        <th scope="col">Exam Score</th>
        <th scope="col">Student Score</th>
        <th scope="col"></th>

      </tr>
    </thead>
    <tbody>
    <?php  $i = 0; foreach($exams as $e): ?>
      <tr>

      
        <th scope="row"><?= ++$i; ?></th>
        
        <td><?= $e->exam_title; ?></td>
        <td><?= date("d-m-Y",strtotime($e->exam_date_time)); ?></td>
        <td><?= date("H:i",strtotime($e->exam_duration)); ?></td>
        <td><?= $e->total_grade; ?></td>
        <td><?= $e->student_grade; ?></td>
        <td><a href="student_see_answers.html">See Answers</a></td>

      </tr>
      <?php endforeach; ?>


    </tbody>
  </table>


</div>




<?php include "templates/footer.php";
?>