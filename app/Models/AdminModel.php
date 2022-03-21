<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AdminModel extends Model{
	protected $db;
	protected $builder;

	public function __construct() {
		$this->db = \Config\Database::connect();
		$this->builder = $this->db->table("admin");
	}
	
	public function getStudentsCountAll(){
		$this->builder = $this->db->table("students");
		// the parameter false prevents the query from being reset.
		if($studentCount = $this->builder()->countAllResults(false)){
			return $studentCount;
		}else{
			return 0;
		}
	}
	
	public function getCoursesCountAll(){
		$this->builder = $this->db->table("course");
		if($coursesCount = $this->builder()->countAllResults(false)){
			return $coursesCount;
		}else{
			return 0;
		}
	}
	
	public function getExamsCountAll(){
		$this->builder = $this->db->table("exam");
		if($examsCount = $this->builder->countAllResults(false)){
			return $examsCount;
		}else{
			return 0;
		}
	}
	
	public function getStudentsName(){
		$this->builder = $this->db->table("students");
		$this->builder->select('student_fname, student_lname');
		
		$query = $this->builder->get()->getResult();
		
		$data = array();
		foreach($query as $row){
			array_push($data, $row->student_fname . " " . $row->student_lname);
		}
		
		return $data;
	}
	
	public function getUpcomingExams(){
		$this->builder = $this->db->table("exam");
		
		$this->builder->select('course_title, exam_type, exam_date_time, exam_id')
					->join('course', 'course.course_id = exam.course_id')
					->where('exam_date_time >= DATE(NOW())')
					->orderBy('exam_date_time','ASC');
		
		$result = $this->builder->get()->getResult();
		
		$data = array(
			'examID' => array(), 
			'title' => array(), 
			'type' => array(), 
			'datetime' => array(),
			'isPast' => array()
		);
		
		
		$current = new Time('now');
		foreach($result as $row){	
			array_push($data['examID'], $row->exam_id);
			array_push($data['title'], $row->course_title);
			array_push($data['type'], $row->exam_type);
			
			$newDate = date("F j, Y, g:i a", strtotime($row->exam_date_time));
			
			array_push($data['datetime'], $newDate);
			
			$date = new Time($newDate);
			$diff = $current->difference($date);
			
			if($diff->hours <= 0 && $diff->day == null){
				array_push($data['isPast'], true);
				
			}else{
				
				array_push($data['isPast'], false);
			}
		}
		
		return $data;
	}
	
	
	
	public function deleteExam($exam_id){
		$this->builder = $this->db->table("exam");
		$this->builder->select('*')
					->join('question', 'question.exam_id = exam.exam_id')
					->where('exam.exam_id', $exam_id)
					->delete();
	}
	
	
	
	public function getProcessExams(){
		$this->builder = $this->db->table("exam");
		
		$this->builder->select('course_title, exam_type, exam_id, exam_date_time')
					->join('course', 'course.course_id = exam.course_id')
					->where('DATE(exam_date_time) = DATE(NOW())')
					->orderBy('exam_date_time','DESC');
		
		$result = $this->builder->get()->getResult();
		
		$data = array(
			'id' => array(),
			'title' => array(),
			'type' => array(),
			'dateTime'=> array(),
			'isPast' => array()
		);
		
		$current = new Time('now');
		
		foreach($result as $row){	
			array_push($data['id'], $row->exam_id);
			array_push($data['title'], $row->course_title);
			array_push($data['type'], $row->exam_type);
			
			$newDate = date("g:i a", strtotime($row->exam_date_time));
			array_push($data['dateTime'], $newDate);
			
			
			$date = new Time($newDate);
			$diff = $current->difference($date);
			
			if($diff->hours < 0){
				array_push($data['isPast'], true);
				
			}else{
				
				array_push($data['isPast'], false);
			}
		}
		
		
		return $data;
	}
	
	
	public function verifiedExams(){
		$this->builder = $this->db->table("exam");
		
		$data = [
			'verified' => count($this->builder->where('admin_verified', 'true')->get()->getResult()),
			'notVerified' => count($this->builder->where('admin_verified', null)->get()->getResult()),
			'exams' => array(
				'title' => array(),
				'examTitle' => array(),
				'type' => array(),
				'admin_verified' => array(),
				'examID' => array(),
			),
		];
		
		$result = $this->builder->select('course_title, admin_verified , exam_title, exam_type, exam_id')
					->join('course', 'course.course_id = exam.course_id')
					->orderBy('exam_date_time','DESC')
					->get()->getResult();
		
		foreach($result as $row){
			array_push($data['exams']['title'], $row->course_title);
			array_push($data['exams']['examTitle'], $row->exam_title);
			array_push($data['exams']['type'], $row->exam_type);
			array_push($data['exams']['admin_verified'], $row->admin_verified);
			array_push($data['exams']['examID'], $row->exam_id);
		}
		
		return $data;
	}
	
	public function acceptExam($id){
		$this->builder = $this->db->table("exam");
		
		$this->builder->update(["admin_verified" => 'true'] ,'exam_id = ' . $id);
	}
	
	
	
	
	public function getProfileInfo($id){
		$this->builder = $this->db->table("admin");
		$this->builder->select('*')
					->where('admin_id', $id);
		
		$result = $this->builder->get()->getResult();
		
		$data = array(
			'id' => $_SESSION[ADMIN_ID],
			'firstName' => "",
			'lastName' => "",
			'email' => ""
		);
		foreach($result as $row ){
			$data['firstName'] = $row->admin_fname;
			$data['lastName'] = $row->admin_lname;
			$data['email'] = $row->admin_email;
		}
		
		return $data;
	}
	
	public function updateProfileInfo($id, $fname, $lname, $email){
		$this->builder = $this->db->table("admin");
		$data = [
			'admin_fname'   => $fname,
			'admin_lname'  => $lname,
			'admin_email' => $email,
		];
		
		
		
		$this->builder->update($data ,'admin_id = ' . $id);
	}
	
	public function changePasswordOfAdmin($id, $oldPassword, $newPassword, $renewPassword){
		$this->builder = $this->db->table("admin");
		
		
		$this->builder->select('admin_pass')
					->where('admin_id', $id);
					
					
					
		$result = $this->builder->get()->getResult();
		
		
		
		if(password_verify($oldPassword, $result[0]->admin_pass)){
			$hashedPassword = password_hash($renewPassword, PASSWORD_DEFAULT);
			
			$this->builder->update(['admin_pass'   => $hashedPassword], 'admin_id = ' . $id);
			
			return true;
		}else{
			
			return false;
		}
	}
	
}