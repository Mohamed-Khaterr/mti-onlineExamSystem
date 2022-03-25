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
	
	public function getExamQuestions($exam_id){
		$this->builder = $this->db->table("question");
		
		$this->builder->where('exam_id',$exam_id);
		
		$result = $this->builder->get()->getResult();
		
		$data = array();
		
		foreach($result as $row){
			$dataRow = [
				'id' => $row->question_id,
				'question' => $row->question_description,
				'answer' => $row->question_answer,
				'type' => $row->question_type,
				'options' => explode('#@ ', $row->question_choices),
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
                      ->where('regist_course.student_id',$student_id);
        
        //execute the statment
        $query = $this->builder->get();
        
        if($result = $query->getResult()){
            return $result;
        }else{
            return null;
        }

    }
}