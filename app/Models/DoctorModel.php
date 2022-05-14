<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model{
	protected $table = "doctor";
	protected $allowedFields = ["doctor_full_name ", "doctor_email", "doctor_pass", "doctor_gender", "doctor_BD"];
	
	protected $db;
	protected $builder;
	
	
	public function __construct() {
		$this->db = \Config\Database::connect();
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getCourses($doctor_id){
		$this->builder = $this->db->table("course");
		
		$this->builder
					->join('course_doctor','course.course_id = course_doctor.course_id')
					->where('course_doctor.doctor_id',$doctor_id);
		$query = $this->builder->get();
		
		$result = $query->getResult();
		
		$data = array(
			'totalCourses' => count($result),
			'courses' => array(),
		);
		foreach($result as $row){
			$dataRow =[
				'id' => $row->course_id,
				'title' => $row->course_title,
				'code' => $row->course_code,
				'level' => $row->course_level,
			];
			
			array_push($data['courses'], $dataRow);
		}
		
		if($result){
			return $data;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getProfile($doctor_id){
		$this->builder = $this->db->table("doctor");
		
		$this->builder->where('doctor_id', $doctor_id);
		
		//execute the statment
		$result = $this->builder->get()->getResult();
		
		$data;
		foreach($result as $row){
			$data = [
				'name' => $row->doctor_full_name,
				'email' => $row->doctor_email,
				'gender' => $row->doctor_gender,
				'BD' => $row->doctor_BD
			];
			
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateProfile($doctor_id, $full_name, $email, $birthday){
		$this->builder = $this->db->table("doctor");
		$this->builder->where('doctor_id', $doctor_id);
		
		$data = [
			'doctor_full_name' => $full_name,
			'doctor_email' => $email,
			'doctor_BD' => $birthday
		];
		
		$this->builder->update($data, 'doctor_id = ' . $doctor_id);
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateProfilePassword($id, $oldPassword, $newPassword){
		$this->builder = $this->db->table("doctor");
		
		$this->builder->select('doctor_pass, doctor_full_name')
					->where('doctor_id', $id);
					
					
		$result = $this->builder->get()->getResult();
		
		
		if(password_verify($oldPassword, $result[0]->doctor_pass)){
			$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			
			$this->builder->update(['doctor_pass' => $hashedPassword], 'doctor_id = ' . $id);
			
			return true;
		}else{
			
			return false;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getExamsOfDoctor($course_id, $doctor_id){
		$this->builder = $this->db->table("exam");
		
		$this->builder->join('course', 'course.course_id = exam.course_id')
					->where('exam.course_id', $course_id)
					->where('doctor_id', $doctor_id);
		
		$result = $this->builder->get()->getResult();
		
		
		$data = array();
		
		foreach($result as $row){
			$dataRow = [
				'id' => $row->exam_id ,
				'title' => $row->exam_title,
				'type' => $row->exam_type,
				'course_title' => $row->course_title ,
				'duration' => date("g:i", strtotime($row->exam_duration)),
				'total_grade' => $row->total_grade,
				'dateTime' => date("F j, Y - g:i a", strtotime($row->exam_date_time)),
			];
			
			array_push($data, $dataRow);
		}
		
		return $data;
	}
	
}