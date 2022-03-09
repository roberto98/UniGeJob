<?php
// Come rendere il sito sicuro:
// // https://www.targetweb.it/script-login-utente-in-php-e-mysql-sicuro/

require_once('../db/mysql_credentials.php');
session_start();

if(!isset($_POST)) {
  header("Location: ../registration_form.php");
  exit();
}
// Password inserita dall'utente nel login senza spazi + Igienizzazione SQL
$email=strtolower(mysqli_real_escape_string($con, trim($_POST['email'])));
$password=mysqli_real_escape_string($con, trim($_POST['pass']));

if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$email)){
  $_SESSION['WrongMail'] = "Email non corretta";
  header("Location: ../login_form.php");
  exit();
}

function login($email, $password, $con) {
  $toselect = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($con,$toselect);
  if(mysqli_num_rows($result) != 1)
    return false;

  $row = mysqli_fetch_array($result);
  $hash = $row['hashedpassword'];
  $ok = password_verify($password, $hash);
  if($ok) {
    //session_regenerate_id(); //  Update the current session id with a newly generated one
    $_SESSION['SESS_MEMBER_ID'] = $row['id'];
    $_SESSION['SESS_EMAIL'] = $row['email'];
    $_SESSION['SESS_FIRST_NAME'] = $row['first_name'];
    $_SESSION['SESS_LAST_NAME'] = $row['last_name'];
    return true;
  }
  return false;
}

$user = login($email, $password, $con);

if ($user) {
  header("Location: ../index.php");
  exit();
} else {
  // Error message
  $_SESSION['SignUpErr'] = "Credenziali errate";
  header("Location: ../login_form.php");
  exit();
}


?>
