<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/* WebSocket */
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Stream;


class Server extends BaseController{
	
	public function __construct(){
		
    }
	
	public function index(){
		
		if(!is_cli()){
			die('End.... ');
		}
		
		//require dirname(__DIR__) . '/vendor/autoload.php';

		$server = IoServer::factory(new HttpServer(
            new WsServer(
				new Stream()
				)
			),
			//Port No.
			8080 
		);
		/* Run WebSocket */
		$server->run();
	}
}