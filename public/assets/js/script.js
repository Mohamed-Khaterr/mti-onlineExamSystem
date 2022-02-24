let upload = document.getElementById('upload');
  let close = document.getElementById('close');
  let save = document.getElementById('save');
  let modal = document.getElementById('modal');
  let inputfile = document.getElementById('file');
  let filePath = inputfile.value;
  let alert_pic = document.getElementById('alert_pic');
  let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;


upload.addEventListener('click', ()=>{
    modal.classList.remove('d-none');
  });
  
  close.addEventListener('click', ()=>{
    modal.classList.add('d-none');
  });
  save.addEventListener('click', ()=>{
    // if(!allowedExtensions.exec(filePath)){
    //     alert_pic.classList.remove('d-none');
    //     inputfile.value = '';
    //     return false;
    // }else{
        
    //   return true;
    //     }
    //  modal.classList.add('d-none');
  });