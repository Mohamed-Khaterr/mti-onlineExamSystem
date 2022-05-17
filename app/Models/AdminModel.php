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
		$this->sessionID = $this->getSessionID();
    }

      public function getSessionID(){
         return session_id();

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
	
	public function getCoursesNames(){
		$this->builder = $this->db->table("course");
		$this->builder->select('course_title, course_code, course_level')
					->orderBy('course_level', 'ASC');
		
		$query = $this->builder->get()->getResult();
		
		$data = array();
		foreach($query as $row){
			$dataRow = [
				'title' => $row->course_title,
				'code' => $row->course_code,
				'level' => $row->course_level,
			];
			array_push($data, $dataRow);
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
		
		$data = array();
		
		// current Time
		$current = new Time('now');
		
		foreach($result as $row){
			
			$allRows = [
				'examID' => $row->exam_id, 
				'title' => $row->course_title, 
				'type' => $row->exam_type, 
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
	
	public function getProcessExams(){
		helper('addTimeToDatetime');
		
		$this->builder = $this->db->table("exam");
		
		$this->builder->select('course_title, exam_type, exam_id, exam_date_time, exam_duration, exam_title')
					->join('course', 'course.course_id = exam.course_id')
					->where('DATE(exam_date_time) = DATE(NOW())')
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
	
	
	public function createDoctorUser($fullName, $email, $password, $birthday, $gender){
		$this->builder = $this->db->table("doctor");
		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		$newData = [
			'doctor_full_name' => $fullName,
			'doctor_email' => $email,
			'doctor_pass' => $hashedPassword,
			'doctor_gender' => $gender,
			'doctor_BD' => $birthday,
		];
		
		$this->builder->insert($newData);
	}
	
	public function createStudentUser($firstName, $lastName, $level, $gpa, $email, $password, $birthday, $gender){
		$this->builder = $this->db->table("students");
		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		$newData = [
			'student_fname' => $firstName,
			'student_lname' => $lastName,
			'student_lvl' => $level,
			'GPA' => $gpa,
			'student_gender' => $gender,
			'student_email' => $email,
			'student_password' => $hashedPassword,
			'student_BD' => $birthday,
			
		];
		
		$this->builder->insert($newData);
	}
	
	public function getAllDoctors(){
		$this->builder = $this->db->table("doctor");
		$this->builder->select('doctor_id, doctor_full_name');
		
		$query = $this->builder->get()->getResult();
		
		$data = array();
		foreach($query as $row){
			$dataRow = [
				'id' => $row->doctor_id,
				'name' => $row->doctor_full_name,
			];
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
	public function getAllStudents(){
		$this->builder = $this->db->table("students");
		$this->builder->select('student_fname, student_lname, student_id ');
		
		$query = $this->builder->get()->getResult();
		
		$data = array();
		foreach($query as $row){
			$dataRow = [
				'id' => $row->student_id,
				'name' => $row->student_fname . " " . $row->student_lname,
			];
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
	public function getAllCourses(){
		$this->builder = $this->db->table("course");
		$this->builder->select('course_id, course_title');
		
		$query = $this->builder->get()->getResult();
		
		$data = array();
		foreach($query as $row){
			$dataRow = [
				'id' => $row->course_id ,
				'title' => $row->course_title,
			];
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
	
	public function enrollDoctor($drID, $courseID){
		$this->builder = $this->db->table("course_doctor");
		$this->builder->where('doctor_id = ' . $drID . ' AND course_id = ' . $courseID);
		
		if(count($this->builder->get()->getResult()) > 0){
			return false;
		}else{
			$newData = [
				'doctor_id' => $drID,
				'course_id' => $courseID,
				
			];
			
			$this->builder->insert($newData);
			return true;
		}
	}
	
	
	public function enrollStudent($studentID, $courseID){
		$this->builder = $this->db->table("regist_course");
		$this->builder->where('student_id = ' . $studentID . ' AND course_id = ' . $courseID);
		
		if(count($this->builder->get()->getResult()) > 0){
			return false;
		}else{
			$newData = [
				'student_id' => $studentID,
				'course_id' => $courseID,
				
			];
			
			$this->builder->insert($newData);
			return true;
		}
	}


	public function updateAsession($id){
		$this->builder = $this->db->table('admin');
		$table = $this->builder->join('users', "users.userID = admin.userID")
		                       ->where('admin.userID',$id);
	
		$data = [
			'session_id' => $this->sessionID 
		];
	
		$table->update($data);
	
	}
	
}


