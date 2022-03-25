<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Doctor extends BaseController{
	protected $doctor;
	protected $exam;
	
	public function __construct(){
        $this->doctor = model(DoctorModel::class);
		$this->exam = model(ExamModel::class);
		
    }
	
	//-------------------------------------------------------------------------------------------------------
	// Dashboar ---------------------------------------------------------------------------------------------
	
	public function dashboard(){
		$data = [
			'doctorCourses' =>  $this->doctor->getCourses($_SESSION['dr_id']),
		];
		
		
		//doctorDashboardView
		echo view(DR_HEADER_VIEW, $data);
		echo view(DR_DASHBOARD);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// DR Profile -------------------------------------------------------------------------------------------
	
	public function profile(){
		$data = [
			'profile' => $this->doctor->getProfile($_SESSION['dr_id']),
		];
		
		if(isset($_POST['saveProfile'])){
			$validationRules = [
				'email' => 'required|valid_email',
				'fullName' => 'required',
				'BD' => 'required',
			];
			
			if($this->validate($validationRules)){
				
				$this->doctor->updateProfile(
					$_SESSION['dr_id'], 
					$_POST['fullName'], 
					$_POST['email'], 
					$_POST['BD']
				);
				
				return redirect()->to('Doctor/profile');
				
			}else{
				$data['error'] = $this->validation->getErrors();
				$data['isErrorInEditProfile'] = 'Error';
			}
			
		}elseif(isset($_POST['savePasswordChange'])){
			$validationRules = [
				'password' => 'required',
				'newpassword' => 'required',
				'renewpassword' => 'required|matches[newpassword]',
			];
			
			if($this->validate($validationRules)){
				if($this->doctor->updateProfilePassword($_SESSION['dr_id'], $_POST['password'], $_POST['renewpassword'])){
					
					return redirect()->to('Doctor/profile');
					
				}else{
					$data['error']['password'] = "error";
					$data['isErrorChangePassword'] = 'Error';
				}
				
				
			}else{
				$data['error'] = $this->validation->getErrors();
				$data['isErrorChangePassword'] = 'Error';
			}
		}
		
		echo view(DR_PROFILE, $data);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Create Exam Details ----------------------------------------------------------------------------------
	
	public function createExam(){
		$data =[
			'sideBar' => 'createExam',
			'courseTitle' => $this->doctor->getCourses($_SESSION['dr_id']),
		];
		
		
		$validationRules = [
			'course_id' => 'required',
			'exam_type' => 'required',
			'total_grade' => 'required',
			'dateTime' => 'required',
			'duration' => 'required',
			'exam_title' => 'required',
		];
		
		if($this->request->getMethod(true) == 'POST' && $this->validate($validationRules)){
			
			$this->exam->createExam(
				$_SESSION['dr_id'],	
				$this->request->getPost('course_id'), 
				$this->request->getPost('exam_title'), 
				$this->request->getPost('exam_type'), 
				$this->request->getPost('duration'), 
				$this->request->getPost('dateTime'), 
				$this->request->getPost('total_grade')
			);
			
			$data['noErrors'] = "Exam Saved Successfuly :)";
		}else{
			$data['error'] = $this->validation->getErrors();
		}
		
	
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(CREATE_EXAM);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Create Questions for Exam ----------------------------------------------------------------------------
	
	public function createQuestions(){
		$data =[
			'exams' => $this->exam->getExams($_SESSION['dr_id']),
		];
		
		if(isset($_POST['savetf'])){
			$validationRules = [
				'exam_id' => 'required',
				'question_type' => 'required',
				'tfAnswer' => 'required',
				'tfQuestion' => 'required',
				'tfGrade' => 'required',
			];
			if($this->validate($validationRules)){
				
				$this->exam->createQuestion(
					$this->request->getPost('exam_id'), 
					$this->request->getPost('question_type'), 
					$this->request->getPost('tfQuestion'), 
					$this->request->getPost('tfAnswer'), 
					$this->request->getPost('tfGrade'), 
					$question_choices = null
				);
				$data['noErrors'] = "Question Saved Successfuly :)";
			}else{
				$data['error'] = $this->validation->getErrors();
			}
		}
		
		
		if(isset($_POST['saveChoose'])){
			$validationRules = [
				'exam_id' => 'required',
				'question_type' => 'required',
				'chooseQuestion' => 'required',
				'options' => 'required',
				'chooseAnswer' => 'required',
				'chooseGrade' => 'required',
			];
			if($this->validate($validationRules)){
				
				$this->exam->createQuestion(
					$this->request->getPost('exam_id'), 
					$this->request->getPost('question_type'), 
					$this->request->getPost('chooseQuestion'), 
					$this->request->getPost('chooseAnswer'), 
					$this->request->getPost('chooseGrade'), 
					$this->request->getPost('options')
				);
			}else{
				$data['error'] = $this->validation->getErrors();
			}
		}
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(CREATE_QUESTION);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Show Exams in Exams Page -----------------------------------------------------------------------------
	
	public function exams(){
		$data =[
			'courses' => $this->doctor->getCourses($_SESSION['dr_id']),
			'examsCount' => count($this->exam->getExams($_SESSION['dr_id'])),
		];
		
		if(isset($_POST['showExams'])){
			$course_id = $this->request->getPost('selectedCourse');
			$data['exams'] = $this->doctor->getExamsOfDoctor($course_id, $_SESSION['dr_id']);
		}
		
		if(isset($_POST['deleteExam'])){
			$this->exam->deleteExam($_POST['deleteExam']);
		}
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(SHOW_EXAM);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Show Questions of Exams ------------------------------------------------------------------------------
	
	public function showExamQuestions($exam_id){
		$data = [
			'exam' => $this->exam->getExam($exam_id),
			'questions' => $this->exam->getExamQuestions($exam_id),
		];
		
		if(isset($_POST['deleteQuestion'])){
			$this->exam->deleteQuestion($_POST['deleteQuestion']);
			return redirect()->to('Doctor/show-exam/'. $exam_id);
		}
		
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(SHOW_Questions);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Edit Exam Details ----------------------------------------------------------------------------------
	
	public function editExam($exam_id){
		$data = [
			'exam' => $this->exam->getExam($exam_id),
			'courseTitle' => $this->doctor->getCourses($_SESSION['dr_id']),
		];
		
		echo view(DR_HEADER_VIEW, $data);
		echo view('doctor/exam/editExam');
		echo view(DR_FOOTER_VIEW);
	}
	
}