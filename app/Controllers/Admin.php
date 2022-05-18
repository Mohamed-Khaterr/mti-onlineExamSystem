<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Admin extends BaseController{
	
	protected $admin;
	
	public function __construct(){
		$this->admin = model(AdminModel::class);
		$this->user = model(UsersModel::class);
    }
	/*
	echo '<pre style="text-align: center;">';
	print_r();
	echo '</pre>';
	*/
	public function index(){
		$session_id = $this->user->getSessionID();
		$data = [
			'studentCountAll' => $this->admin->getStudentsCountAll(),
			'coursesCountAll' => $this->admin->getCoursesCountAll(),
			'examCountAll' => $this->admin->getExamsCountAll(),
			'allCoursesNames' => $this->admin->getCoursesNames(),
			'upcomingExams' => $this->admin->getUpcomingExams(),
			'userObj' => $this->user->getUserBySession($session_id),
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
			'studentCountAll' => $this->admin->getStudentsCountAll(),
			'examCountAll' => $this->admin->getExamsCountAll(),
			'processExams' => $this->admin->getProcessExams()
		];
		
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view(ADMIN_CURRENT_EXAM);
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	
	
	public function liveExam($examID, $courseTitle, $examTitle){
		$id = session()->get('adminuserID');
		$this->user->updateAsession($id);
		$session_id = $this->user->getSessionID();
		$data = [
			'courseTitle' => $courseTitle,
			'examTitle' => $examTitle,
			'studentCountAll' => $this->admin->getStudentsCountAll(),
			'endTime' => $this->admin->getEndTime($examID),
			'userObj' => $this->user->getUserBySession($session_id),

		];
		
		
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view('admin/liveExamView');
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	public function updateLive(){
		// $data = $_POST['post'];
		// $data = jason_decode($data);
		// $img = $data->img; $id= $data->id; $name=$data->User;
		$model = new \App\Models\ReportModel(); 
		$newdata=[
			'userID'=> $this->request->getPost('userId'),
            'image' =>$this->request->getPost('image'),
            'userName' => $this->request->getPost('userName'),
			// 'examID'=> $this->request->getPost()

		];
		$model->save($newdata);

	} 

	public function report(){
        $model = new \App\Models\ExamModel();
		// $admin = new \App\Models\AdminModel();
		dd($model->exam_date());
		$data = [
			
		];
		// return view('admin/reportview');
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view('admin/reportview');
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	public function verifyExams(){
		$data = [
			'examVerification' => $this->admin->verifiedExams()
		];
		
		
		if(isset($_POST['accept'])){
			$this->admin->acceptExam($_POST['accept']);
			
			// To refresh page
			return redirect()->to('Admin/verify-exams');
		}elseif(isset($_POST['show'])){
			$_SESSION['showExamWithId'] = $_POST['show'];
			
			return redirect()->to('Admin/show-exam');
		}
		
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view(ADMIN_VERIFY_EXAM);
		echo view(ADMIN_FOOTER_VIEW);
	}
	
	public function showExam(){
		$exam_id = $_SESSION['showExamWithId'];
		
		$data = [
			'exam' => $this->admin->getExamAndQuestions($exam_id),
		];
		
		if(isset($_POST['accept'])){
			$this->admin->acceptExam($_POST['accept']);
			
			return redirect()->to('Admin/verify-exams');
		}
		
		echo view(ADMIN_HEADER_VIEW, $data);
		echo view('admin/verifyExam/showExam');
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
	
	
	public function createUser(){
		$data = [
			'error' => false,
			'errorMessage' => '',
			'successMessage' => '',
			'doctors' => $this->admin->getAllDoctors(),
			'courses' => $this->admin->getAllCourses(),
			'students' => $this->admin->getAllStudents(),
			'faculties' => $this->admin->getAllFaculties(),
		];
		if(isset($_POST['submitDoctor'])){
			$rules = [
				'faculty' => 'required',
				'fullName' => 'required',
				'gender' => 'required',
				'birthday' => 'required',
				'email' => 'required|valid_email',
				'password' => 'required',
				'confirmPassword' => 'required|matches[password]',
			];
			if($this->validate($rules)){
				$this->admin->createDoctorUser(
					$_POST['fullName'], 
					$_POST['email'], 
					$_POST['confirmPassword'], 
					$_POST['birthday'], 
					$_POST['gender'],
					$_POST['faculty']
				);
				
				$data['successMessage'] = 'Doctor added';
			}else{
				$data['error'] = true;
				$data['errorMessage'] = 'Error Creating Dr Please check your input';
			}
		}
		
		
		if(isset($_POST['submitStudent'])){
			$rules = [
				'faculty' => 'required',
				'firstName' => 'required',
				'lastName' => 'required',
				'level' => 'required',
				'gpa' => 'required',
				'gender' => 'required',
				'birthday' => 'required',
				'email' => 'required|valid_email',
				'password' => 'required',
				'confirmPassword' => 'required|matches[password]',
			];
			if($this->validate($rules)){
				$this->admin->createStudentUser(
					$_POST['firstName'], 
					$_POST['lastName'], 
					$_POST['level'], 
					$_POST['gpa'], 
					$_POST['email'], 
					$_POST['confirmPassword'], 
					$_POST['birthday'], 
					$_POST['gender'],
					$_POST['faculty']
				);
				$data['successMessage'] = 'Student added';
			}else{
				$data['error'] = true;
				$data['errorMessage'] = 'Error Creating Student Please check your input';
			}
		}
		
		
		if(isset($_POST['submitEnrollDoctor'])){
			$rules = [
				'registDoctorName' => 'required',
				'doctorCourseTitle' => 'required',
			];
			if($this->validate($rules)){
				$result = $this->admin->enrollDoctor($_POST['registDoctorName'], $_POST['doctorCourseTitle']);
				if($result){
					$data['successMessage'] = 'Doctor Enrolled Successfully';
				}else{
					$data['error'] = true;
					$data['errorMessage'] = 'Doctor already Enrolled to this course';
				}
			}else{
				$data['error'] = true;
				$data['errorMessage'] = 'Error Please check your input';
			}
		}
		
		
		if(isset($_POST['submitEnrollStudent'])){
			$rules = [
				'registStudentName' => 'required',
				'studentCourseTitle' => 'required',
			];
			if($this->validate($rules)){
				$result = $this->admin->enrollStudent($_POST['registStudentName'], $_POST['studentCourseTitle']);
				if($result){
					$data['successMessage'] = 'Student Enrolled Successfully';
				}else{
					$data['error'] = true;
					$data['errorMessage'] = 'Student already Enrolled to this course';
				}
			}else{
				$data['error'] = true;
				$data['errorMessage'] = 'Error Please check your input';
			}
		}
		
		
		echo view('admin/createUser', $data);
	}
	
}