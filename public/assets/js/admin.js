


/*
 WEB RTC METHODS 
 ---------------------------------------------------------------------------------------------------
*/


conn.onopen = function(e) {
    //conn.send("{'type': 'newconnection', 'content': '1'}");
    console.log("Connection established!");
};








var c=5;
var arr={

	1:{count:0},
	2:{count:0},
	3:{count:0},
	4:{count:0},
	5:{count:0},
	
	
};
var array = []
var status=[0 ,0 ,0 ,0];
  conn.onmessage = function(e) {
	if(e.data ==="hi"){
	}else{
		
		let student = JSON.parse(e.data);
		

		
		
			let name = student.User;
			
			
			var html = "";
			if(!array.includes(student.id)){
				array.push(student.id);

				const img = document.getElementById('receivedImage');
			img.src = "data:image/png;base64," + student.img;

			
			if(arr[student.id].hasOwnProperty('count')){
			if(student.status === 'ok'){
				arr[student.id]={count:5};
				 c=5
				//document.getElementById('s1').innerText ='not cheating';
				
				html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+" >Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td></tr>";
				
			}else{
				
				var counter = arr[student.id].count
				counter--;
				arr[student.id]={count:counter};
				// count --;
				if(arr[student.id].count <= 0 || isNaN(arr[student.id].count)){
					//document.getElementById('s1').innerText = 'Cheating';


					html = "<tr><td>"+name+"</td><td><span class='status pending' id="+student.id+">Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td></tr>";
			
					
				}else{
					//document.getElementById('s1').innerText ='not cheating';
					
					html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+">Not Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td></tr>";
				}
				
			}
		}else{
			html = "<tr><td>"+name+"</td><td><span class='status completed' id="+student.id+">Cheating</span></td><td><button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button></td></tr>";
		}
			
			document.getElementById('studentList').innerHTML += html;



				
			}else{

				
				console.log(arr[student.id]);
				if(arr[student.id].hasOwnProperty('count')){
				if(student.status === 'ok'){
					arr[student.id]={count:5};
				
					c=5
					document.getElementById(student.id).innerHTML="Not Cheating";
				}

				else{

					var counter = arr[student.id].count
					counter--;
					arr[student.id]={count:counter};
					if(arr[student.id].count <= 0 || isNaN(arr[student.id].count)){
						
						document.getElementById(student.id).innerHTML="Cheating";
				
						
					}else{
						document.getElementById(student.id).innerHTML="Not Cheating";
					}
					
				}
			
			}else{
				document.getElementById(student.id).innerHTML="Cheating";

			}


				
			}
			

	}
}

function showStudent(){
	showPopupModel();
}


function showPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}

function stopPopupModel(){
	document.getElementById("popup-1").classList.toggle("active");
}




















/*
 Other JS Functionalities
 ---------------------------------------------------------------------------------------------------
*/





const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})





// -----------------------------------------------------------------------------------------------------------



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