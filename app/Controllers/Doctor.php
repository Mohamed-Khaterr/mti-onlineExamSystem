<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Doctor extends BaseController{
	protected $doctor;
	protected $exam;
	
	public function __construct(){
        $this->doctor = model(DoctorModel::class);
		$this->exam = model(ExamModel::class);
		
		if(!isset($_SESSION['isDoctor']) && session()->get('isDoctor')){
			return redirect()->to('Login');
          
        }
    }
	
	//-------------------------------------------------------------------------------------------------------
	
	public function courses(){
		$data['title'] = 'Courses';
		
		$data['result']= $this->doctor->getCourses($_SESSION['dr_id']);
		//$data['result'] = $this->doctor->test($_SESSION['dr_id']);
		
		echo view(HEADER_VIEW, $data);
		echo view(DR_COURSES, $data);
		echo view(FOOTER_VIEW);
		
		//$this->doctor->test($_SESSION['dr_id']);
		
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function profile(){
		$data['title'] = 'Profile';
		
		$data['result']= $this->doctor->getProfile($_SESSION['dr_id']);
		
		echo view(HEADER_VIEW, $data);
		echo view(DR_PROFILE);
		echo view(FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function editProfile(){
		$data['result']= $this->doctor->getProfile($_SESSION['dr_id']);
		$data['title'] = 'Edit Profile';
		$data['fullNameError'] = '';
		$data['usernameError'] = '';
		$data['passwordError'] = '';
		$data['confirmPasswordError'] = '';
		$data['emailError'] = '';
		
		
		$validationRules = [
			//name of filed => The rule
			'email' => 'required|valid_email',
			'confirmPassword' => 'matches[password]',
			'fullName' => 'required',
			'username' => 'required',
			'gender' => 'required',
			'birthday' => 'required'
		];
		
		
		if($this->request->getMethod(true) == 'POST' && $this->validate($validationRules)){
			
			$fullName = $this->request->getPost('fullName');
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$email = $this->request->getPost('email');
			$gender = $this->request->getPost('gender');
			$birthday = $this->request->getPost('birthday');
		
			$this->doctor->updateInfo($_SESSION['dr_id'], $fullName, $username, $password, $email, $gender, $birthday);
			
			return redirect()->to('Doctor/profile');
			
			
		}else{
			$data['emailError'] = $this->validation->getError('email');
			$data['passwordError'] = $this->validation->getError('password');
			$data['confirmPasswordError'] = $this->validation->getError('confirmPassword');
			$data['fullNameError'] = $this->validation->getError('fullName');
			$data['usernameError'] = $this->validation->getError('username');
		}
		
		echo view(HEADER_VIEW, $data);
		echo view(DR_PROFILE_EDIT);
		echo view(FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function createExam(){
		$data['courses']= $this->doctor->getCourses($_SESSION['dr_id']);
		$data['exams'] = $this->exam->getExam($_SESSION['dr_id']);
		$data['title'] = "Create Exam";
		$data['error'] = '';
			
			
		//Exam Detail
		if(isset($_POST['examDetailSave'])){
			$validationRules = [
				'courseID' => 'required',
				'examTitle' => 'required',
				'examType' => 'required',
				'examDate' => 'required',
				'examDuration' => 'required',
				'noOfQuestions' => 'required',
				'examGrade' => 'required'
			];
			if($this->validate($validationRules)){
				$doctor_id = $_SESSION['dr_id'];
				$course_id = $this->request->getPost('courseID');
				$examTitle = $this->request->getPost('examTitle');
				$examType = $this->request->getPost('examType');
				$examDuration = $this->request->getPost('examDuration');
				$examDateTime = $this->request->getPost('examDate');
				$noOfQuestions = $this->request->getPost('noOfQuestions');
				$totalGrade = $this->request->getPost('examGrade');
				
				
				
				$this->exam->createExam($doctor_id,$course_id, $examTitle, $examType, $examDuration, $examDateTime, $noOfQuestions, $totalGrade);
				$data['exams'] = $this->exam->getExam($_SESSION['dr_id']);
				
				$data['error'] = 'Exam Detail Saved Succesfully';
				
				
			}else{
				$data['error'] = "Error may be There is Empty filed in Exam Detail";
			}
		//Question Choose
		}elseif(isset($_POST['saveChoose'])){
			$validationRules = [
				'examID' => 'required',
				'question' => 'required',
				'answer' => 'required',
				'grade' => 'required',
				'options' => 'required'
			];
			
			if($this->validate($validationRules)){
				$examID = $this->request->getPost('examID');
				$question = $this->request->getPost('question');
				$answer = $this->request->getPost('answer');
				$grade = $this->request->getPost('grade');
				$question_choices = implode('#@ ', $this->request->getPost('options'));
				
				$this->exam->createQuestion(
					$examID, 
					"Multiple Choices", 
					$question, 
					$answer, 
					$grade, 
					$question_choices
				);
				
				$data['error'] = 'Choose Question Saved Succesfully';
				
			}else{
				$data['error'] = "Error may be There is Empty filed in Choose Question";
				
			}
			
		//Question True or False
		}elseif(isset($_POST['saveTF'])){
			$validationRules = [
				'examID' => 'required',
				'question' => 'required',
				'answer' => 'required',
				'grade' => 'required'
			];
			if($this->validate($validationRules)){
				$examID = $this->request->getPost('examID');
				$question = $this->request->getPost('question');
				$answer = $this->request->getPost('answer');
				$grade = $this->request->getPost('grade');
				
				$this->exam->createQuestion($examID, "True or False", $question, $answer, $grade);
				
				$data['error'] = 'True/False Question Saved Succesfully';
				
			}else{
				$data['error'] = "Error may be There is Empty filed in True or False Question";
			}
		}
		
		echo view(HEADER_VIEW, $data);
		echo view(CREATE_EXAM);
		echo view(FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function exam(){
		$data['title'] = 'Exam';
		$data['courses']= $this->doctor->getCourses($_SESSION['dr_id']);
		
		if($this->request->getMethod(true) == 'POST' && $this->validate(['courseChoosen' => 'required'])){
			$courseId = $this->request->getPost('courseChoosen');
			$data['result']= $this->exam->getExam($_SESSION['dr_id'], $courseId);
			$data['course_title'] = $this->doctor->getCourseTitleWithId($courseId);
		}
		
		if(isset($_POST['showExam'])){
			if($this->exam->getQuestion($this->request->getPost('showExam')) !== null){
				return redirect()->to('Doctor/exam/'.$this->request->getPost('showExam'));
			}
			
		}
		if(isset($_POST['editExam'])){
			$_SESSION['exam_id'] = $_POST['editExam'];
			return redirect()->to('Doctor/exam-edit');
		}
		
		
		echo view(HEADER_VIEW, $data);
		echo view(SHOW_EXAM);
		echo view(FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
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
	
	//-------------------------------------------------------------------------------------------------------
	
	
}