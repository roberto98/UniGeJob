<?php
session_start();
require_once('../db/mysql_credentials.php');

$email = $_SESSION['SESS_EMAIL'];

$first_name = mysqli_real_escape_string($con, trim($_POST['firstname']));
$last_name = mysqli_real_escape_string($con, trim($_POST['lastname']));
$sesso =  mysqli_real_escape_string($con, trim($_POST['sesso']));
$birthday =  mysqli_real_escape_string($con, trim($_POST['birthday']));
$address =  mysqli_real_escape_string($con, trim($_POST['address']));
$city =  mysqli_real_escape_string($con, trim($_POST['city']));
$state =  mysqli_real_escape_string($con, trim($_POST['state']));

function update_user($email, $first_name, $last_name, $sesso, $birthday, $address, $city, $state, $con) {
    $toupdate = "UPDATE users SET first_name = '$first_name', last_name='$last_name', sesso='$sesso', birthday='$birthday', address='$address', city='$city', state='$state' WHERE email = '$email'";

    $update_profile = mysqli_query($con,$toupdate);
    // Return if the update was successful
    return ($update_profile);
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $sesso, $birthday, $address, $city, $state, $con);

$prev = $_SERVER['HTTP_REFERER'];

if ($successful) {
  $_SESSION['UpdateProf'] = "Salvataggio riuscito";
  header("Location: $prev");
} else {
  // Error message
  $_SESSION['UpdateProfErr'] = "Salvataggio non riuscito";
  header("Location: $prev");
}

?>
