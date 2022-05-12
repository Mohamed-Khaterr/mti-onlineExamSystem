<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{

    public $db, $userID ,$sessionID;

    protected $table = "users";
    public function __construct() {
        $this->db = \Config\Database::connect();
        // $this->userID= $this->ID();
        $this->sessionID = $this->getSessionID();
    }
public function getSessionID(){
    return session_id();
}
// public function updateSession(){
//     $stmt = $this->db->prepare("UPDATE `users` SET `sessionID` = :sessionID
//      WHERE `student_id`=:userID");
//      $stmt->bindParam(":sessionID",$this->sessionID,PDO::PARAM_STR);
//      $stmt->bindParam(":userID",$this->userID,PDO::PARAM_INT);
//      $stmt->execute();

// }

public function updateSsession($id){
    $this->builder = $this->db->table('users');
    $table = $this->builder->join('students', "students.userID = users.userID")->where('users.userID',$id);

    $data = [
        'sessionID' => $this->sessionID 
    ];

    $table->update($data);

}

public function updateAsession($id){

    $this->builder = $this->db->table('users');
    $table = $this->builder->join('admin', "admin.userID = users.userID")->where('users.userID',$id);

    $data = [
        'sessionID' => $this->sessionID 
    ];

    $table->update($data);
}



// public function getUserBySession($sessionID){
//     $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `sessionID`= :sessionID");
//     $stmt->bindParam(":sessionID",$sessionID,PDO::PARAM_STR);
//     $stmt->execute();
//     return $stmt->fetch(PDO::FETCH_OBJ);  
// }

public function getUserBySession($sessionID){
    $this->builder = $this->db->table('users');
    $this->builder->where('users.sessionID',$sessionID);
    $query = $this->builder->get();
    if($result = $query->getRow()){
        return $result;
    }else{
        return null;
    }


}



}
?>