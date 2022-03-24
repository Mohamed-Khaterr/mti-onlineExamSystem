<?php 
namespace App\Models;

use CodeIgniter\Model;

class ConnectionsModel extends Model{
	protected $table = 'connections';
	protected $allowedFields = ['connection_user_id', 'connection_resource_id', 'connection_name'];
 
	public function saveToTable($id, $user_id, $name){
		$db = \Config\Database::connect();
		$builder = $db->table('connections');
		
		echo '<pre style="text-align: center;">';
		print_r($id); echo '<br>';
		print_r($user_id); echo '<br>';
		print_r($name);
		echo '</pre>';
		
		$data = [
			'connection_user_id' => $id,
			'connection_name' => $user_id,
			'connection_resource_id' => $name,
		];
		
		
		$builder->insert($data);
	}
	
	
	public function getData(){
		$db = \Config\Database::connect();
		$builder = $db->table('connections');
		$builder->select('*');
		$result = $builder->get()->getResult();
		
		$json  = json_encode($result);
		$array = json_decode($json, true);
		
		return $array;
	}
}