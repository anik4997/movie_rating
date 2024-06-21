<?php
require_once 'database.php';
class FetchMovie{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    //  This method is for select query for movie list
    public function show_movie(){
        $show_movie_query = "SELECT * FROM movie";
        $show_movie_query_connection = $this->obj->select($show_movie_query); //This method is from database.php file
        return $show_movie_query_connection;
    }
}