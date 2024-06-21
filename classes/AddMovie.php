<?php
require_once 'database.php';
class AddMovie{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    // Add movie
    public function addmovie($movie_data) {
        // Taking values of input field by post(super global variable)
        $movie_name = $movie_data['movie_name'];
        $genre = $movie_data['genre'];
        $release_date = $movie_data['release_date'];
    
        // Insert query
        $movie_insert_query = "INSERT INTO movie (movie_name, genre, release_date) VALUES ('$movie_name', '$genre', '$release_date')";
        $movie_insert_query_connection = $this->obj->insert_movie($movie_insert_query);//This method is from database.php file
        
        if ($movie_insert_query_connection) {
                header("Location: movie_list.php");
                exit; // Ensure that no other code is executed after the redirect
        } else {
            $insert_error_msg = "Failed to add user!";
            return $insert_error_msg;
        }

    }
}