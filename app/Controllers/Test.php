<?php
namespace App\Controllers;

use App\Models\ConnectionsModel;
use App\Models\StudentModel;

class Test extends BaseController
{
    public function index(){	
		$connModel = new ConnectionsModel();
		$studentModel = new StudentModel();
		
		$student = $studentModel->find(3);
		
		$newConnData = [
			//'connection_user_id' => $student['student_id'],
			'connection_name' => $student['student_fname'] . " " . $student['student_lname'],
			'connection_resource_id' => 1555 //$conn->resourceId,
		];
		
		//$connModel->save($newConnData);
		
		//$connModel->saveToTable(
			//$student['student_id'], 
			//$student['student_fname'] . " " . $student['student_lname'], 
			//155
		//);
		
		//$liveStudent = $connModel->findAll();
		
		$liveStudent = $connModel->getData();
		
		
		echo '<pre style="text-align: center;">';
		//print_r($liveStudent);
		echo '</pre>';
		
        return view('webSocketTest');
    }
	
}

