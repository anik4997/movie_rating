<?php
require_once 'database.php';
require_once 'FetchMovie.php';
class Ratings{
    private $user_id; // Class property to store the user ID
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    public function movie_rating($user_rating) {
        $rating_user = $user_rating['rating'];
        $user_id = $user_rating['user_id'];
        $movie_name = $user_rating['movie_name'];
        
        // Get movie ID
        $fetch_movie_obj = new FetchMovie();
        $movies = $fetch_movie_obj->show_movie();
        $movie_id = null;
        
        while ($row = mysqli_fetch_assoc($movies)) {
            if ($row['movie_name'] === $movie_name) {
                $movie_id = $row['id'];
                break; // Exit the loop once the movie is found
            }
        }
        
        if ($movie_id !== null) {
            // Check if the user has already rated this movie
            $check_rating_query = "SELECT * FROM ratings WHERE user_id = '$user_id' AND movie_id = '$movie_id'";
            $check_rating_query_connection = $this->obj->select_ratings_connection($check_rating_query);
            
            if (mysqli_num_rows($check_rating_query_connection) == 0) {
                // Insert the rating
                $rating_insert_query = "INSERT INTO ratings (user_id, movie_id, rating) VALUES ('$user_id', '$movie_id', '$rating_user')";
                $rating_insert_query_connection = $this->obj->insert_movie_rating($rating_insert_query);
                
                if ($rating_insert_query_connection) {
                    header("Location: movie_list.php?user_id=$user_id");
                    exit; // Ensure that no other code is executed after the redirect
                } else {
                    return "Failed to add rating!";
                }
            } else {
                $_SESSION['error_message'] = "You have already rated this movie!";
                header("Location: movie_list.php?user_id=$user_id");
                exit;
            }
        } else {
            // Movie not found, handle the error
            $_SESSION['error_message'] = "Movie not found!";
            header("Location: movie_list.php?user_id=$user_id");
            exit;
        }
    }

    // Average movie rating
    public function get_average_rating($movie_id) {
        $avg_rating_query = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS rating_count FROM ratings WHERE movie_id = ?";
        $params = ["i", $movie_id]; 
    
        $result = $this->obj->prepareAndExecute($avg_rating_query, $params);
    
        // Fetch the row
        $row = $result->fetch_assoc();
    
        // Get the average rating and rating count
        $avg_rating = $row['avg_rating'] ?? 0; // Default average rating if no result
        $rating_count = $row['rating_count'] ?? 0; // Default rating count if no result
    
        return ['average_rating' => $avg_rating, 'rating_count' => $rating_count];
    }
    
}