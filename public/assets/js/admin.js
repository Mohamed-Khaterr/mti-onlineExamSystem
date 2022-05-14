


/*
 WEB RTC METHODS 
 ---------------------------------------------------------------------------------------------------
*/


conn.onopen = function(e) {
    //conn.send("{'type': 'newconnection', 'content': '1'}");
    console.log("Connection established!");
};
/*
//var count,count2,count3,count4=5;
var count = 5;
conn.onmessage = function(e) {
	if(e.data ==="hi"){
	}else{
		
		let student = JSON.parse(e.data);
		console.log(student);
		
		student.forEach(function (student) {
			let id = student.id;
			let name = student.name;
			var html = "";
			
			const img = document.getElementById('receivedImage');
			img.src = "data:image/png;base64," + student.img;
			
			if(student.status === 'ok'){
				count = 5;
				//document.getElementById('s1').innerText ='not cheating';
				
				html = "
					<tr>
						<td>
							"+name+"
						</td>
						
						<td>
							<span class='status completed' id='+student.id+'>Not Cheating</span>
						</td>
							
						<td>
							<button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button>
						</td>
					</tr>
				";
				
			}else{
				count --;
				if(count <= 0 || isNaN(count)){
					//document.getElementById('s1').innerText = 'Cheating';
					
					html = "
						<tr>
							<td>
								"+name+"
							</td>
							
							<td>
								<span class='status pending'>Cheating</span>
							</td>
								
							<td>
								<button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button>
							</td>
						</tr>
					";
					
				}else{
					//document.getElementById('s1').innerText ='not cheating';
					
					html = "
						<tr>
							<td>
								"+name+"
							</td>
							
							<td>
								<span class='status completed'>Not Cheating</span>
							</td>
								
							<td>
								<button class='btn btn-info' style='background-color:#3C91E6;' onclick='showStudent()'> View </button>
							</td>
						</tr>
					";
				}
				
			}
			
			document.getElementById('studentList').innerHTML += html;
		}
	}
	*/
	/*
	let btn1 =document.getElementById("btn1");
	let btn2 =document.getElementById("btn2");
	let btn3 =document.getElementById("btn3");
	if(e.data ==="hi"){
	}else{
	  let json = JSON.parse(e.data);
	  let id=json.id;
	  console.log(id);
	  switch (id) {
		case 2:// that contain ip user info 
		document.getElementById('n1').innerText =json.User;
	
		if(json.status==='ok'){
			count=5;
			document.getElementById('s1').innerText ='not cheating';
		}else{
			count--;
			if(count<=0 || isNaN(count)){
				document.getElementById('s1').innerText = 'Cheating';
				
				
			}else{
				document.getElementById('s1').innerText ='not cheating';
			}
			
		}
	

		var img = document.getElementById('img1');
  
		img.src ="data:image/png;base64,"+json.img;
  
		break ;
		case 3:
		  document.getElementById('n2').innerText =json.User;
		  if(json.status==='ok'){
			count2=5;
			document.getElementById('s2').innerText ='not cheating';
		}else{
			count2=count2-1;
			
			if(count2<=0 || isNaN(count2)){
			document.getElementById('s2').innerText = 'Cheating';
			}else{
				document.getElementById('s2').innerText ='not cheating';
			}
		}
		  var img = document.getElementById('img2');
		  img.src ="data:image/png;base64,"+json.img;
		  break;

		  
		  case 4:
			document.getElementById('n3').innerText =json.User;
			if(json.status==='ok'){
				count3=5;
				document.getElementById('s3').innerText ='not cheating';
			}else{
				count3=count3-1;
				if(count2<=0 || isNaN(count3)){
					document.getElementById('s3').innerText = 'Cheating';
					}else{
						document.getElementById('s3').innerText ='not cheating';
					}
			}
			var img = document.getElementById('img3');
			img.src ="data:image/png;base64,"+json.img;
		  break;
	
	}
  }
	*/
	 
};



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