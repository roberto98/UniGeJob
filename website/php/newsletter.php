<?php
// https://www.hostingsolutions.it/guide/phpmailer.php    Sito italiano che spiega
session_start();
require_once('../db/mysql_credentials.php');

  include("../phpmailer/class.phpmailer.php");
  include("../phpmailer/class.smtp.php");
  include("../phpmailer/PHPMailerAutoload.php");


if(isset($_POST['newsletter']))
{
  // Password inserita dall'utente nel login senza spazi + Igienizzazione SQL
  $email=mysqli_real_escape_string($con, trim($_POST['newsletter']));
  
  $mittente = "uniGejobs@gmail.com";
  $nomemittente = "Newsletter di UniGejobs";
 //$destinatario = $_SESSION['SESS_EMAIL']; //prendiamola dal form
  $destinatario = $email;
  $ServerSMTP = "smtp.gmail.com";  //server SMTP
  $oggetto_messaggio ="Iscrizione newsletter UniGeJobs";
  $corpo_messaggio = "Grazie per esserti iscritto alla nostra newsletter \n Saluti, \n Il team UniGeJob.";

  $messaggio = new PHPMailer; // Su AlterVista non è possibile usare PHPMailer, in quanto le porte usate da SMTP sono bloccate.

//  var_dump($messaggio);   //debug
  // utilizza la classe SMTP invece del comando mail() di php
  $messaggio->IsSMTP();
  $messaggio->Port = 587; //465 ssl // tls 587 // 25
  //$messaggio->SMTPSecure = "tsl"; // tls

  // used only when SMTP requires authentication
  $messaggio->SMTPAuth = true;
  $messaggio->Username = 'uniGejobs@gmail.com';
  $messaggio->Password = 'uniGejobs#98';  // Non importa se la vedete, è account fittizio

  $messaggio->SMTPKeepAlive = "true";
  $messaggio->Host  = $ServerSMTP;
  $messaggio->From   = $mittente;
  $messaggio->FromName = $nomemittente;
  $messaggio->AddAddress($destinatario);
  $messaggio->Subject = $oggetto_messaggio;
  $messaggio->Body = $corpo_messaggio;

  if(!$messaggio->Send()) {
      //echo "errore nella spedizione: ".$messaggio->ErrorInfo;
      echo "Siamo spiacenti ma sembra ci sia stato un errore! \n Riprova l'iscrizione alla newsletter, se il problema persiste contattaci.";
  } else {
      echo "<h1> Grazie dell'iscrizione alla newsletter! \n riceverai a breve una mail di conferma.</h1>";
  }
}
  /* PEr mandare newsletter a tutte le mail in db     -- https://stackoverflow.com/questions/11354194/php-mailer-sending-newsletter

  $sql = mysql_query("SELECT displayname,email FROM engine4_users2")or die(mysql_error());


  $debug = new SMTP();
  $debug->do_debug = 2;

  while ($record = mysql_fetch_array ($sql)) {
  $mail = new PHPGMailer();
  $mail->IsSMTP(); // telling the class to use SMTP
  $mail->Host = "mail.gmail.com"; // SMTP server
  $mail->Port = 26; //designated port, could be different, check your host    // ssl 465 // tls 587
  // $mail->SMTPSecure = "ssl"; // tls
  $mail->SMTPAuth = TRUE; //smtp authentication may be false, check your host
  $mail->Username = "username"; //username
  $mail->Password = "password"; //password

  $mail->From = "from@someone.com";
  $mail->FromName = "fromsomeone";

  $mail->AddBCC($record['email'], $record["displayname"]); //use bcc for hidden emails
  $mail->Subject = "$record["displayname"]";
  $mail->Body = "Your body";


              if(!$mail->Send())
              {
                 echo 'Message was not sent.';
                 echo 'Mailer error: ' . $mail->ErrorInfo;
              }
      // Clear all addresses and attachments for next loop
      $mail->ClearAddresses();
      $mail->ClearAttachments();
  }
*/
  ?>
