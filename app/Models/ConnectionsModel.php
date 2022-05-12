<?php 
namespace App\Models;

use CodeIgniter\Model;

class ConnectionsModel extends Model{
	
	protected $table = 'connections';
	
	protected $primaryKey = 'connection_id';
	
	protected $allowedFields = ['resource_id', 'student_id', 'student_name', 'student_isCheating'];
	
}