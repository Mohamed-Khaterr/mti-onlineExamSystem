<?php include "templates/header.php";
// include "system/init.php";
date_default_timezone_set("Africa/Cairo");
// $i = 0 ; foreach($noq as $n){
// $i++;
// }

function addTimeToDatetime($date, $duration){
    $hours = date('H', strtotime($duration));
    $minutes = date('i', strtotime($duration));
    $second = date('s', strtotime($duration));
    
    $newDate = date('M d Y H:i:s', strtotime($date . " +" . $hours . " hours". " + " . $minutes . " minutes" .  " + " . $second . " second"));
    
    return $newDate;
}

$duration = $exam->exam_duration;
$exam_star_time= $exam->exam_date_time;
$exam_end_time = addTimeToDatetime($exam_star_time,$duration);


?>

					

     <div class="breadcrumbs">
      <div class="container">
        <h2><?= $exam->exam_title .' Exam'." " ."  " ?></h2>
     </div>
    </div><!-- End Breadcrumbs -->


<form action="" method="post" id="myForm">
   <?= csrf_field() ?>
<div class="container  pt-3">
 
  <div id="cam-notify" class="w-100 m-auto  col-lg-12 bg-danger by-5 mb-4 text-center" style="border-radius:10px">
    <h3 style="color:white; font-weight:bold;" class="p-3">If You Try to Turn Off Your Camera The Exam Will Close</h3>
    
  </div>
 
 
     <div class="row">
       <div id="openCam" class="text-center col-lg-8 rounded c" style="height:auto; border: 2px solid #003771; background-color:white; ">
        <h1 class=" mt-5 mb-4" style="color:#003771; font-weight:bold">please open Your Camera</h1>
        <h5 class=" mt-3" style="color:#003771; font-weight:bold"> The Questions wont appear Until You <span style="text-decoration: underline;">Allow Camera Access</span> </h5>
        <img src="/img/remove_block.png" alt="" class="mt-3">
      </div>
    
         <div id='exam-q'   class="col-lg-8  c">
        <?php
         if($questions  !=  null){
         $i = 0; $ii=1; foreach($questions as $q):
         ?>
        <input type="hidden" id="Fid" name="" value="<?= $q->question_id; ?>">

             <!-- Questions Section  -->
            <div data-id="<?= $q->question_id; ?>" id="allestimento-img-wrapper<?=$ii++;?>" style="height: 290px;; border: 2px solid #003771;" class="allestimento-img-wrapper   d-none rounded mb-5  bg-light text-dark">
            <div class="container    my-4 ml-3 " id="q-area">
            <h3> Q<?= ++$i . " : " . $q->question_description; ?>  </h3>
            </div>

            
            <div class="container row justify-content-between ml-3 my-5">
                <?php  $s= explode('#@', $q->question_choices);
                       
            if(!empty($q->question_choices)){
                $ai=1;
                 foreach($s as $si){
                    
                ?>
                
                <div class='col-xl-6 col-lg-6  col-sm-6'>
                    <div class="">
                        <input type="radio" name="answer[<?= $q->question_id; ?>][<?= $i; ?>]"  class='my-3 ans-pointer' value="<?= $si; ?>"  id="<?= $q->question_id.$ai?>" >
                        <label class="ans-pointer" for="<?= $q->question_id.$ai?>"><?= $si ?></label>
                    </div>
                </div>
                  <?php  
                  $ai++;  
                }


            }else{
                echo "No Answers Now";
            }
            
                 ?>
            </div>
           
            </div>
            <?php 
    endforeach;
} ?>
<div  class="mb-5 d-flex justify-content-between">
<span id="prev" class="btn bg-blue rounded px-5 py-2"><span class='h4 '>Prev</span></span>
<span id="next"  class="btn bg-blue rounded px-5 py-2"><span class='h4 '>Next</span></span>
</div>

</div>



   
  <div class="col-lg-4">
            <div style="height:auto; border: 2px solid #003771;" class="  rounded    mb-5  bg-light text-dark">
         <div class=" ml-1 mt-3  ">
         
             <span class=" h4 ml-2 font-weight-bold" style="color:#003771;" >Remaining Time: </span>

            
                <span style="background-color: lightgray; color:#003771;" class="hours h3 font-weight-bold "></span><span  class="h3">:</span>
                <span style="background-color: lightgray; color:#003771;" class="minutes h3 font-weight-bold "></span><span  class="h3">:</span>
                <span style="background-color: lightgray; color:#003771;" class="seconds h3 font-weight-bold "></span>
            
            </div>
        <hr>
  

  
             <div class=" container pagi mb-3 d-flex flex-wrap justify-content-start">

             <?php
             $pn=1;
             foreach($noq as $n){
        ?>
       


        <span id="finiture-wrapper<?= $pn?>" style="<?=($pn >= 10 ? "padding: 1px 3px;" :null )?> color:#003771; "  class="finiture-wrapper <?=($pn==1 ? "act" :null )?>" data-id="<?= $n->question_id; ?>"><?= $pn ?></span>
        <input type="hidden" id="CnO<?= $pn?>" class="CnO" data-id="<?= $n->question_id; ?>" name="" value="<?= $pn ?>">
        
                <?php
             $pn++;
            }
             ?>




<input type="hidden" id="SpN" name="" value="<?= $pn-1;?>">
<input type="hidden" id="Lid" name="" value="<?= $n->question_id; ?>">


</div>

</div>
</div>


<div class="modal d-none" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Answers</h5>
        <span type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body">
        <p>Are You Sure You wanna Leave Exam? </p>
      </div>
      <div class="modal-footer">
        <span  id="close" class="btn btn-secondary" data-dismiss="modal">Cancel</span>
       <input class="btn bg-blue " type="submit" id="SubAnswers" name="SubAnswers" value="Submit">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
           


       <!-- Submit the form -->
    <div class="container row justify-content-center mt-5 py-5">

    <span class="col-2 btn bg-blue py-3 px-2" id="SUBMI"> Submit All Answers </span>
    
    </div>

    </div>
    

    </div> 


    </form>




    <div class="contentarea d-none">
  <h1>
    WebRTC: photo capture 
  </h1>
  
  <div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton"></button> 
  </div>
  <canvas id="canvas">
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box."> 
  </div>


  <div
    className='container'>
    <?php
    if($userObj->userID == 1){
      echo 'Id  Name  Status  Face';
    }
    
    ?>
      <p className='element' id='n1'> </p>
      <p className='element' id='n2'> </p>
      <p className='element' id='n3'></p>

      <button onclick="togell()" id='btn1'>Monitor</button>
      <img id = 'img1' >

      
      <button onclick="togell2()" id='btn2'>Monitor</button> 
      <img id = 'img2' >
      
      
      
      <button onclick="togell3()" id='btn3'>Monitor</button>
      <img id = 'img3' >
    
</div>



  <button onclick="sendImg()">
  
  <?php


echo $userObj->userID;


?>
  </button>
</div>


<?php include 'templates/footer.php';?>

<script>
 // The End Of The Year Date To Countdown To
    // 1000 milliseconds = 1 Second
    // Dec 31, 2022 23:59:59
    let countDownDate = new Date( "<?= $exam_end_time?>").getTime();
    // console.log(countDownDate);
    
    let counter = setInterval(() => {
      // Get Date Now
      let dateNow = new Date().getTime();
    
      // Find The Date Difference Between Now And Countdown Date
      let dateDiff = countDownDate - dateNow;
    
      // Get Time Units
      // let days = Math.floor(dateDiff / 1000 / 60 / 60 / 24);
    //   let days = Math.floor(dateDiff / (1000 * 60 * 60 * 24));
      let hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      let minutes = Math.floor((dateDiff % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((dateDiff % (1000 * 60)) / 1000);
    
    //   document.querySelector(".days").innerHTML = days < 10 ? `0${days}` : days;
      document.querySelector(".hours").innerHTML = hours < 10 ? `0${hours}` : hours;
      document.querySelector(".minutes").innerHTML = minutes < 10 ? `0${minutes}` : minutes;
      document.querySelector(".seconds").innerHTML = seconds < 10 ? `0${seconds}` : seconds;

   if(minutes <=  1 && hours ==0){
    document.querySelector(".hours").classList.add("bg-danger","text-white");
    document.querySelector(".minutes").classList.add("bg-danger","text-white");
    document.querySelector(".seconds").classList.add("bg-danger","text-white");
   }

    
      if (dateDiff <= 0) {
          clearInterval(counter);

          document.getElementById("SubAnswers").click();
        
      }
    }, 1000);

    $(document).ready(function() {
        
        $('.act').click();
    })
    
    
    
    
    
    
    $("#SUBMI").click(function(){
        $(".modal").removeClass("d-none");
    });
    $(".close").on('click',function(){
        $(".modal").addClass("d-none");
        
    })
    
    $("#close").on('click',function(){
        $(".modal").addClass("d-none");
        
    })
    
    var tracker = 1;
    var maxdivs = $('#SpN').val();
    // $("#prev").addClass("disabled")
    
    
    
    $('.finiture-wrapper').on('click', function() {
        var idBtn = $(this).data('id');
        tracker = $('.CnO[data-id*=' +  idBtn + ']').val()       
        $('.allestimento-img-wrapper').addClass('d-none')
        $('.allestimento-img-wrapper[data-id*=' +  idBtn + ']').removeClass('d-none')
        $('.finiture-wrapper').removeClass('active')
        $('.finiture-wrapper[data-id*=' +  idBtn + ']').addClass('active');    
        $("#next").removeClass("disabled")
        $("#prev").removeClass("disabled")
        if(idBtn == $("#Fid").val()){
            $("#prev").addClass("disabled")
            $("#next").removeClass("disabled")
            tracker=1
        }
        if(idBtn == $("#Lid").val()){
            $("#prev").removeClass("disabled")
            $("#next").addClass("disabled")
            tracker=maxdivs
        }
       
    });

    $("#next").click(function(){
      $("#prev").removeClass("disabled")
      $("#allestimento-img-wrapper" + tracker).addClass('d-none');
      $("#finiture-wrapper" + tracker).removeClass('active');
      tracker ++;
      if(tracker >= maxdivs){
        $("#next").addClass("disabled")
      }
      $("#allestimento-img-wrapper" + tracker).removeClass("d-none");
      $("#finiture-wrapper" + tracker).click();
    });
    
    $("#prev").click(function(){
      tracker = tracker - 1;
        $("#next").removeClass("disabled")
        $("#allestimento-img-wrapper" + tracker).addClass('d-none');
        $("#finiture-wrapper" + tracker).removeClass('active');

        if(tracker <= 1){
        $("#prev").addClass("disabled")
        }
        $("#allestimento-img-wrapper" + tracker).removeClass("d-none");
        $("#finiture-wrapper" + tracker).click();
    });

</script>




<script>
              const conn = new WebSocket('ws://localhost:8080/?token=<?php
              echo $userObj->sessionID;
              ?>');
          </script>
		  
<script>
	// if user leave Page or navigate to another tab
	document.addEventListener("visibilitychange", (event) => {
	  if (document.visibilityState == "visible") {
		console.log("tab is active")
	  } else {
		console.log("tab is inactive")
    document.getElementById("SubAnswers").click();
	  }
	});
	
	window.addEventListener('focus', (event) => {
		// focus
	});

	// window.addEventListener('blur', (event) => {
	// 	// blur
  //   document.getElementById("SubAnswers").click();
	// });
</script>

<script>
  //Camera Permission 
  
    navigator.permissions.query({name:'camera'}).then(function(permissionStatus) {
	  // console.log('geolocation permission state is ', permissionStatus.state);
    if(permissionStatus.state == "granted"){
        // console.log("open")
        document.getElementById("exam-q").style.display = 'block';
        document.getElementById("openCam").style.display = 'none';

    }else{
      console.log("close");
      // document.getElementsByClassName("exam-q").classList.add('d-none');
      document.getElementById("exam-q").style.display = 'none';
      document.getElementById("openCam").style.display = 'block';
      document.getElementById("cam-notify").style.display = 'none';
      
      // location.reload();

    }
    
	  permissionStatus.onchange = function() {
		console.log('geolocation permission state has changed to ', this.state);
    if(this.state == "granted"){
      // console.log("open")
      location.reload();
      // document.getElementById("exam-q").style.display = 'block';
      // document.getElementById("openCam").style.display = 'none';
      
    }else{
      console.log("close");
      // document.getElementsByClassName("exam-q").classList.add('d-none');
      document.getElementById("exam-q").style.display = 'none';
      document.getElementById("openCam").style.display = 'block';
      document.getElementById("SubAnswers").click();
    }

	  }});
  
 
</script>
<script type="text/javascript" src="/assets/js/capture.js"></script>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
  