<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model{
	protected $db;
	protected $builder;
	
	
	public function __construct() {
		$this->db = \Config\Database::connect();
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getCourses($doctor_id){
		$this->builder = $this->db->table("course");
		
		$this->builder->join('course_doctor','course.course_id = course_doctor.course_id')
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
	
	public function getCourseTitleWithId($course_id){
		$this->builder = $this->db->table("course");
		$this->builder->select('course_title');
		$this->builder->where('course_id', $course_id);
		
		$query = $this->builder->get();
		$result = $query->getResult();
		foreach($result as $row){
			return $row->course_title;
		}
		
		
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function getProfile($doctor_id){
		$this->builder = $this->db->table("doctor");
		
		$this->builder->where('doctor_id', $doctor_id);
		
		//execute the statment
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			return $result;
		}else{
			return null;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function updateInfo($doctor_id, $full_name, $username, $password, $email, $gender, $birthday){
		$this->builder = $this->db->table("doctor");
		$this->builder->where('doctor_id', $doctor_id);
		
		if(!empty($password)){
			$hash = password_hash($password, PASSWORD_DEFAULT);
		
			$data = [
				'doctor_full_name' => $full_name,
				'doctor_username' => $username,
				'doctor_pass' => $hash,
				'doctor_email' => $email,
				'doctor_gender' => $gender,
				'doctor_BD' => $birthday
			];
			
			$this->builder->update($data);
		}else{
			$data = [
				'doctor_full_name' => $full_name,
				'doctor_username' => $username,
				'doctor_email' => $email,
				'doctor_gender' => $gender,
				'doctor_BD' => $birthday
			];
			
			$this->builder->update($data);
		}
		
	}
	
	//-------------------------------------------------------------------------------------------------------
	
}