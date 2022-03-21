var fixedBox =document.getElementById('fixedBox');
var smallBox =document.getElementById('smallBox');
var closeBtn =document.getElementById('closeBtn');




function display(){
  fixedBox.classList.replace('d-none','d-flex');
  

}



closeBtn.addEventListener('click' ,function(){

    fixedBox.classList.replace('d-flex','d-none');

})








function TrueFalse(){
  BoxTrueFalse.classList.replace('d-none','d-flex');
  BoxMCQ.classList.replace('d-flex','d-none');


}


function MCQ(){
  BoxMCQ.classList.replace('d-none','d-flex');
  BoxTrueFalse.classList.replace('d-flex','d-none');


}




function MCQ_edit(){
  fixedBox.classList.replace('d-none','d-flex');


}



var fixedB =document.getElementById('fixedB');
var smallB =document.getElementById('smallB');
var closeB =document.getElementById('closeB');


function true_false_edit(){
  fixedB.classList.replace('d-none','d-flex');


}

closeB.addEventListener('click' ,function(){

  fixedB.classList.replace('d-flex','d-none');

})