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
			'courseTitle' => $this->doctor->getCourses($_SESSION['dr_id']),
			//'error' => [],
			'errorMessage' => '',
		];
		
		
		$validationRules = [
			'course_id' => 'required',
			'exam_type' => 'required',
			'total_grade' => 'required',
			'dateTime' => 'required',
			'duration' => 'required',
			'exam_title' => 'required',
		];
		
		if(isset($_POST['createExam'])){
			if($this->validate($validationRules)){
					$_SESSION['exam_insert_id'] = $this->exam->createExam(
					$_SESSION['dr_id'],	
					$this->request->getPost('course_id'), 
					$this->request->getPost('exam_title'), 
					$this->request->getPost('exam_type'), 
					$this->request->getPost('duration'), 
					$this->request->getPost('dateTime'), 
					$this->request->getPost('total_grade')
				);
				
				return redirect()->to('Doctor/create-question');
			}else{
				$data['error'] = $this->validation->getErrors();
				$data['errorMessage'] = "Please Check your inputs";
			}
		}
		
	
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(CREATE_EXAM);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Create Questions for Exam ----------------------------------------------------------------------------
	
	public function createQuestions(){
		$data =[
			'success' => '',
			'errorMessage' => '',
		];
		
		if(isset($_POST['savetf'])){
			$validationRules = [
				'question_type' => 'required',
				'tfAnswer' => 'required',
				'tfQuestion' => 'required',
				'tfGrade' => 'required',
			];
			if($this->validate($validationRules)){
				$this->exam->createQuestion(
					$_SESSION['exam_insert_id'], 
					$this->request->getPost('question_type'), 
					$this->request->getPost('tfQuestion'), 
					$this->request->getPost('tfAnswer'), 
					$this->request->getPost('tfGrade'), 
					$question_choices = null
				);
				$data['success'] = "Question Saved Successfuly :)";
			}else{
				$data['error'] = $this->validation->getErrors();
				$data['errorMessage'] = "Error in True or False Question, Please Check your inputs";
			}
		}
		
		
		if(isset($_POST['saveChoose'])){
			$validationRules = [
				'question_type' => 'required',
				'chooseQuestion' => 'required',
				'options' => 'required',
				'chooseAnswer' => 'required',
				'chooseGrade' => 'required',
			];
			
			if($this->validate($validationRules)){
					if(in_array($_POST['chooseAnswer'], $_POST['options'])){
					$this->exam->createQuestion(
						$_SESSION['exam_insert_id'], 
						$this->request->getPost('question_type'), 
						$this->request->getPost('chooseQuestion'), 
						$this->request->getPost('chooseAnswer'), 
						$this->request->getPost('chooseGrade'), 
						$this->request->getPost('options')
					);
					$data['success'] = "Question Saved Successfuly :)";
				}else{
					$data['errorMessage'] = "Answer must be one of the Choose answer";
				}
				
			}else{
				$data['error'] = $this->validation->getErrors();
				$data['errorMessage'] = "Error in MCQ Question, Please Check your inputs";
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
		
		if(isset($_POST['showExamsOfCourse'])){
			$course_id = $this->request->getPost('selectedCourse');
			$data['exams'] = $this->doctor->getExamsOfDoctor($course_id, $_SESSION['dr_id']);
			
			
		}elseif(isset($_POST['showExam'])){
			$_SESSION['showExamWithID'] = $_POST['showExam'];
			
			return redirect()->to('Doctor/show-questions');
			
			
		}elseif(isset($_POST['editExam'])){
			$_SESSION['editExamWithID'] = $_POST['editExam'];
			
			return redirect()->to('Doctor/edit-exam');
			
			
		}elseif(isset($_POST['deleteExam'])){
			$this->exam->deleteExam($_POST['deleteExam']);
		}
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(SHOW_EXAM);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Show Exam and Questions ------------------------------------------------------------------------------
	
	public function showExamQuestions(){
		$exam_id = $_SESSION['showExamWithID'];
		
		$data = [
			'exam' => $this->exam->getExam($exam_id),
			'questions' => $this->exam->getTheExamQuestions($exam_id),
		];
		
		if(isset($_POST['editQuestion'])){
			$_SESSION['editQuestionWithId'] = $_POST['editQuestion'];
			
			return redirect()->to('Doctor/edit-question');
			
		}elseif(isset($_POST['deleteQuestion'])){
			$this->exam->deleteQuestion($_POST['deleteQuestion']);
			
			return redirect()->to('Doctor/show-exam');
		}
		
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(SHOW_Questions);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Edit Exam Details ----------------------------------------------------------------------------------
	
	public function editExam(){
		$exam_id = $_SESSION['editExamWithID'];
		
		$data = [
			'exam' => $this->exam->getExam($exam_id),
			'courseTitle' => $this->doctor->getCourses($_SESSION['dr_id']),
		];
		
		
		
		if(isset($_POST['saveEdit'])){
			$validationRules = [
				'course_id' => 'required',
				'exam_type' => 'required',
				'total_grade' => 'required',
				'dateTime' => 'required',
				'duration' => 'required',
				'exam_title' => 'required',
			];
			
			if($this->validate($validationRules)){
				
				$this->exam->updateExamDetails(
					$exam_id,
					$_POST['exam_title'] ,
					$_POST['exam_type'] ,
					$_POST['course_id'] ,
					$_POST['duration'] ,
					$_POST['dateTime'] ,
					$_POST['total_grade'] 
				);
				
				unset($_SESSION["editExamWithID"]);
				
				return redirect()->to('Doctor/exams');
			}else{
				$data['error'] = $this->validation->getErrors();
			}
		}
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(EDIT_EXAM);
		echo view(DR_FOOTER_VIEW);
	}
	
	//-------------------------------------------------------------------------------------------------------
	// Edit Question ----------------------------------------------------------------------------------------
	
	public function editQuestion(){
		$question_id = $_SESSION['editQuestionWithId'];
		
		$data = [
			'question' => $this->exam->getQuestion($question_id),
		];
		
		if(isset($_POST['updatetfQuestion'])){
			$validationRules = [
				'tfAnswer' => 'required',
				'tfQuestion' => 'required',
				'tfGrade' => 'required',
			];
			
			if($this->validate($validationRules)){
				$this->exam->updateQuestion(
					$question_id, 
					$_POST['tfQuestion'], 
					$_POST['tfAnswer'], 
					$_POST['tfGrade']
				);
				
				return redirect()->to('Doctor/show-questions');
				
			}else{
				$data['error'] = $this->validation->getErrors();
			}
			
		}elseif(isset($_POST['updateChooseQuestion'])){
			$validationRules = [
				'chooseQuestion' => 'required',
				'options' => 'required',
				'chooseAnswer' => 'required',
				'chooseGrade' => 'required',
			];
			if($this->validate($validationRules)){
				
				$this->exam->updateQuestion(
					$question_id, 
					$_POST['chooseQuestion'], 
					$_POST['chooseAnswer'], 
					$_POST['chooseGrade'],
					$_POST['options']
				);
				
				return redirect()->to('Doctor/show-questions');
				
			}else{
				$data['error'] = $this->validation->getErrors();
			}
		}
		
		echo view(DR_HEADER_VIEW, $data);
		echo view(EDIT_QUESTION);
		echo view(DR_FOOTER_VIEW);
	}
	
}