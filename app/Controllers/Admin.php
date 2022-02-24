<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends BaseController{
	
	public function __construct(){
    }
	
	public function index(){
		$data['admin_id'] = $_SESSION[ADMIN_ID];
		echo view(ADMIN_VIEW, $data);
	}
}