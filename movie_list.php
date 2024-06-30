<?php
session_start();
require_once 'classes/Ratings.php';
require_once 'classes/FetchMovie.php';
require_once 'classes/FetchUser.php';
require_once 'classes/Search.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

// Creating objects for rating class and passing the super global variable $_POST
$Ratings_obj = new Ratings();
$search_obj = new Search();

// Handle movie rating submission
if (isset($_POST['submit_rating'])){
    $_POST['user_id'] = $user_id;
    $add_user_rating = $Ratings_obj->movie_rating($_POST);
}

// Fetch the current user's role
$fetch_user_obj = new FetchUser();
$current_user = $fetch_user_obj->get_user_by_id($user_id);
$is_admin = $current_user['role'] == 1;

// Handle movie search
$search_result = null;
if (isset($_POST['search'])) {
    $search_result = $search_obj->movie_search($_POST);
}

// Fetch movies if no search result
$movies = $search_result ? $search_result : (new FetchMovie())->show_movie();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>List of movies</title>
</head>
<body>
    <div class="row">
        <div class="col-md-5">
            <h2 class="d-inline">List of movies:</h2>
        </div>
        <div class="col-md-7">
            <form action="movie_list.php" class="mb-5 search_form d-flex justify-content-end" method="post">
                <input type="text" class="form-control search_field" name="search_input" placeholder="search">
                <button type="submit" class="btn btn-dark" name="search">Search</button>
            </form>
        </div>
    </div>

    <?php if ($is_admin): ?>
        <h3>Welcome admin</h3>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
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
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($movies){
                    $sl_no = 0;
                    while($row = mysqli_fetch_assoc($movies)){
                        $sl_no++;
                        $avg_data = $Ratings_obj->get_average_rating($row['id']);
                        $avg_rating = $avg_data['average_rating'];
                        $rating_count = $avg_data['rating_count'];
            ?>
            <form method="post" action="movie_list.php">
                <tr>
                    <th scope="row"><?php echo $sl_no;?></th>
                    <td><?php echo $row['movie_name'];?></td>
                    <td><?php echo $row['genre'];?></td>
                    <td><?php echo $row['release_date'];?></td>
                    <td><?php echo number_format($avg_rating, 2)."*({$rating_count})"; ?></td>
                    <td>
                        <input type="hidden" name="movie_name" value="<?php echo $row['movie_name'];?>">
                        <input type="number" class="form-control custom_select" name="rating" placeholder="Rating" min="0" max="5" step="0.1">
                        <button type="submit" class="btn btn-success" name="submit_rating">Submit rating</button>
                    </td>
                    <td>
                    <?php if ($is_admin): ?>
                            <a href='edit_movie.php?movie_id=<?php echo $row['id'];?>' class="btn btn-warning">Edit</a>
                            <a href="delete_movie.php?movie_id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        <?php else: ?>
                            <a href='#' class="btn btn-warning" onclick="admin_alert(event)">Edit</a>
                            <a href='#' class="btn btn-danger" onclick="admin_alert(event)">Delete</a>
                            <script>
                                function admin_alert(event) {
                                    event.preventDefault();
                                    alert("You must be an admin to perform this action!");
                                }
                            </script>
                    <?php endif; ?>
                    </td>
                </tr>
            </form>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No movies found</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="add_movie.php"><button type="submit" class="btn btn-primary">Add movie</button></a>
    <a href="logout.php"><button type="submit" class="btn btn-danger">Logout</button></a>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
