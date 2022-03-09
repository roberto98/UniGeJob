<?php
session_start();

require_once('../db/mysql_credentials.php');

if(isset($_POST))
{
  		// Sanitizing SQL
  		$first_name=mysqli_real_escape_string($con, trim($_POST['firstname']));
  		$last_name=mysqli_real_escape_string($con, trim($_POST['lastname']));
      $birthday=mysqli_real_escape_string($con, trim($_POST['birthday']));

  		$email=strtolower(mysqli_real_escape_string($con, trim($_POST['email'])));
  		$password=mysqli_real_escape_string($con, trim($_POST['pass']));
      $password_confirm=mysqli_real_escape_string($con, trim($_POST['confirm']));


      if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$email)){
        $_SESSION['WrongMail'] = "Email non corretta";
        header("Location: ../registration_form.php");
        exit();
      }

function insert_user($email, $first_name, $last_name, $birthday, $password, $password_confirm, $con) {
  if($password!=$password_confirm) {
    $_SESSION['SigninErr'] = "Le password non corrispondono";
    return false;
  }

  $hashedpassword = password_hash($password, PASSWORD_BCRYPT); // let the salt be automatically generated

  if(empty($birthday))
	$birthday="1800-01-01";
  $toinsert = "INSERT INTO users (first_name, last_name, birthday, email, hashedpassword) VALUES( '$first_name', '$last_name', '$birthday', '$email', '$hashedpassword')";
  $result = mysqli_query($con, $toinsert);

  if(!$result) {
  $_SESSION['SigninErr'] = "Email già esistente";
  return false;
  }
  return true;
}

// Get user from login
$successful = insert_user($email, $first_name, $last_name, $birthday, $password, $password_confirm, $con);

  if ($successful) {
      // Success message
      $_SESSION['SigninOk'] = "Registrazione avvenuta con successo";
      header("Location: ../login_form.php");
      exit();
  } else {
      // Error message
      header("Location: ../registration_form.php");
      exit();
  }

} /* Chiude if isset */
?>
