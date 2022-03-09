<?php

$mysql_host = "localhost";

$mysql_user = "user";
$mysql_pass = "";
$mysql_db = "db";

// Creating a connection
$con=mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("Unable to connect");

if (mysqli_connect_errno($con)) {   // Check connection
  die("Failed to connect to MySQL: " . mysqli_connect_error($con));
}













?>
