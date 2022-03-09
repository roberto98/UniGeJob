<?php
session_start();
require_once('../db/mysql_credentials.php');

if (isset($_GET['id']) && isset($_SESSION['SESS_EMAIL'])) {
    $id = mysqli_real_escape_string($con, (int) $_GET['id']);
    $sql = "DELETE FROM annunci WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header('Location: ../index.php?ord=id');
    } else {
        header("Location: ../index.php?ord=id");
    }
}

?>
