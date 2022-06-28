<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AdminModelTwo extends Model{
	protected $table      = 'admin';
    protected $primaryKey = 'admin_id';

    protected $allowedFields = ['admin_fname', 'admin_lname', 'admin_email', 'admin_pass', 'session_id', 'userID'];
}