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
	
	
	//----------------------------------------------------------------------------------------------------------------------------------
	// Khater --------------------------------------------------------------------------------------------------------------------------
	public function getCoursesCountAll(){
		$this->builder = $this->db->table("course");
		if($coursesCount = $this->builder()->countAllResults(false)){
			return $coursesCount;
		}else{
			return 0;
		}
	}
	
	public function getCoursesNamesForAdmin(){
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
	
}

?>