<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model{
    protected $table='report';
    protected $primaryKey='id';
    protected $allowedFields=['id','userID','examID','image','userName'];
    protected $beforeInsert = [];
    protected $beforeUpdate = [];


    public function getrepo($id){
        $this->builder = $this->db->table("report");
		$res = $this->builder->where('examID',$id)->get()->getResult();
		return $res;

    }


    
	
	
	
	
	
}