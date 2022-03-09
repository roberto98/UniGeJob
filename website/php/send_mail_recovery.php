<?php
// https://codewithawa.com/posts/password-reset-system-in-php
session_start();

// connect to database
require_once('../db/mysql_credentials.php');
include("../phpmailer/class.phpmailer.php");
include("../phpmailer/class.smtp.php");
include("../phpmailer/PHPMailerAutoload.php");

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset_password'])) {
  $email = mysqli_real_escape_string($con, trim($_POST['email']));
  // ensure that the user exists on our system
  $query = "SELECT email FROM users WHERE email='$email'";
  $results = mysqli_query($con, $query);

  if(mysqli_num_rows($results) <= 0) {
    // Error message
    $_SESSION['NoMail'] = "Non esistono utenti con questa mail";
    $prev = $_SERVER['HTTP_REFERER'];
    header("Location: $prev");
    exit(); // Devo uscire dallo script per evitare che prosegui e mandi la mail
  }

  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($con, $sql);

    // Send email to user with the token in a link they can click on
    $mittente = "uniGejobs@gmail.com";
    $nomemittente = "Recupero password di UniGejobs";
    $ServerSMTP = "smtp.gmail.com";  //server SMTP
    $destinatario = $email;
    $oggetto_messaggio = "Resetta la password su UniGejob";
    $corpo_messaggio = 'Ciao, clicca su questo <a href="https://webdev19.dibris.unige.it/~S4486648/new_pass.php?token='.$token.'">link</a> per resettare la password sul sito di UniGejob';
    $corpo_messaggio = wordwrap($corpo_messaggio,70);

    $messaggio = new PHPMailer;
    $messaggio->IsSMTP();
    $messaggio->Port = 587;

    $messaggio->SMTPAuth = true;
    $messaggio->Username = 'uniGejobs@gmail.com';
    $messaggio->Password = 'uniGejobs#98';  // Non importa se la vedete, è account fittizio
    $messaggio->isHTML(true);
    $messaggio->SMTPKeepAlive = "true";
    $messaggio->Host  = $ServerSMTP;
    $messaggio->From   = $mittente;
    $messaggio->FromName = $nomemittente;
    $messaggio->AddAddress($destinatario);
    $messaggio->Subject = $oggetto_messaggio;
    $messaggio->Body = $corpo_messaggio;

    if(!$messaggio->Send()) {
      $_SESSION['TokenNotSent'] = "Siamo spiacenti ma non siamo riuscirti a mandarti la email di recupero";
      $prev = $_SERVER['HTTP_REFERER'];
      header("Location: $prev");
    } else {
      header('Location: ../pending.php?email=' . $email);
    }
}


?>
