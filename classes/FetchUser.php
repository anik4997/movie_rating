<?php
require_once 'database.php';
class FetchUser{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

     // select all user data
    public function selectuser(){
        $select_alluserdata = 'SELECT * FROM user';
        $select_alluserdata_connection = $this->obj->select_user_connection($select_alluserdata);
        return $select_alluserdata_connection;
    }
        public function get_user_by_id($user_id) {
            $query = "SELECT * FROM user WHERE id = ?";
            $stmt = $this->obj->prepareAndExecute($query, ["i", $user_id]);
            return $stmt->fetch_assoc();
        }
    
}