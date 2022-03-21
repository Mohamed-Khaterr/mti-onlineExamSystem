<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Admin extends BaseController{
	
	protected $admin;
	
	public function __construct(){
		$this->admin = model(AdminModel::class);
    }
	/*
	echo '<pre style="text-align: center;">';
	print_r();
	echo '</pre>';
	*/
	public function index(){
		
		$data = [
			'sideBar' => 'dashboard',
			'studentCountAll' => $this->admin->getStudentsCountAll(),
			'coursesCountAll' => $this->admin->getCoursesCountAll(),
			'examCountAll' => $this->admin->getExamsCountAll(),
			'allStudentsName' => $this->admin->getStudentsName(),
			'upcomingExams' => $this->admin->getUpcomingExams()
		];
		
		// Delete exam and question
		if(isset($_POST['deleteExam'])){
			$examID = $_POST['deleteExam'];
			$this->admin->deleteExam($examID);
			return redirect()->to('Admin'); 
		}
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view(ADMIN_DASHBOARD);
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	public function currentExam(){
		$data = [
			'sideBar' => 'currentExam',
			'studentCountAll' => $this->admin->getStudentsCountAll(),
			'examCountAll' => $this->admin->getExamsCountAll(),
			'processExams' => $this->admin->getProcessExams()
		];
		
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view(ADMIN_CURRENT_EXAM);
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	public function liveExam($examID, $courseTitle, $examTitle){
		$data = [
			'sideBar' => 'currentExam',
			'courseTitle' => $courseTitle,
			'examTitle' => $examTitle
		];
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view('admin/liveExamView');
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	
	
	
	public function verifyExams(){
		$data = [
			'sideBar' => 'verifyExams',
			'examVerification' => $this->admin->verifiedExams()
		];
		
		
		if(isset($_POST['accept'])){
			$this->admin->acceptExam($_POST['accept']);
			
			// To refresh page
			return redirect()->to('Admin/verify-exams');
		}
		
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view(ADMIN_VERIFY_EXAM);
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	
	
	
	public function profile(){
		
		$profileInfo = $this->admin->getProfileInfo($_SESSION[ADMIN_ID]);
		
		$data = [
			'sideBar' => 'profile',
			'firstName' => $profileInfo['firstName'],
			'lastName' => $profileInfo['lastName'],
			'email' => $profileInfo["email"],
			'isErrorInEditProfile' => false,
			'isErrorChangePassword' => false,
		];
		
		// Edit Profile
		if(isset($_POST['saveChanges'])){
			$rules = [
				'firstName' => 'required',
				'lastName' => 'required',
				'email' => 'required|valid_email',
			];
			if($this->validate($rules)){
				
				$this->admin->updateProfileInfo(
					$_SESSION[ADMIN_ID], 
					$_POST['firstName'], 
					$_POST['lastName'], 
					$_POST['email']
				);
				
				// To refresh page
				return redirect()->to('Admin/profile');
				
			}else{
				$data['isErrorInEditProfile'] = true;
				$data['firstNameError'] = $this->validation->getError('firstName') != null ? "First Name Can't be empty!":"";
				$data['lastNameError'] = $this->validation->getError('lastName') != null ? "Last Name Can't be empty!":"";
				$data['emailError'] = $this->validation->getError('email') != null ? "Email Can't be empty!":"";
			}
		}
		
		// Change Password
		if(isset($_POST['saveChangePassword'])){
			$rules = [
				'password' => 'required',
				'newpassword' => 'required',
				'renewpassword' => 'required|matches[newpassword]',
			];
			if($this->validate($rules)){
				
				$oldPasswordTrue = $this->admin->changePasswordOfAdmin(
					$_SESSION[ADMIN_ID], 
					$_POST['password'], 
					$_POST['newpassword'], 
					$_POST['renewpassword']
				);
				
				if(!$oldPasswordTrue){
					$data['isErrorChangePassword'] = true;
					$data['oldPasswordError'] = "The old Password is wrong!";
				}else{
					// To refresh page
					return redirect()->to('Admin/profile');
				}
				
			}else{
				$data['isErrorChangePassword'] = true;
				$data['passwordError'] = $this->validation->getError('password') != null ? "old Password is required":"";
				$data['newpasswordError'] = $this->validation->getError('newpassword') != null ? "New Password is required":"";
				$data['renewpasswordError'] = $this->validation->getError('renewpassword') != null ? "Not matching with new Password!":"";
			}
		}
		
		echo view(ADMIN_PROFILE, $data);
	}
	
}