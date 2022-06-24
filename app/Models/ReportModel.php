<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model{
    protected $table='report';
    protected $primaryKey='id';
    protected $allowedFields=['id','userID','image','userName','exam_id'];
    protected $beforeInsert = [];
    protected $beforeUpdate = [];


    public function getrepo(){
        $this->builder = $this->db->table("report");
		$res = $this->builder->get()->getResult();
		return $res;

    }


    
	
	
	
	
	
}