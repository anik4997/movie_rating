<?php
require_once 'database.php';
class UpdateMovie{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    // Fetches movie details by ID
    public function get_movie_by_id($movie_id) {
        $query = "SELECT * FROM movie WHERE id = ?";
        $params = ["i", $movie_id];
        
        $result = $this->obj->prepareAndExecute($query, $params);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Update movie details
    public function update_movie($movie_id, $movie_data) {
        $movie_name = $movie_data['movie_name'];
        $genre = $movie_data['genre'];
        $release_date = $movie_data['release_date'];
        

        $update_movie_query = "UPDATE movie SET movie_name = '$movie_name', genre = '$genre', release_date = '$release_date' WHERE id = $movie_id";

        $update_query_connection = $this->obj->update_movie($update_movie_query);
        
        // Check if the update operation was successful
        if ($update_query_connection) {
            return true;
        } else {
            return false;
        }
    }
}