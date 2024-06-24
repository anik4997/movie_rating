<?php
require_once 'classes/Login.php';
session_start();
// Creating objects for model class and passing the super global variable $_POST
$validation = new Login();
if (isset($_POST['submit'])) {
  // Validate user credentials (you may have your own validation logic)
  $user_id = $validation->validation($_POST);
  
  if ($user_id) {
      // reCAPTCHA verification
      $recaptchaSecret = '6LcNDfopAAAAAHDF1qJ76t9DEsnupXmHkmA-BlOC';
      $recaptchaResponse = $_POST['g-recaptcha-response'];
      
      // Verify the reCAPTCHA response
      $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
      $responseKeys = json_decode($response, true);
      
      if (intval($responseKeys["success"]) !== 1) {
          echo "Please complete the reCAPTCHA.";
      } else {
          // reCAPTCHA verified successfully, store user ID in session and redirect
          $_SESSION['user_id'] = $user_id;
          header("Location: movie_list.php?user_id=$user_id");
          exit;
      }
  } else {
      echo "Wrong email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Include Google reCAPTCHA script -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Sign in</b> to rate a movie</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- google recaptcha -->
        <div class="g-recaptcha" data-sitekey="6LcNDfopAAAAAPSt0hfRSPa9Modg-eCiaS7zpzXF"></div>
        <div class="row justify-content-center">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-8">
            <button type="submit" class="btn btn-primary btn-block mt-2" name='submit'>Sign In</button>
          </div>
          <p class="mt-2">
            <a href="add_user.php" class="text-center">Register a new membership</a>
          </p>
          <p class="mt-2">
            <a href="movie_list_guest.php" class="text-center">Click to see the movie list</a>
          </p>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
