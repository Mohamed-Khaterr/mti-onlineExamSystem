
  
  
  let upload = document.getElementById('upload');
  let close = document.getElementById('close');
  let modal = document.getElementById('modal');

  upload.addEventListener('click', ()=>{
    modal.classList.remove('d-none');
  });
  close.addEventListener('click', ()=>{
    modal.classList.add('d-none');
  });



 
  
  function myFunction() {
    var x = document.getElementById("UPDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }



 


  


  let inputfile = document.getElementById('file');
  let filePath = inputfile.value;
  let alert_pic = document.getElementById('alert_pic');
  let save = document.getElementById('save');
  
  


  


 


  