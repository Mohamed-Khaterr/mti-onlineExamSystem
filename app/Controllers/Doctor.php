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
	
	public function dashboard(){
		$data = [
			'doctorCourses' =>  $this->doctor->getCourses($_SESSION['dr_id']),
		];
		
		
		//doctorDashboardView
		echo view('doctor/t2/header', $data);
		echo view('doctor/dashboard/dashboardView');
		echo view('doctor/t2/footer');
	}
	
	//-------------------------------------------------------------------------------------------------------
	
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
		
		echo view('doctor/dr_profile/profileView', $data);
		echo view('doctor/t2/footer');
	}
	
	//-------------------------------------------------------------------------------------------------------
	
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
		}else{
			$data['error'] = $this->validation->getErrors();
		}
		
	
		
		echo view('doctor/t2/header', $data);
		echo view('doctor/createExam');
		echo view('doctor/t2/footer');
	}
	
	
	public function createQuestions(){
		$data =[
			'sideBar' => 'createQuestion',
			'courseTitle' => $this->doctor->getCourses($_SESSION['dr_id']),
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
		
		echo view('doctor/t2/header', $data);
		echo view('doctor/createQuestions');
		echo view('doctor/t2/footer');
	}
	
	public function exams(){
		$data =[
			'sideBar' => 'exams',
			'courses' => $this->doctor->getCourses($_SESSION['dr_id']),
			'examsCount' => count($this->exam->getExams($_SESSION['dr_id'])),
		];
		
		if(isset($_POST['showExams'])){
			$course_id = $this->request->getPost('selectedCourse');
			$data['exams'] = $this->doctor->getExamsOfDoctor($course_id, $_SESSION['dr_id']);
		}
		
		echo view('doctor/t2/header', $data);
		echo view('doctor/showExams');
		echo view('doctor/t2/footer');
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function showExamQuestions($exam_id){
		$data = [
			'exam' => $this->exam->getExam($exam_id),
			'questions' => $this->exam->getExamQuestions($exam_id),
		];
		
		
		echo view('doctor/t2/header', $data);
		echo view('doctor/showExamQuestions2');
		echo view('doctor/t2/footer');
	}
	
	
	/*
	public function examEdit(){
		$data['title'] = 'Edit Exam';
		$data['exam'] = $this->exam->getExamWithId($_SESSION['exam_id']);
		
		$validationRules = [
			'title' => 'required',
			'type' => 'required',
			'noOfQuestions' => 'required',
			'grade' => 'required',
			'duration' => 'required',
			'dateTime' => 'required'
		];
		
		if($this->request->getMethod(true) == 'POST'){
			if($this->validate($validationRules) && isset($_POST['save'])){
				$this->exam->updateExam($_SESSION['exam_id'], 
					$_POST['title'], 
					$_POST['type'], 
					$_POST['duration'], 
					$_POST['dateTime'], 
					$_POST['noOfQuestions'], 
					$_POST['grade']
				);
				return redirect()->to('Doctor/exam');
			}elseif(!empty($this->validation->getErrors())){
				$data['error'] = "Please fill all fields";
			}
			
			if(isset($_POST['yesDelete'])){
				$this->exam->deleteExam($_SESSION['exam_id']);
				return redirect()->to('Doctor/exam');
			}
			
		}
		
		echo view(HEADER_VIEW, $data);
		echo view(EDIT_EXAM);
		echo view(FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function question($id){
		$data['title'] = 'Question';
		$data['result'] = $this->exam->getQuestion($id);
		
		if(isset($_POST['editQuestion'])){
			$_SESSION['question_id'] = $_POST['editQuestion'];
			return redirect()->to('Doctor/question-edit');
		}else{
			
		}
		echo view(HEADER_VIEW, $data);
		echo view(SHOW_QUESTION);
		echo view(FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function editQuestion(){
		$data['title'] = 'Edit Question';
		$data['question'] = $this->exam->getQuestionWithId($_SESSION['question_id']);
		$data['choices'] = [];
		
		foreach($data['question'] as $row){
			if($row->question_type == 'Multiple Choices'){
				$data['choices'] = explode('#@', $row->question_choices);
				$validationRules = [
					'question' => 'required',
					'grade' => 'required',
					'answer' => 'required',
					'options' => 'required'
				];
			}else{
				$validationRules = [
					'question' => 'required',
					'grade' => 'required',
					'answer' => 'required'
				];
			}
		}
		
		if($this->request->getMethod(true) == 'POST'){
			
			if($this->validate($validationRules) && isset($_POST['save'])){
				if(!empty($_POST['options'])){
					$options = implode('#@ ', $_POST['options']);
					$this->exam->updateQuestion(
						$_SESSION['question_id'],
						$_POST['question'],
						$_POST['answer'],
						$_POST['grade'],
						$options
					);
					
				}else{
					
					$this->exam->updateQuestion(
						$_SESSION['question_id'],
						$_POST['question'],
						$_POST['answer'],
						$_POST['grade']
					);
					
				}
				return redirect()->to('Doctor/exam');
				
			}elseif(!empty($this->validation->getErrors())){
				$data['error'] = "Please fill all fields";
			}
			
			if(isset($_POST['yesDelete'])){
				$this->exam->deleteQuestion($_POST['yesDelete']);
				return redirect()->to('Doctor/exam');
			}
			
		}
		
		echo view(HEADER_VIEW, $data);
		echo view(EDIT_QUESTION);
		echo view(FOOTER_VIEW);
	}
	*/
	//-------------------------------------------------------------------------------------------------------
	
	
}