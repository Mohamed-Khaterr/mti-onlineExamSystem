<?php

namespace App\Libraries;

/* WebSocket */
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/* APP Model */
use App\Models\ConnectionsModel;
use App\Models\StudentModel;

class Stream implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
		/* My Code */
		// ws://IP-ADDRESS:8080?access_token=.....
		$uri = $conn->httpRequest->getUri(); //->getQuery(); // return access_token=....
		
		//get convert uri to array
		$query_str = parse_url($uri, PHP_URL_QUERY);
		parse_str($query_str, $query_params);
		
		//get access_token value
		$token = $query_params['access_token'];
		
		// when token is null this men the user is Admin not Student
		if($token != null){
			$connModel = new ConnectionsModel();
			$studentModel = new StudentModel();
			
			//get student by student_id === token
			$student = $studentModel->find($token);
			
			
			$conn->user = $student;
			
			$connModel->where('connection_user_id', $student['student_id'])->delete();
			
			
			// Save the new connection
			$connModel->saveToTable(
				$student['student_id'],
				$student['student_fname'] . " " . $student['student_lname'], 
				$conn->resourceId
			);
			
			
			$live = $connModel->findAll();
			
			$liveStudent = ['student' => $live];
			
			// send new user connection as json 
			foreach($this->clients as $client){
				$client->send(json_encode($liveStudent));
			}
			
			
		}
		
		
		/* RACHAT CODE */
		//Store the new connection to send messages to later
        $this->clients->attach($conn);
		
        echo "New connection! ({$conn->resourceId})\n";	
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
		
		// Delete All connection form connections Table
		$connModel = new ConnectionsModel();
        $connModel->where('connection_resource_id', $conn->resourceId)->delete();
        $student = $connModel->findAll();
        $student = ['student' => $student];
        foreach ($this->clients as $client) {
            $client->send(json_encode($student));
        }
		
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}