<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AJAXRequest extends BaseController{
	
	public function handleAjaxRequest(){
		echo "Handle Ajax Request";
			
		// Check for AJAX request.
		if ($this->request->isAJAX()) {
			// ...
			echo "\nAJAX Request";
			
			$id = $this->request->getJsonVar('userId');
			$name = $this->request->getJsonVar('userName');
			$img = $this->request->getJsonVar('image');
			$examID = $this->request->getJsonVar('examID');
			
			
			$model = new \App\Models\ReportModel(); 
			$newdata=[
				'userID'=> $id,
				'image' => $img,
				'userName' => $name,
				'examID'=> $examID,

			];
			$model->insert($newdata);
			
			echo "\nInsert Successfully";
		}
	}
	
	
	public function insertCheating($userID, $img, $userName, $examID){
		$model = new \App\Models\ReportModel(); 
		$newdata=[
			'userID'=> $userID,
			'image' => $img,
			'userName' => $userName,
			'examID'=> $examID,

		];
		$model->insert($newdata);
	}
}