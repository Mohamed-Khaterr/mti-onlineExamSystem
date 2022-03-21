<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends BaseController{
	
	protected $user;
	
	protected $data = [
		'title' => 'Login',
		'emailError' => '',
		'passwordError' => '',
		'validationError' => ''
	];
	
	public function __construct(){
		//call Model
        $this->user = model(UserModel::class);
    }

    
	
    public function index(){
		
		$validationRules = [
			//name of filed => The rule
			'email' => 'required|valid_email',
			'password' => 'required'
		];
		
		if($this->request->getMethod(true) == 'POST' && $this->validate($validationRules)){
			//invalide Email and Password (correct/Success)
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			if(strpos($email, '@dr')){
				//Doctor Email
				
				if($this->doctorUser($email, $password)){
					$_SESSION['isLoggedIn'] = true;
					$_SESSION['isDoctor'] = true;
					
					//go to Doctor Controller
					return redirect()->to('Doctor/courses');
				}
				
			}elseif(strpos($email, '@admin')){
				//Admin Email
				
				if($this->adminUser($email, $password)){
					$_SESSION['isLoggedIn'] = true;
					$_SESSION['isAdmin'] = true;
					
					//go to Admin Controller
					return redirect()->to('Admin');
				}
				
			}elseif(strpos($email, '@cs')){
				//Student Email
				
				if($this->studentUser($email, $password)){
					$_SESSION['isStudent'] = true;
					
					//go to Student Controller
					return redirect()->to('student');
				}
				
			}else{
				$this->data['validationError'] = "Email not found!";
			}
			
		}elseif ($this->validation->hasError('password') || $this->validation->hasError('email')){
			//invalide Email or Password (incorrect/Fail)
			$this->data['emailError'] = $this->validation->getError('email');
			$this->data['passwordError'] = $this->validation->getError('password');
		}
		
		echo view(LOGIN_VIEW, $this->data);
		echo view(FOOTER_VIEW);
		
    }
	
	//-------------------------------------------------------------------------------------------------------
	
	protected function doctorUser($email, $password){
		//doctor Email
		
		//Check user in DB
		$result = $this->user->doctorVerification($email,$password);
		
		if($result['error'] === ''){
			//User Valide - No Errors At all: Now user can enter webpage
			
			foreach($result['verify'] as $row){
				$_SESSION['dr_id'] = $row->doctor_id;
			}
			
			//go to Doctor-Controller/function
			return true;
			
		}else{
			//User Not Valide
			$this->data['validationError'] = $result['error'];
			
			return false;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	protected function adminUser($email, $password){
		//Admin Email
		
		$result = $this->user->adminVerification($email, $password);
		
		if($result['error'] === ''){
			foreach($result['verify'] as $row){
				$_SESSION[ADMIN_ID] = $row->admin_id;
			}
			
			return true;
			
		}else{
			$this->data['validationError'] = $result['error'];
			return false;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	protected function studentUser($email, $password){
		$result = $this->user->studentVerification($email, $password);
		if($result['error'] === ''){
			$data = [];
			foreach($result['verify'] as $row){
				$data = [
					'student_id'=>$row->student_id ,
					'student_fname'=>$row->student_fname,
					'student_lname' =>$row->student_lname,
					'student_gender'=>$row->student_gender,
					'student_BD'=>$row->student_BD,
					'student_pic'=>$row->student_pic,
					'GPA'=>$row->GPA,
					'student_email'=>$row->student_email,
					'isLoggedIn'=>true,
				];
			}
			session()->set($data);
			
			return true;
			
		}else{
			$this->data['validationError'] = $result['error'];
			return false;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function logout(){
		session_destroy();
		
		return redirect()->to('/');
	}
	
}