<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/* WebSocket */
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Stream;
use App\Controllers\Chat;


class Server extends BaseController{
	// public $chat;
	public function __construct(){
		
	}
	

	
	public function index(){
		
		file_put_contents("test.txt","Hello World. Testing!");
		$chat = new Chat;
		if(!is_cli()){
			die('End.... ');
		}
		
		//require dirname(__DIR__) . '/vendor/autoload.php';

		$server = IoServer::factory(new HttpServer(
            new WsServer(
				$chat
				)
			),
			//Port No.
			8080 
		);

		$server->loop->addPeriodicTimer(2.2, function () use ($chat) {
			/*
			$arrayID = [2,3,4,5,6,7,8,9,10,11];
			
			
			
			foreach($chat->clients as $rid=>$client) {
				if (in_array($chat->array[$rid]->userID, $arrayID)) {
					$client->send('hi');
				}
			}
			*/
			
			
			
			
			// // Send all client to single admin
			foreach ($chat->clients as $client) {
					$client->send("hi");
			}
			
			
			
			
		});

		
		/* Run WebSocket */

		$server->run();
	}
}