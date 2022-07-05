<?php 
namespace App\Models;

use CodeIgniter\Model;

class ConnectionsModel extends Model{
	
	protected $table = 'connections';
	
	protected $primaryKey = 'connection_id';
	
	protected $allowedFields = ['connection_resource_id', 'user_id', 'user_fullName', 'exam_id', 'cheatingNumber', 'counter'];
	
	
	public function addRow($resourceId, $userID, $fullName, $examID, $userType){
		$db = \Config\Database::connect();
		$builder = $db->table("connections");
		
		if($userType == 'student'){
			$newUser = [
				'connection_resource_id' => $resourceId,
				'user_id' => $userID,
				'user_fullName' => $fullName,
				'exam_id' => $examID,
				'user_type' => 'student',
				'cheatingNumber' => 0,
				'counter' => 0,
			];
			$builder->insert($newUser);
		}else{
			$newUser = [
				'connection_resource_id' => $resourceId,
				'user_id' => $userID,
				'user_fullName' => $fullName,
				'exam_id' => $examID,
				'user_type' => 'admin',
				'cheatingNumber' => 0,
				'counter' => 0,
			];
			$builder->insert($newUser);
		}
		
	}
}