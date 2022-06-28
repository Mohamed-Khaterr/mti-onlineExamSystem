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

		$server->loop->addPeriodicTimer(3.2, function () use ($chat) {
			
			// if (!$chat->loop) return;
			$arrayID = [2,3,4,5,6,7,8,9,10,11];
	
				// array of id users
			
			//print_r($chat->getClients()); 
		   
			//echo gettype($chat->getClientID());
			//print_r($chat->clients );
			foreach($chat->clients as $rid=>$client) {
				
			   // echo gettype($client);
			   // print_r($client);
			   //print_r( $client);
				
			   
				// foreach($arrayID as $arrid){
				//     if( $chat->array[$rid]===$arrid){
					  
				//         $client->send('hi');
				//     }
	
				// }
	
				if (in_array($chat->array[$rid]->userID, $arrayID)) {
					$client->send('hi');
				}
	
			
				
	
			 }
				// gettype($chat->getClients());
			// foreach($chat->getClients() as $client) {
			//     //echo $client->resourceId;
			//     // echo $chat->getClientID();
				
			//     // foreach($chat->array as $key=>$value) {
			//     //     if ($key == 1 && $client->resourceId == $value) {
						
			//     //     }
			//     // }
			// //     foreach($arrayID as $id){
			// //     if( $chat->getClientID()===$id){
				   
			// //     }
			// // }
				
			// //$client->send('hi');
			// }
		});

		
		/* Run WebSocket */

		$server->run();
	}
}