<?php
session_start();
require_once('../db/mysql_credentials.php');

if (isset($_SESSION['SESS_EMAIL'])) {
    $email = $_SESSION['SESS_EMAIL'];

    $pass = mysqli_real_escape_string($con, trim($_POST['pass']));
    $confirm = mysqli_real_escape_string($con, trim($_POST['confirm']));

    if(empty($_POST['pass'])){
      $_SESSION['EmptyPass'] = "Non puoi salvare una password vuota!";
      $prev = $_SERVER['HTTP_REFERER'];
      header("Location: $prev");
      exit();
    }

    if($pass == $confirm) {
        $new_pass = password_hash($pass, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET hashedpassword='$new_pass' WHERE email='$email'";
        $results = mysqli_query($con, $sql);
    } else {
        $_SESSION['PassNotEquals'] = "Le password non corrispondono";
        $prev = $_SERVER['HTTP_REFERER'];
        header("Location: $prev");
        exit();
    }

    $prev = $_SERVER['HTTP_REFERER'];
    if ($results) {
         $_SESSION['UpdatePass'] = "Salvataggio riuscito";
         header( "Location: $prev");
    } else {
        // Error message
        $_SESSION['UpdatePassErr'] = "Salvataggio non riuscito";
        header("Location: $prev");
    }


} else {  // Chiude isset
    header("location: ../login_form.php");
}


?>
