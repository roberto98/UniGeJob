<?php
session_start();
require_once('../db/mysql_credentials.php');
// https://makitweb.com/upload-and-store-an-image-in-the-database-with-php/

if (isset($_SESSION['SESS_EMAIL'])) {

    $email = $_SESSION['SESS_EMAIL'];
    $name = $_FILES['file']['name']; //Con il primo campo prendo il name dell'input e con il secondo il nome del file
    $target_dir = "../immagini/foto_profilo/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

       // Update record
       $query = "UPDATE users SET foto_profilo='$name' WHERE email='$email'";
       mysqli_query($con,$query);

       // Upload file
       move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

    } else {
      header("Location: errore.php");
    }
  header("Location: ../show_profile.php");
}
else {
  header("Location: errore.php");
}
?>

<?php
