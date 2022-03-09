<?php
session_start();
require_once('../db/mysql_credentials.php');

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($con, $_POST['new_pass_c']);

  // Grab to token that came from the email link
  $token = $_POST['new_password'];
  if($new_pass!=$new_pass_c) {
      $_SESSION['PassNotEquals'] = "Le password non corrispondono";
      $prev = $_SERVER['HTTP_REFERER'];
      header("Location: $prev");
      exit(); // Devo uscire dallo script per non fargli aggiornare comunque la password
  }
    // select email address of user from the password_reset table
    $sql = "SELECT * FROM password_resets WHERE token = '$token'";
    $results = mysqli_query($con, $sql);

    if(mysqli_num_rows($results) == 1) {
    	$row = mysqli_fetch_array($results);
    	$email = $row['email'];
    } else {    $email = false;  }
    if ($email) {
      $new_pass = password_hash($new_pass, PASSWORD_BCRYPT);
      $sql = "UPDATE users SET hashedpassword='$new_pass' WHERE email='$email'";
      $results = mysqli_query($con, $sql);
      header('Location: ../login_form.php');
    } else {
      header('Location: ../registration_form.php');
    }
  }


  ?>
