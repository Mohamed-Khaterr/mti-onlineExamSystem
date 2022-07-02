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
  </div>
  <canvas id="canvas">
  </canvas>
<img id="photo" alt="The screen capture will appear in this box."> 

  
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
	// if user leave Page or navigate to another tab *******************************************
	document.addEventListener("visibilitychange", (event) => {
		if (document.visibilityState == "visible") {
			console.log("tab is active")
		} else {
			console.log("tab is inactive")
			// document.getElementById("SubAnswers").click();
		}
	});
	/*
	window.addEventListener('focus', (event) => {
		// focus
	});

	window.addEventListener('blur', (event) => {
		// blur
		document.getElementById("SubAnswers").click();
	});
	*/
</script>

<script>
	// Camera Permission *******************************************
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

		}
	});
	  
	
	//Prevent Right Click
	document.oncontextmenu = new Function("return false");
	
</script>

<script>
/*
	WebSocket ******************************************
*/
const conn = new WebSocket('ws://localhost:8080/?user_id=<?= session()->get("student_id")?>&user=student&examID=<?= $examID ?>');

conn.onopen = function(e) {
    console.log("Connection Established!");
};

conn.onmessage = function(e) {
	if(isJSON(e.data)){
		if(JSON.parse(e.data).hasOwnProperty('answer')){
			// Set Answer As Remote Description
			peer.setRemoteDescription(JSON.parse(e.data).answer);
			
		}else if(JSON.parse(e.data).hasOwnProperty('candidate')){
			// Add Admin ICE Candidate
			peer.addIceCandidate(JSON.parse(e.data).candidate);
			
		}else if(JSON.parse(e.data).hasOwnProperty('disconnectWebRTC')){
			// Close the Connection between Admin and student
			console.log('Closeing WebRTC!');
			peer.close();
			peer = null;
			
		}else{
			// Start Connection With Admin
			let fromAdmin = JSON.parse(e.data);
			connectStream(fromAdmin.adminID);
		}
		
	}else{
		if(e.data == "giveMeData"){
			// Sending Student Data to webSocket (user='student', id, name, examID, img)
			console.log("Student is Sending!");
			sendData();
		}
	}
};

conn.onclose = function(e){
	console.log("Connection is Closed!");
};

conn.onerror = function(error) {
  console.error('WebSocket Error: ' + error);
};

/*
	END WebSocket ******************************************
*/
</script>
  
  
<script>
/*
	Capture Student and Sending Data ******************************************
*/
var photo = document.getElementById('photo');
var canvas = document.getElementById('canvas');     
var video = document.getElementById('video');

var width = 320;
var height = 0;
var streaming = false;


navigator.mediaDevices.getUserMedia({ video: true, audio: false })
.then(function (stream) {
	video.srcObject = stream;
	video.play();
})
.catch(function (error) {
	console.log("Camera Error!: " + error);
	document.getElementById("exam-q").style.display = 'none';
	document.getElementById("openCam").style.display = 'block';
});

video.addEventListener('canplay', function(ev){
	if (!streaming) {
	  height = video.videoHeight / (video.videoWidth/width);
	
	  // Firefox currently has a bug where the height can't be read from
	  // the video, so we will make assumptions if this happens.
	
	  if (isNaN(height)) {
		height = width / (4/3);
	  }
	
	  video.setAttribute('width', width);
	  video.setAttribute('height', height);
	  canvas.setAttribute('width', width);
	  canvas.setAttribute('height', height);
	  streaming = true;
	}
}, false);


function sendData(){
	var context = canvas.getContext('2d');
	if (width && height) {
		canvas.width = width;
		canvas.height = height;
		context.drawImage(video, 0, 0, width, height);

		var data = canvas.toDataURL('image/png');

		var image = new Image();
		image.src = data;
		document.body.appendChild(image);
		image.className = 'd-none';
		var base64result = image.src.split(',')[1];
		
		
		
		// Sending data to admin and python
		var studentData = {
			user: 'student',
			id: '<?= session()->get("student_id")?>',
			name: '<?= session()->get("student_fname")?>'+' '+'<?= session()->get("student_lname")?>',
			examID: '<?= $examID ?>',
			img: base64result,
		}
		conn.send(JSON.stringify(studentData));




		photo.setAttribute('src', data);
		
	} else {
		clearphoto();
	}
}

function clearphoto() {
	var context = canvas.getContext('2d');
	context.fillStyle = "#AAA";
	context.fillRect(0, 0, canvas.width, canvas.height);

	var data = canvas.toDataURL('image/png');
	photo.setAttribute('src', data);
}

/*
	END Capture Student and Sending Data ******************************************
*/
</script>


<script>
// To check if data is in JSON or not
function isJSON(data){
	try {
		var testIfJson = JSON.parse(data);
		if (typeof testIfJson == "object"){
			//Json
			return true
		} else {
			//Not Json
			return false
		}
	}
	catch {
		return false;
	}
}
</script>

<script>
/*
	WebRTC ******************************************
*/
let pcConfig = {
	iceServers: [
		{
			'urls': 'stun:stun.l.google.com:19302'
		},
		{
			'urls': 'turn:192.158.29.39:3478?transport=udp',
			'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
			'username': '28224511:1379330808'
		},
		{
			'urls': 'turn:192.158.29.39:3478?transport=tcp',
			'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
			'username': '28224511:1379330808'
		}
	]
};

var peer = new RTCPeerConnection(pcConfig);

function connectStream(adminID){
	console.log('Starting WebRTC!');
	peer = new RTCPeerConnection(pcConfig);
	navigator.mediaDevices.getUserMedia({ video: true, audio: false })
	.then(function(stream){
		
		
		// addTracker to WebRTC
		for (const track of stream.getTracks()) {
			peer.addTrack(track, stream);
		}
		
		peer.onicecandidate = function(e){
			if (e.candidate == null)
				return
			
			conn.send(JSON.stringify({user: 'student', candidate: e.candidate, adminID: adminID}));
		}
		
		
		createAndSendOffer(adminID);
		
	}).catch(function (e){
		console.log('Camera Erro2: ' + e);
	})
}

function createAndSendOffer(adminID){
	peer.createOffer().then(function(offer) {
		conn.send(JSON.stringify({user: 'student', offer: offer, studentId: '<?= session()->get("student_id")?>', adminID: adminID}));
		
		return peer.setLocalDescription(offer);
	})
	.catch(function(reason) {
		// An error occurred, so handle the failure to connect
		console.log('Create Offer Error!: ' + reason);
	});
}
</script>