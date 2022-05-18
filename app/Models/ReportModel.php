<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model{
    protected $table='report';
    protected $primaryKey='id';
    protected $allowedFields=['id','userID','image','userName','exam_id'];
    protected $beforeInsert = [];
    protected $beforeUpdate = [];



    function updaterec($id,$userName,$img){
        $this->builder = $this->db->table('report');
        

        $data = [
            'userID' => $id
            ,'userName' => $userName,
            'image'=> $image
        ];

        $this->builder->save($data);

    }
	
	
	
	
	
	
}