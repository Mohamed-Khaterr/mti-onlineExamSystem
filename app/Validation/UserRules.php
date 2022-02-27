<?php
namespace App\validation;

class UserRules
{
    public function validateUser(string $str, string $fields ,array $data){

        $model = new \App\Models\StudentModel();
        $user = $model->where('student_email',$data['student_email'])
                      ->first();
        
                      

       if(!$user)
          return false;
          
          
       return password_verify($data['student_password'],$user['student_password']);    
    } 



    
}