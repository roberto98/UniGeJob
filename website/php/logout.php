<?php
require_once('../db/mysql_credentials.php');

  session_start();
//User session in ['user']
if($_SESSION['SESS_EMAIL']){
  session_unset();
  session_destroy();
  session_write_close();
  setcookie(session_name(),'',0,'/');   // Non so che faccia
//  session_regenerate_id(true);

  // echo $_SESSION['SESS_EMAIL'];
  header("Location: ../login_form.php");
}
?>
