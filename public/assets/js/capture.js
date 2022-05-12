

(function() {
    // The width and height of the captured photo. We will set the
    // width to the value defined here, but the height will be
    // calculated based on the aspect ratio of the input stream.
  
    var width = 320;    // We will scale the photo width to this
    var height = 0;     // This will be computed based on the input stream
  
    // |streaming| indicates whether or not we're currently streaming
    // video from the camera. Obviously, we start at false.
  
    var streaming = false;
  
    // The various HTML elements we need to configure or control. These
    // will be set by the startup() function.
  
    var video = null;
    var canvas = null;
    var photo = null;
    var startbutton = null;
  
    function showViewLiveResultButton() {
      if (window.self !== window.top) {
        // Ensure that if our document is in a frame, we get the user
        // to first open it in its own tab or window. Otherwise, it
        // won't be able to request permission for camera access.
        document.querySelector(".contentarea").remove();
        const button = document.createElement("button");
        button.textContent = "View live result of the example code above";
        document.body.append(button);
        button.addEventListener('click', () => window.open(location.href));
        return true;
      }
      return false;
    }
  
  
    function startup() {
      if (showViewLiveResultButton()) { return; }
      video = document.getElementById('video');
      canvas = document.getElementById('canvas');
      photo = document.getElementById('photo');
      startbutton = document.getElementById('startbutton');
  
      navigator.mediaDevices.getUserMedia({video: true, audio: false})
      .then(function(stream) {
        video.srcObject = stream;
        video.play();
      })
      .catch(function(err) {
        console.log("An error occurred: " + err);
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
  
      startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
      }, false);
      
      clearphoto();
    }
  
    // Fill the photo with an indication that none has been
    // captured.
  
    function clearphoto() {
      var context = canvas.getContext('2d');
      context.fillStyle = "#AAA";
      context.fillRect(0, 0, canvas.width, canvas.height);
  
      var data = canvas.toDataURL('image/png');
      photo.setAttribute('src', data);
    }
    
    // Capture a photo by fetching the current contents of the video
    // and drawing it into a canvas, then converting that to a PNG
    // format data URL. By drawing it on an offscreen canvas and then
    // drawing that to the screen, we can change its size and/or apply
    // other changes before drawing it.
  
    
  
    // Set up our event listener to run the startup process
    // once loading is complete.
    window.addEventListener('load', startup, false);






 
conn.onopen = function(e) {
    //conn.send("{'type': 'newconnection', 'content': '1'}");
    console.log("Connection established!");
};

conn.onmessage = function(e) {
  console.log(e);
  let btn1 =document.getElementById("btn1");
  let btn2 =document.getElementById("btn2");
  
  if(e.data ==="hi"){
  
    sendImg();
  }else{
   
    let json = JSON.parse(e.data);
    let id=json.id;
    console.log(id);
    switch (id) {
      case 2:// that contain ip user info 
      document.getElementById('n1').innerText = json.id+' '+ json.User+' '+json.status+' '+json.faces;
      var img = document.getElementById('img1');

      img.src ="data:image/png;base64,"+json.img;

      break ;
      case 3:
        document.getElementById('n2').innerText = json.id+' '+ json.User+' '+json.status+' '+json.faces;
        var img = document.getElementById('img2');
        img.src ="data:image/png;base64,"+json.img;
        break;
        case 4:
        document.getElementById('n3').innerText = json.id+' '+ json.User+' '+json.status+' '+json.faces;
        var img = document.getElementById('img3');
        img.src ="data:image/png;base64,"+json.img;
        break;
  
  }
}
  
   
};


function sendImg(){

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


            conn.send(base64result);
            
           
            
         
          
          photo.setAttribute('src', data);
        } else {
          clearphoto();
        }



    // let img = canvas.toDataURL("image/png");
    // var base64result = img.split(',')[1];
    
    // conn.send("{'type': 'image', 'content': '" + base64result + "'}");
    
    }
  })();


  function togell(){
    
    var x = document.getElementById("img1");
    if (x.style.display === "none") {
      
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    
    
  }

  function togell2(){
    var x = document.getElementById("img2");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  
  function togell3(){
    var x = document.getElementById("img3");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }










  

