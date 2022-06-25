<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use \App\Models\UsersModel;
class Chat implements MessageComponentInterface{

    public $clients=[];
    public $array;
    public $userObj,$data,$clientID;
    protected $cid=[];
    public $loop;

    // public function send($msg){
        
    //     foreach ($this->clients as $client) {
    //        $client->send($msg);
          
    //     }  
    // }

    public function getClients(){
        
        //$var = array_combine($this->cid,$this->clients);
        return $this->clients;
    }
    // public function getClientID(){
    //     return $this->cid;
    // }

    public function __construct() {
        // $this->clients = new \SplObjectStorage;
        $this->userObj =new UsersModel;
       // $this->loop = true;

    }

    public function onOpen(ConnectionInterface $conn) {
        // $userObj = new UsersModel;
        echo "newConnection";
        // Store the new connection to send messages to later
        //$this->clients->attach($conn);
    
        $queryString = $conn->httpRequest->getUri()->getQuery(); //identify user based on the token
        parse_str($queryString, $query);
        //identify user connection id
        $this->clients[$conn->resourceId]=$conn;
        
        if($data = $this->userObj->getUserBySession($query['token'])){
           $this->array[$conn->resourceId] = $data;
            ////$this->clients[$data->userID]=$conn;
            // $this->data = $data;
            // $conn->data = $data;
            // // $this->clients->attach($conn);
            // $this->clients[$data->userID]=$conn;
            // // $this->cid[ $data->userID] =$conn;
            // $this->userObj->updateConnection($conn->resourceId,$data->userID);
        }
            
        // echo "New connection! ({wael})\n";
        $myfile = fopen("test.txt", "a");
			$txt = "\nNew connection! ".$data->username;
			fwrite($myfile, $txt);
			fclose($myfile);    
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        

        // if ($this->array[$from->resourceId]->userID == 1) {
        //     return;
        // }
        $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            // , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        //echo "asjfhasdjfk".$msg;
        // $data = json_decode($msg);
        // if ($data['type'] == 'image') {
           
        // } else if ($data['type'] == 'newconnection') {
            // $this->array[$data['content']] = $from->resourceId;
        // }
            // $var=$this->userObj->getUserByResourceID($from->resourceId);
            // foreach($this->clients as $id => $conn) {
            //     if ($conn->resourceId == $from->resourceId) {
            //         $var = $id;
            //         break;
            //     }
            // }

            $var = $this->array[$from->resourceId];
			// var_dump($var);
		   
			if($var->userID != 1){
				$result= file_get_contents('http://127.0.0.1:7777/user/?url='.$msg.'&user='.$var->userID);

				$json = json_decode($result);
				print_r($json);

				$name = $json->User;


				$admin = $this->getResourceId(1);
				if ($admin) {
				// sleep(1);
					$this->clients[$admin]->send($result);
				}
			}

            
            
          
            //echo $from->resourceId;

       
            
            


        
       //$this->clients[$from->resourceId]->send($name);
    }

    public function getResourceId($id) {
        foreach($this->array as $rid => $data) {
            if ($data->userID == $id) return $rid;
        }
        return NULL;
    }

    public function onClose(ConnectionInterface $conn) {

        // The connection is closed, remove it, as we can no longer send it messages
       // $this->clients->unset($conn);

       unset($this->clients[$conn->resourceId]);
       unset($this->array[$conn->resourceId]);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

}
?>