<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
	protected $db;
	protected $builder;
	
	public function __construct() {
		$this->db = \Config\Database::connect();
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function doctorVerification($email, $password){
		$this->builder = $this->db->table("doctor");
		
		$verified = ['verify'=>'', 'error'=>''];
		
		$this->builder->where('doctor_email', $email);

		//execute the statment
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			//$result is an object Array
			//Email is right
			foreach($result as $row){
				if(password_verify($password, $row->doctor_pass)){
					//Password is right
					$verified['verify'] = $result;
					return $verified;
					
				}else{
					//Password is wrong
					$verified['error'] = 'Password is wrong!';
					return $verified;
				}
			}
			
		}else{
			//Email is worng
			$verified['error'] = 'Email is wrong!';
			return $verified;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function studentVerification($email, $password){
		$this->builder = $this->db->table("students");
		
		$verified = ['verify'=>'', 'error'=>''];
		
		$this->builder->where('student_email', $email);

		//execute the statment
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			//$result is an object Array
			//Email is right
			foreach($result as $row){
				if(password_verify($password, $row->student_password)){
					//Password is right
					$verified['verify'] = $result;
					return $verified;
					
				}else{
					//Password is wrong
					$verified['error'] = 'Password is wrong!';
					return $verified;
				}
			}
			
		}else{
			//Email is worng
			$verified['error'] = 'Email is wrong!';
			return $verified;
		}
	}
	
	//-------------------------------------------------------------------------------------------------------
	
	public function adminVerification($email, $password){
		$this->builder = $this->db->table("admin");
		
		$verified = ['verify'=>'', 'error'=>''];
		
		$this->builder->where('admin_email', $email);

		//execute the statment
		$query = $this->builder->get();
		
		if($result = $query->getResult()){
			//$result is an object Array
			//Email is right
			foreach($result as $row){
				if(password_verify($password, $row->admin_pass)){
					//Password is right
					$verified['verify'] = $result;
					return $verified;
					
				}else{
					//Password is wrong
					$verified['error'] = 'Password is wrong!';
					return $verified;
				}
			}
			
		}else{
			//Email is worng
			$verified['error'] = 'Email is wrong!';
			return $verified;
		}
	}
}