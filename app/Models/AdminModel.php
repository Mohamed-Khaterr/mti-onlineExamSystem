<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model{
	protected $table = 'admin';
	protected $db;
	protected $builder;

	public function __construct() {
		$this->db = \Config\Database::connect();
		$this->builder = $this->db->table($this->table);
	}
}