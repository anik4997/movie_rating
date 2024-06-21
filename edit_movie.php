<?php
session_start();
require_once 'classes/UpdateMovie.php';

$update_movie_obj = new UpdateMovie();
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

if ($movie_id <= 0) {
    $_SESSION['error_message'] = "Invalid movie ID!";
    header("Location: movie_list.php");
    exit;
}

$movie_details = $update_movie_obj->get_movie_by_id($movie_id);

if (!$movie_details) {
    $_SESSION['error_message'] = "Movie not found!";
    header("Location: movie_list.php");
    exit;
}

$movie = $movie_details;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs as needed
    $movie_name = $_POST['movie_name'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    // $update_movie_obj->update_movie($movie_id, $_POST);
    // header("Location: movie_list.php");
    // exit;

    // Update movie in database
    if ($update_movie_obj->update_movie($movie_id, $_POST)) {
        $_SESSION['success_message'] = "Movie updated successfully!";
        header("Location: movie_list.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Failed to update movie!";
        header("Location: movie_list.php");
        // Optionally, you can redirect back to edit form with error message
        // header("Location: edit_movie.php?movie_id=" . $movie_id);
        // exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <title>Update Movie</title>
</head>
<body>
    <div class="container">
        <h2>Update Movie</h2>
        <form action="edit_movie.php?movie_id=<?php echo $movie_id; ?>" method="POST">
            <div class="form-group">
                <label for="movie_name">Movie Name</label>
                <input type="text" class="form-control" id="movie_name" name="movie_name" value="<?php echo htmlspecialchars($movie['movie_name'], ENT_QUOTES); ?>" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" value="<?php echo htmlspecialchars($movie['genre'], ENT_QUOTES); ?>" required>
            </div>
            <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="date" class="form-control" id="release_date" name="release_date" value="<?php echo $movie['release_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Movie</button>
        </form>
    </div>
</body>
</html>
