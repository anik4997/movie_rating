<?php
require_once 'classes/Ratings.php';
require_once 'classes/FetchMovie.php';
require_once 'classes/Search.php';

// Creating objects for rating class and search class
$Ratings_obj = new Ratings();
$search_obj = new Search();

// Check if search form is submitted
$search_result = null;
if (isset($_POST['search'])) {
    $search_result = $search_obj->movie_search($_POST);
}

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
            <form action="movie_list_guest.php" class="mb-5 search_form d-flex justify-content-end" method="post">
                <input type="text" class="form-control search_field" name="search_input" placeholder="search">
                <button type="submit" class="btn btn-dark" name="search">Search</button>
            </form>
        </div>
    </div>
    
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
                $movies = [];
                if ($search_result) {
                    // Fetch data from search results
                    while ($row = mysqli_fetch_assoc($search_result)) {
                        $movies[] = $row;
                    }
                } else {
                    // Fetch all movies if no search input
                    $fetch_movie_obj = new FetchMovie();
                    $show_movie = $fetch_movie_obj->show_movie();
                    if ($show_movie) {
                        while($row = mysqli_fetch_assoc($show_movie)){
                            $movies[] = $row;
                        }
                    }
                }

                if (!empty($movies)) {
                    $sl_no = 0;
                    foreach ($movies as $row) {
                        $sl_no++;
                        // Get average rating for each movie
                        $avg_data = $Ratings_obj->get_average_rating($row['id']);
                        $avg_rating = $avg_data['average_rating'];
                        $rating_count = $avg_data['rating_count'];
            ?>
                <tr>
                    <th scope="row"><?php echo $sl_no;?></th>
                    <td><?php echo $row['movie_name'];?></td>
                    <td><?php echo $row['genre'];?></td>
                    <td><?php echo $row['release_date'];?></td>
                    <td><?php echo number_format($avg_rating, 2)."*({$rating_count})"; ?></td>
                    <td>
                        <input type="number" class="form-control custom_select" name="rating" placeholder="Rating" min="0" max="5" step="0.1">
                        <a href="#" class="btn btn-success" onclick="login_alert(event)">Submit rating</a>
                        <script>
                            function login_alert(event) {
                                event.preventDefault(); 
                                alert("You must login to perform this action");
                            }
                        </script>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No movies found</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="index.php"><button type="submit" class="btn btn-primary">Login</button></a>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>
