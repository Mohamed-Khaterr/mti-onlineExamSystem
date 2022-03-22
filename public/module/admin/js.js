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

function True(){
  BoxFalse.classList.replace('d-none','d-flex');
  BoxTrue.classList.replace('d-flex','d-none');
}

function False(){
  BoxTrue.classList.replace('d-none','d-flex');
  BoxFalse.classList.replace('d-flex','d-none');
}



function MCQ_edit(){
  fixedB.classList.replace('d-none','d-flex');


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

function True_edit(){
  fixedBox.classList.replace('d-none','d-flex');
}
function False_edit(){
  fixedB.classList.replace('d-none','d-flex');
}