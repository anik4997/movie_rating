<?php
require_once 'classes/AddMovie.php';
// Creating objects for model class and passing the super global variable $_POST
$add_movie = new AddMovie();
// Passing superglobal variable POST
if (isset($_POST['submit'])){
  $add_user = $add_movie->addmovie($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>Add Movie</title>
</head>
<body>
<form action="" method="post">
<div class="form-group">
    <label for="exampleInputEmail1">Movie Name</label>
    <input type="text" class="form-control" name="movie_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter movie name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Genre</label>
    <input type="text" class="form-control" name="genre" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Genre">
  </div>
  <div class="form-group">
    <label for="startDate">Movie release date</label>
    <input id="startDate" class="form-control" name="release_date" type="date" />
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Add</button>
</form>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>