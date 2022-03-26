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
	
	public function getExams($doctor_id){
		$this->builder = $this->db->table("exam");
		
		$this->builder->select('exam_id, 
								exam_title, 
								exam_type, 
								exam_duration,
								exam_date_time,
								total_grade,
								admin_verified,
								course_title,
								')
					->where('doctor_id',$doctor_id)
					->join('course', 'course.course_id = exam.course_id');
					
		$result = $this->builder->get()->getResult();
		
		$data = array();
		
		foreach($result as $row){
			$dataRow = [
				'id' => $row->exam_id ,
				'title' => $row->exam_title,
				'type' => $row->exam_type,
				'course_title' => $row->course_title ,
				'duration' => $row->exam_duration,
				'total_grade' => $row->total_grade,
				'dateTime' => $row->exam_date_time,
				'admin_verified' => $row->admin_verified,
			];
			
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getExam($exam_id){
		$this->builder = $this->db->table("exam");
		
		$this->builder->join('course', 'course.course_id = exam.course_id')
					->where('exam.exam_id',$exam_id);
		$result = $this->builder->get()->getResult();
		
		$data;
		
		foreach($result as $row){
			$dataRow = [
				'id' => $row->exam_id ,
				'title' => $row->exam_title,
				'type' => $row->exam_type,
				'course_name' => $row->course_title ,
				'duration' => $row->exam_duration,
				'total_grade' => $row->total_grade,
				'dateTime' => date("F j, Y - g:i a", strtotime($row->exam_date_time)),
				'noFormatDateTime' => $row->exam_date_time,
				'admin_verified' => $row->admin_verified,
			];
			
			//array_push($data, $dataRow);
			$data = $dataRow;
		}
		
		return $data;
	}
	
	public function getTheExamQuestions($examID){
		$this->builder = $this->db->table("question");
		
		$this->builder->where('exam_id',$examID);
		
		$result = $this->builder->get()->getResult();
		
		$data = array();
		
		foreach($result as $row){
			$dataRow = [
				'id' => $row->question_id,
				'question' => $row->question_description,
				'answer' => $row->question_answer,
				'type' => $row->question_type,
				'options' => str_replace("#@", ",", $row->question_choices),
				'mark' => $row->question_grade,
			];
			
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function createExam($doctor_id,$course_id, $examTitle, $examType, $examDuration, $examDateTime, $totalGrade){
		$this->builder = $this->db->table("exam");
		$data = [
			'doctor_id' => $doctor_id,
			'course_id' => $course_id,
			'exam_title' => $examTitle,
			'exam_type' => $examType,
			'exam_duration' => $examDuration,
			'exam_date_time' => $examDateTime,
			'total_grade' => $totalGrade,
			'student_grade' => 0,
			'admin_verified' => null,
		];
		
		$this->builder->insert($data);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateExamDetails($exam_id, $title, $type, $course_id, $duration, $dateTime, $total_grade){
		$this->builder = $this->db->table("exam");
		
		$data = [
			'exam_title' => $title,
			'exam_type' => $type,
			'course_id ' => $course_id,
			'exam_duration' => $duration,
			'exam_date_time' => $dateTime,
			'total_grade' => $total_grade,
			'admin_verified' => null,
		];
		
		$this->builder->update($data, ['exam_id' => $exam_id]);
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
				'question_choices' => implode("#@ ", $question_choices),
			];
		}
		
		
		$this->builder->insert($questionData);
		
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getQuestion($question_id){
		$this->builder = $this->db->table("question");
		$this->builder->where('question_id', $question_id);
		
		$result = $this->builder->get()->getResult();
		
		$data = array();
		
		foreach($result as $row){
			$data = [
				'id' => $row->question_id,
				'question' => $row->question_description,
				'answer' => $row->question_answer,
				'type' => $row->question_type,
				'options' => explode("#@ ", $row->question_choices),
				'mark' => $row->question_grade,
			];
		}
		
		return $data;
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateQuestion($question_id, $question, $answer, $mark, $options = null){
		$this->builder = $this->db->table("question");
		
		if(!empty($options)){
			$data = [
				'question_description' => $question,
				'question_choices' => implode("#@ ", $options),
				'question_answer' => $answer,
				'question_grade' => $mark,
			];
		}else{
			$data = [
				'question_description' => $question,
				'question_answer' => $answer,
				'question_grade' => $mark,
			];
		}
		
		
		$this->builder->update($data, ['question_id' => $question_id]);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function deleteQuestion($question_id){
		$this->builder = $this->db->table("question");
		
		$this->builder->where('question_id', $question_id)->delete();
	}
	
	public function deleteExam($exam_id){
		$this->builder = $this->db->table("exam");
		$this->builder->join('question', 'question.exam_id = exam.exam_id')
					->where('exam.exam_id', $exam_id)
					->delete();
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