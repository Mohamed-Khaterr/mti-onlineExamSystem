<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model{
    protected $table = 'course';
    protected $primaryKey='course_id';
    protected $allowedFields=['course_pic','course_title','course_code'];

    public function __construct() {
		$this->db = \Config\Database::connect();
		$this->builder = $this->db->table($this->table);
	}
    
    function GetStuCourses($student_id){
            $this->builder = $this->db->table($this->table);
            $this->builder->join('regist_course','course.course_id = regist_course.course_id')
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

?>