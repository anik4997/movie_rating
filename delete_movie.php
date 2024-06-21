<?php
session_start();
require_once 'classes/DeleteMovie.php';

// Initialize variables
$movie_id = null;

// Check if the movie_id is set in the GET request
if (isset($_GET['movie_id'])) {
    $movie_id = intval($_GET['movie_id']); // Ensure the ID is an integer
    $delete_movie_obj = new DeleteMovie();

    // Attempt to delete the movie
    if ($delete_movie_obj->delete_movie($movie_id)) {
        $_SESSION['success_message'] = "Movie deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to delete movie!";
    }
} else {
    $_SESSION['error_message'] = "No movie ID provided!";
}

// Redirect back to the movie list page
header("Location: movie_list.php");
exit;