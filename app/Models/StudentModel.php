<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model{
    protected $table='students';
    protected $primaryKey='student_id';
    protected $allowedFields=['student_fname','student_lname','student_pic' , 'student_lvl','GPA','student_gender','student_email','student_password','student_BD','student_created_at','student_updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];



    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }


    protected function passwordHash(array $data){

        if(isset($data['data']['student_password']))
          $data['data']['student_password'] = password_hash($data['data']['student_password'], PASSWORD_DEFAULT);

        
        return $data;
    }
	
	
	
	
	
	
	
}