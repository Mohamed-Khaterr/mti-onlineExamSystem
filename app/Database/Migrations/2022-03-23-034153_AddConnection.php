<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddConnection extends Migration
{
    public function up()
	{
			$this->forge->addField([
					'connection_id'          => [
							'type'           => 'INT',
							'unsigned'       => TRUE,
							'auto_increment' => TRUE
					],
					'connection_resource_id'          => [
						'type'           => 'INT',
					],
					'connection_user_id'          => [
						'type'           => 'INT',
					],
					'connection_name'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
					],
					'connection_user_status'	=>[
						'type'			=>  'VARCHAR'
					],
					]);
			$this->forge->addKey('connection_id', true);
			$this->forge->createTable('connections');
	}

	public function down()
	{
			$this->forge->dropTable('connections');
	}
}
