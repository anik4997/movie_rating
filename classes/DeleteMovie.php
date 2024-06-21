<?php
require_once 'database.php';
class DeleteMovie{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    // Delete movie
    public function delete_movie($movie_id){
        //delete query
        $delete_query = "DELETE FROM movie WHERE id = $movie_id";

        // Execute the delete query
        $delete_query_connection = $this->obj->delete_movie($delete_query);

        // Check if the delete operation was successful
        if ($delete_query_connection) {
            return true;
        } else {
            return false;
        }
    }
    
}