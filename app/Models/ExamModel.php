<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model{
	protected $db;
	protected $builder;
	
	
	public function __construct() {
		$this->db = \Config\Database::connect();
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function createExam($doctor_id,$course_id, $examTitle, $examType, $examDuration, $examDateTime, $noOfQuestions, $totalGrade){
		$this->builder = $this->db->table("exam");
		$data = [
			'doctor_id' => $doctor_id,
			'course_id' => $course_id,
			'exam_title' => $examTitle,
			'exam_type' => $examType,
			'exam_duration' => $examDuration,
			'exam_date_time' => $examDateTime,
			'no_of_questions' => $noOfQuestions,
			'total_grade' => $totalGrade,
		];
		
		$this->builder->insert($data);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function createQuestion($exam_id, $question_type, $question_description, $question_answer, $question_grade, $question_choices = null){
		//insert to question TABLE
		$this->builder = $this->db->table("question");
		if(empty($question_choices)){
			$questionData = [
				'exam_id' => $exam_id,
				'question_type' => $question_type,
				'question_description' => $question_description,
				'question_answer' => $question_answer,
				'question_grade' => $question_grade
			];
		}else{
			$questionData = [
				'exam_id' => $exam_id,
				'question_type' => $question_type,
				'question_description' => $question_description,
				'question_answer' => $question_answer,
				'question_grade' => $question_grade,
				'question_choices' => $question_choices
			];
		}
		
		
		$this->builder->insert($questionData);
		
		//get question_id
		$question_id = $this->db->insertID();
		
		//inset to exam_question TABLE
		$this->builder = $this->db->table("exam_questions");
		$examQuestionData = [
			'exam_id' => $exam_id,
			'question_id' => $question_id
		];
		$this->builder->insert($examQuestionData);
		
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getExam($doctor_id, $course_id = null){
		$this->builder = $this->db->table("exam");
		$this->builder->where('doctor_id', $doctor_id);
		if(!empty($course_id)){
			$this->builder->where('course_id', $course_id);
		}
		
		
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			return $result;
		}else{
			return null;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getExamWithId($exam_id){
		$this->builder = $this->db->table("exam");
		$this->builder->where('exam_id', $exam_id);
		
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			return $result;
		}else{
			return null;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateExam($exam_id, $exam_title, $exam_type, $exam_duration, $exam_date_time, $noOfQuestions, $totalGrade){
		$this->builder = $this->db->table("exam");
		$this->builder->where('exam_id', $exam_id);
		$data = [
			'exam_title' => $exam_title,
			'exam_type' => $exam_type,
			'exam_duration' => $exam_duration,
			'exam_date_time' => $exam_date_time,
			'no_of_questions' => $noOfQuestions,
			'total_grade' => $totalGrade
		];
		
		$this->builder->update($data);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function deleteExam($exam_id){
		$this->builder = $this->db->table("question");
		$this->builder->where('exam_id', $exam_id);
		$this->builder->delete();
		
		$this->builder = $this->db->table("exam_questions");
		$this->builder->where('exam_id', $exam_id);
		$this->builder->delete();
		
		$this->builder = $this->db->table("exam");
		$this->builder->where('exam_id', $exam_id);
		$this->builder->delete();
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getQuestion($examID){
		$this->builder = $this->db->table("question");
		$this->builder->where('exam_id', $examID);
		
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			return $result;
		}else{
			return null;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getQuestionWithId($question_id){
		$this->builder = $this->db->table("question");
		$this->builder->where('question_id', $question_id);
		
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			return $result;
		}else{
			return null;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateQuestion($question_id, $question_description, $question_answer, $question_grade, $quetion_choices = null){
		$this->builder = $this->db->table("question");
		$this->builder->where('question_id', $question_id);
		if(!empty($quetion_choices)){
			$data = [
				'question_description' => $question_description,
				'question_answer' => $question_answer,
				'question_grade' => $question_grade,
				'quetion_choices' => $quetion_choices
			];
		}else{
			$data = [
				'question_description' => $question_description,
				'question_answer' => $question_answer,
				'question_grade' => $question_grade
			];
		}
		
		$this->builder->update($data);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function deleteQuestion($question_id){
		$this->builder = $this->db->table("question");
		$this->builder->where('question_id', $question_id);
		$this->builder->delete();
		
		$this->builder = $this->db->table("exam_questions");
		$this->builder->where('question_id', $question_id);
		$this->builder->delete();
	}
	
	//-------------------------------------------------------------------------------------------------------
	//Wael Function --------------------------
	function GetStuExams($student_id){
        $this->builder = $this->db->table('exam');
        $this->builder->join('regist_course','exam.course_id = regist_course.course_id')
                      ->where('regist_course.student_id',$student_id)
					  ->orderby('exam_date_time','ASC');
        
        //execute the statment
        $query = $this->builder->get();
        
        if($result = $query->getResult()){
            return $result;
        }else{
            return null;
        }

    }

	function GetExamInfo($exam_id){
        $this->builder = $this->db->table('exam');
        $this->builder->where('exam.exam_id',$exam_id);
					  
        
        //execute the statment
        $query = $this->builder->get();
        
        if($result = $query->getRow()){
            return $result;
        }else{
            return null;
        }

    }

	function GetExamQuestions($exam_id){
		
	
        $this->builder = $this->db->table('question');
        $this->builder->join('exam','exam.exam_id = question.exam_id')
                      ->where('question.exam_id',$exam_id);
        
        //execute the statment
        $query = $this->builder->get();
        
        if($result = $query->getResult()){
            return $result;
        }else{
            return null;
        }

    }


	function pagination($exam_id){
		$this->builder = $this->db->table('question');
        
		$this->builder->where('exam_id',$exam_id);

		$query = $this->builder->get();								
		$result = $query->getResult();

      
		return $result ;
	}

	


	   
	    

	


	function exam_started($exam_id)
	{
		$current_datetime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));

		$exam_datetime = '';
        $this->builder = $this->db->table('exam');
		$this->builder->where("exam_id = '$exam_id' ");
        
		$query =$this->builder->get();
		$result = $query->getResult();
		foreach($result as $row)
		{
			$exam_datetime = $row->exam_date_time;
		}

		if($exam_datetime < $current_datetime)
		{
			return true;
		}
		return false;
	}


	public function attendance($exam_id,$student_id){
		$this->builder = $this->db->table('stu_enroll_exam');
		$this->builder->where('exam_id',$exam_id)
		            ->where('student_id',$student_id);
		$query =$this->builder->get();
		$result = $query->getResult();
		
		if(!$result){	
			$data=[
				'exam_id'=>$exam_id,
				'student_id'=>$student_id,
				'attendance' => '1'
			];
			$this->builder->insert($data);
			return true;
		}
		   
		return false;

		
	}

	public function insertanswers($question_id,$student_answer,$exam_id,$student_id){

		$this->builder = $this->db->table('answer');
		$this->builder->where("student_id",$student_id)
		              ->where("question_id",$question_id);
		$query =$this->builder->get();
		$result = $query->getResult();

	 
        if(!$result){

	    $data = [
		"student_id"=>$student_id,
		'question_id' => $question_id,
		"student_answer" => $student_answer
	    ];
	
	    $this->builder->insert($data);
        }else{

			$this->builder=$this->db->table('answer');
			$table = $this->builder->where("student_id",$student_id)
			                       ->where('question_id', $question_id);
			
				  $data = [
				    "student_answer"=> $student_answer,
				    ];
			
				$table->update($data);
			}


	}
	



	

			


}