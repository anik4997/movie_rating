<?php
require_once 'database.php';
class Search{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }
    // Search movie
    public function movie_search($search_input){
        $movie_search = $search_input['search_input'];
        $search_query = "SELECT * FROM movie WHERE movie_name LIKE '%$movie_search%'";
        $search_query_connection = $this->obj->search_movie($search_query);   
        if ($search_query_connection) {
            // Return the MySQLi result set directly
            return $search_query_connection;
        } else {
            // Return false or any appropriate value if the query fails
            return false;
            }
        }      
}