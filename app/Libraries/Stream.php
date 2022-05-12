<?php

namespace App\Libraries;

// WebSocket 
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

// APP Model 
use App\Models\ConnectionsModel;
use App\Models\StudentModel;
use App\Models\AdminModel;

class Stream implements MessageComponentInterface {
    //protected $clients;
	public $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
		echo "Server is Started!";
    }

    public function onOpen(ConnectionInterface $conn) {
		// My Code 
		// ws://IP-ADDRESS:8080?access_token=.....
		$uri = $conn->httpRequest->getUri(); //->getQuery(); // return access_token=....
		
		//get convert uri to array
		$query_str = parse_url($uri, PHP_URL_QUERY);
		parse_str($query_str, $query_params);
		
		//get access_token value
		$token = $query_params['access_token'];
		
		
		// is STUDENT
		if($token != null){
			$connModel = new ConnectionsModel();
			$studentModel = new StudentModel();
			
			//get student by student_id === token
			$student = $studentModel->find($token);
			$connModel->where('student_id', $student['student_id'])->delete();
			
			$conn->user = $student;
			
			
			$studentFullName = $student['student_fname'] . " " . $student['student_lname'];
			
			// Save the new connection
			$connModel->save([
				'resource_id' => $conn->resourceId,
				'student_id' => $student['student_id'],
				'student_name' => $studentFullName,
				'student_isCheating' => 'no',
			]);
			
			$liveStudent = ['student' => $connModel->findAll()];
			
			// send new user connection as json 
			foreach($this->clients as $client){
				$client->send(json_encode($liveStudent));
			}
		}
		
		
		// RACHAT CODE 
		//Store the new connection to send messages to later
        $this->clients->attach($conn);
		
        echo "New connection! ({$conn->resourceId})\n";	
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
			
			// MY CODE 
			$connModel = new ConnectionsModel();
			// END 
			

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
				
				
				// NEW 
				//$data = json_decode($msg);
				
				
				//$id = $data->id;
				//$image = $data->image;
				//$connModel->updateImage($id, $image);
				// END 
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
		
		// Delete closed client form connections Table
		$connModel = new ConnectionsModel();
        $connModel->where('resource_id', $conn->resourceId)->delete();
		
		// UPDATE ADMIN VIEW IF STUDENT IS CLOSED
        $student = $connModel->findAll();
        foreach ($this->clients as $client) {
            $client->send(json_encode(['student' => $student]));
        }
		
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}



/*
namespace App\Libraries;


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use App\Models\UserWebSocket;

class Chat implements MessageComponentInterface {
    public $clients=[];
    public $array;
    public $userObj,$data,$clientID;
    protected $cid=[];
    public $loop;
	

    public function getClients(){
        
        //$var = array_combine($this->cid,$this->clients);
        return $this->clients;
    }
	

    public function __construct() {
        $this->userObj = new UserWebSocket();

    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        //$this->clients->attach($conn);
    
        $queryString = $conn->httpRequest->getUri()->getQuery(); //identify user based on the token
        parse_str($queryString, $query);
        //identify user connection id
        $this->clients[$conn->resourceId]=$conn;
        
        if($data = $this->userObj->getUserBySession($query['token'])){
           $this->array[$conn->resourceId] = $data;
        }
        echo "New connection! ({$data->username})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;

            $var = $this->array[$from->resourceId];
           // var_dump($var);
		if($var->userID !=1){
            $result=file_get_contents('http://127.0.0.1:7777/user/?url='.$msg.'&user='.$var->userID);
      
            $json = json_decode($result);
            print_r($json);
            
            $name = $json->User;
         

            $admin = $this->getResourceId(1);
            if ($admin) {
                // sleep(1);
                $this->clients[$admin]->send($result);
                
    
            }
		}
    }

    public function getResourceId($id) {
        foreach($this->array as $rid => $data) {
            if ($data->userID == $id) return $rid;
        }
        return NULL;
    }

    public function onClose(ConnectionInterface $conn) {

       unset($this->clients[$conn->resourceId]);
       unset($this->array[$conn->resourceId]);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
*/