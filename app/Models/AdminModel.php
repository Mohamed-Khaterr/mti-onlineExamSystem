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
		
		$this->builder->select('course_title, exam_type, exam_date_time, exam_id, admin_verified')
					->join('course', 'course.course_id = exam.course_id')
					->where('exam_date_time >= DATE(NOW())')
					->orderBy('exam_date_time','ASC');
		
		$result = $this->builder->get()->getResult();
		
		$data = array();
		
		// current Time
		$current = new Time('now');
		
		foreach($result as $row){
			
			$allRows = [
				'examID' => $row->exam_id, 
				'title' => $row->course_title, 
				'type' => $row->exam_type, 
				'isVerified' => $row->admin_verified,
			];
			
			$examDateTime = date("F j, Y, g:i a", strtotime($row->exam_date_time));
			
			$allRows['datetime'] = $examDateTime;
			
			$timeObj = new Time($examDateTime);
			
			if($current->isAfter($timeObj)){
				$allRows['isPast'] = true;
				
			}else{
				
				$allRows['isPast'] = false;
			}
			
			array_push($data, $allRows);
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
		helper('addTimeToDatetime');
		
		$this->builder = $this->db->table("exam");
		
		$this->builder->select('course_title, exam_type, exam_id, exam_date_time, exam_duration, exam_title')
					->join('course', 'course.course_id = exam.course_id')
					->where('DATE(exam_date_time) = DATE(NOW())')
					->where('admin_verified', "true")
					->orderBy('exam_date_time','ASC');
		
		$result = $this->builder->get()->getResult();
		
		$data = array();
		
		$current = new Time('now');
		
		foreach($result as $row){
			
			$allRows = [
				'id' => $row->exam_id,
				'title' => $row->course_title,
				'examTitle' => $row->exam_title,
				'type' => $row->exam_type,
			];
			
			$examDateTime = date("g:i a", strtotime($row->exam_date_time));
			
			$allRows['dateTime'] = $examDateTime;
			
			$examStartTime = new Time($examDateTime);
			
			
			$duration = date("g:i a", strtotime($row->exam_duration));
			$examEndTime = new Time(addTimeToDatetime($examDateTime, $duration));
			
			$allRows['endTime'] = date("g:i a", strtotime($examEndTime));
			
			if($current->isAfter($examEndTime)){
				$allRows['isPast'] = true;
				$allRows['status'] = "End";
				
			}elseif($current->isBefore($examStartTime)){
				$allRows['isPast'] = false;
				$allRows['status'] = "Wait";
				
			}else{
				$allRows['isPast'] = false;
				$allRows['status'] = "In Process";
			}
			
			array_push($data, $allRows);
		}
		
		return $data;
	}
	
	public function getEndTime($id){
		helper('addTimeToDatetime');
		
		$this->builder = $this->db->table("exam");
		$this->builder->select('exam_date_time, exam_duration')
					->where('exam_id', $id);
					
		$result = $this->builder->get()->getResult();
		
		$data;
		
		foreach($result as $row){
			$examEndTime = addTimeToDatetime($row->exam_date_time, $row->exam_duration);
			$data = date("Y-m-d H:i:s", strtotime($examEndTime));
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