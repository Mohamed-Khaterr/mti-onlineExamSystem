<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Model;
use \App\Models\ConnectionsModel;
use \App\Models\StudentModel;
use \App\Models\AdminModelTwo;
use \App\Controller\AJAXRequest;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface {
    protected $clients;
	public $users = array();
	
	public $connModel;
	protected $studentModel;
	protected $adminModel;
	protected $ajax;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
		
		$this->connModel = new \App\Models\ConnectionsModel();
		$this->studentModel = new \App\Models\StudentModel();
		$this->adminModel = new \App\Models\AdminModelTwo();
		
		$this->ajax = new \App\Controllers\AJAXRequest();
    }
	
	
	// onOpen *****************************************
    public function onOpen(ConnectionInterface $conn) {
		$this->users[$conn->resourceId] = $conn;
		
		
		
		$queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $query);
		
		
		if($query['user'] == 'student'){
			// get student info
			$student = $this->studentModel->find($query['user_id']);
			
			// insert to connections table
			$this->connModel->addRow(
				$conn->resourceId, 
				$query['user_id'], 
				$student['student_fname'] . " " . $student['student_lname'], 
				$query['examID'], 
				'student'
			);
		}elseif($query['user'] == 'admin'){
			
			// get admin info
			$admin = $this->adminModel->find($query['user_id']);
			
			// insert to connection table
			$this->connModel->addRow(
				$conn->resourceId, 
				$query['user_id'], 
				$admin['admin_fname'] . " " . $admin['admin_lname'], 
				$query['examID'], 
				'admin'
			);
		}
		
		
		// Store the new connection to send messages to later
        $this->clients->attach($conn);
    }
	
	// onMessage *****************************************
    public function onMessage(ConnectionInterface $from, $msg) {
		// get all admin from connection table
		$admins = $this->connModel->where('user_type', 'admin')->findAll();
		
		// get all students from connection table
		$students = $this->connModel->where('user_type', 'student')->findAll();
		
		$msgData = json_decode($msg);
		
		// file_put_contents("test.txt", $msg);
		
		// Message Came from student
		if($msgData->user == "student"){
			
			if(isset($msgData->offer)){
				$admin = $this->connModel->where('user_type', 'admin')->where('user_id', $msgData->adminID)->findAll();
				
				$resourceId = $admin[0]['connection_resource_id'];
				$this->users[$resourceId]->send($msg);
			}else if (isset($msgData->candidate)){
				$admin = $this->connModel->where('user_type', 'admin')->where('user_id', $msgData->adminID)->findAll();
				
				$resourceId = $admin[0]['connection_resource_id'];
				$this->users[$resourceId]->send($msg);
			}else{
				/**** To Python ****/
				// get sended data from student
				$studentData = json_decode($msg); // $studentData->any
				
				/**** Send Data To Python ****/
				// // Send image and user id to python and get result (cheating, not cheating) with user id
				// $pythonResult = json_decode(file_get_contents('http://127.0.0.1:7777/user/?url='.$studentData->img.'&user='.$studentData->id));
				
				// store the result of python
				$result = [ 'pythonResult' => ['id'=>0, 'status'=>""] ]; 
				/**** End Python ****/
				
				
				
				/**** Capture Student when he/she Cheating ****/
				// get the student that have same id of pythonResult->id
				// $student = $this->connModel->where('user_type', 'student')->where('user_id', $pythonResult->id)->findAll();
				// if($student[0]['user_id'] == $pythonResult->id){
					// if($pythonResult->status == "ok"){
						// // Not Cheating make counter = 2
						// $this->connModel->update($student[0]['connection_id'], ['counter' => 2]);
						
						// // Result that will send to Admin
						// $result['pythonResult'] = [
							// 'id' => $pythonResult->id,
							// 'status' => "Not Cheating",
						// ];
					// }else{
						// // Cheating make counter counter -= 1; if is not smaller than 0
						// if($student[0]['counter'] > 0){
							// $counter = $student[0]['counter'] - 1;
							// $this->connModel->update($student[0]['connection_id'], ['counter' => $counter]);
						// }
						
						// if($student[0]['counter'] <= 0){
							// // Will Capture 4 images of cheating student
							// if($student[0]['cheatingNumber'] <= 9){
								// $cheatingNumber = $student[0]['cheatingNumber'] + 1;
								// $this->connModel->update($student[0]['connection_id'], ['cheatingNumber' => $cheatingNumber]);
								
								// // Server take capture of student cheating after 3 iterations
								// if($cheatingNumber%3 == 0){
									// $this->ajax->insertCheating(
										// $student[0]['user_id'], 
										// "data:image/png;base64," . $pythonResult->img,
										// $student[0]['user_fullName'], 
										// $student[0]['exam_id']
									// );
								// }
							// }
							
							// // Result that will send to Admin
							// $result['pythonResult'] = [
								// 'id' => $pythonResult->id,
								// 'status' => "Cheating",
							// ];
							
						// }
					// }
				// }
				/***** End Capture *****/
				
				
				
				// Send to admin only
				foreach($admins as $admin){
					if($admin['exam_id'] == $studentData->examID){
						// remove image element from json object
						$newStudentData = [
							'user' => 'student',
							'id' => $studentData->id,
							'name' => $studentData->name,
						];
						
						$resourceId = $admin['connection_resource_id'];
						$this->users[$resourceId]->send(json_encode($newStudentData));
						$this->users[$resourceId]->send(json_encode($result));
					}
				}
			}
			
			
		}else if($msgData->user == "admin"){
			// Message Came from Admin
			
			$student = $this->connModel->where('user_type', 'student')->where('user_id', $msgData->studentID)->findAll();
			
			// Send to student only
			$resourceId = $student[0]['connection_resource_id'];
			$this->users[$resourceId]->send($msg);
		}
		
		
		
		
		
		
    }
	
	// onClose *****************************************
    public function onClose(ConnectionInterface $conn) {
		
		$user = $this->connModel->where('connection_resource_id', $conn->resourceId)->first();
		
		
		// Remove student from admin view
		if($user['user_type'] == 'student'){
			
			// get all admin from connection table
			$admins = $this->connModel->where('user_type', 'admin')->findAll();
			
			// Foreach admin send
			foreach ($admins as $admin){
				// Send all client to single admin
				foreach ($this->clients as $client) {
					
					// Send msg to admin only
					if($admin['connection_resource_id'] == $client->resourceId){
						
						$client->send(json_encode(['isClosed' => ['studentId' => $user['user_id']]]));
					}
					
				}
			}
		}
		
		// delete user from connections table after he/she disconnect
		$this->connModel->where('connection_resource_id', $conn->resourceId)->delete();
		
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
    }
	
	
	// onError *****************************************
    public function onError(ConnectionInterface $conn, \Exception $e) {
		file_put_contents("test.txt", "An error has occurred: {$e->getMessage()}\n");
		
		
		// delete user from connections table after he/she disconnect
		// $this->connModel->where('connection_resource_id', $conn->resourceId)->delete();
		
		// delete all rows
		$this->connModel->purgeDeleted();
		
        $conn->close();
    }
}