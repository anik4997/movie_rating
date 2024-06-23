<?php
 session_start();
require_once 'classes/Ratings.php';
require_once 'classes/Search.php';
$Ratings_obj = new Ratings();
$search_obj = new Search();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if (isset($_POST['search'])) {
    // Call movie_search method with the search input
    $search_result = $search_obj->movie_search($_POST);
}
// Passing superglobal variable POST
if (isset($_POST['submit_rating'])){
    // $add_rating = $search_obj->movie_rating($_POST);
    $_POST['user_id'] = $user_id; 
    $add_rating = $Ratings_obj->movie_rating($_POST);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>List of searched movies</title>
</head>
<body>
    <h1>Search results:</h1>
    
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sl no</th>
                <th scope="col">Name</th>
                <th scope="col">Genre</th>
                <th scope="col">Release date</th>
                <th scope="col">Avg rating</th>
                <th scope="col">Add rating</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are search results
            if (isset($search_result)) {
                if ($search_result) {
                    $sl_no = 0;
                    // Fetching data from search results
                    while ($row = mysqli_fetch_assoc($search_result)) {
                        $sl_no++;
                        // Get average rating for each movie
                        $avg_data = $Ratings_obj->get_average_rating($row['id']);
                        $avg_rating = $avg_data['average_rating'];
                        $rating_count = $avg_data['rating_count'];
            ?>
                        <form method="post" action="">
                            <tr>
                                <th scope="row"><?php echo $sl_no; ?></th>
                                <td><?php echo $row['movie_name']; ?></td>
                                <td><?php echo $row['genre']; ?></td>
                                <td><?php echo $row['release_date']; ?></td>
                                <td><?php echo number_format($avg_rating, 2)."*({$rating_count})"; ?></td>
                                <td>
                                    <input type="hidden" name="movie_name" value="<?php echo $row['movie_name']; ?>">
                                    <input type="number" class="form-control custom_select" name="rating" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Rating" min="0" max="5">
                                    <button type="submit" class="btn btn-success" name="submit_rating">Submit rating</button>
                                </td>
                            </tr>
                        </form>
            <?php
                    }
                } else {
                    // No search results
                    echo "<tr><td colspan='6'>No results found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
