<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/* WebSocket */
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Stream;
use App\Controllers\WebSocketServer;


class Server extends BaseController{
	
	public function index(){
		
		// file_put_contents("test.txt","Hello World. Testing!");
		
		$webSocket = new WebSocketServer;

		$server = IoServer::factory(new HttpServer(
            new WsServer(
				$webSocket
				)
			),
			//Port No.
			8080 
		);

		$server->loop->addPeriodicTimer(2.2, function () use ($webSocket) {
			
			
			// get all students from connection table
			$students = $webSocket->connModel->where('user_type', 'student')->findAll();
			
			// Make student sendData when they recive "giveMeData"
			foreach($students as $student) {
				$resourceID = $student['connection_resource_id'];
				$webSocket->users[$resourceID]->send("giveMeData");
			}
		});

		
		/* Run WebSocket */

		$server->run();
	}
}