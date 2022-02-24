<?php include "templates/header.php";
?>
  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">
  
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

        <?php if($courses):
        
        foreach($courses as $c): ?>
  
          <div class="col-lg-4 col-md-6  align-items-stretch"> 
            <div class="course-item mb-3">
              
             
              <img src="/assets/img/course-1.jpg" class="img-fluid" alt="...">
             

              <div class="course-content">
                <h3><a href=""><?= $c->course_title;?></a></h3>
                
              </div>
            </div>

          </div> <!-- End Course Item-->

          <?php endforeach;
          
        else:
          return Null;
          endif ?>
        </div>
        
      </div>
    </section><!-- End Courses Section -->








    




    
  
  </main>
  <!-- End main -->






  <?php include "templates/footer.php";
?>



 
