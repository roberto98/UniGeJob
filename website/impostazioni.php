
<?php
session_start();
require_once('db/mysql_credentials.php');

if (isset($_SESSION['SESS_EMAIL'])) {

   $email = $_SESSION['SESS_EMAIL'];
?>

<!DOCTYPE html>
<html lang="it">	<!-- https://internetingishard.com/html-and-css/responsive-design/ DA SEGUIRE SPIEGA BENISSIMO -->
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">

	<title>Impostazioni</title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar -->
  <link rel="stylesheet" type="text/css" href="css/Infield_Top_Aligned_Form_Labels.css" />
  <script  src="js/check_input.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

      <a href="index.php"><img src="immagini/loghi/logo_blu_desktop_2.png" alt="Logo blu versione desktop" class="center image2"></a>
      <a href="index.php"><img src="immagini/loghi/logo_blu_mobile_2.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container contents">
    <h1>Impostazioni</h1>
    <div class="center">
      <p class="errorLog"><br><?php if(isset($_SESSION['PassNotEquals'])){
                                      echo htmlspecialchars($_SESSION['PassNotEquals'], ENT_QUOTES);
                                      unset($_SESSION['PassNotEquals']);}

                                    if(isset($_SESSION['UpdatePassErr'])){
                                      echo htmlspecialchars($_SESSION['UpdatePassErr'], ENT_QUOTES);
                                      unset($_SESSION['UpdatePassErr']);}

                                    if(isset($_SESSION['EmptyPass'])){
                                      echo htmlspecialchars($_SESSION['EmptyPass'], ENT_QUOTES);
                                      unset($_SESSION['EmptyPass']);}
                                      ?>
     </p>
     <p class="success_msg"><br><?php if(isset($_SESSION['UpdatePass'])){
                                    echo htmlspecialchars($_SESSION['UpdatePass'], ENT_QUOTES);
                                    unset($_SESSION['UpdatePass']);}?>
    </p>

        <ul class="ul_infield">
            <li class="li_infield">
              <input class="input_infield cant_be_modify" type="email" readonly value="<?php echo $email ?>">
                <label class="label_infield">Email</label>
            </li>

  	     <form action="php/change_pass.php" method="POST"  onsubmit="return check_input_ChangePW();">
          <div class="row">
            <div class="col-sm">	<!-- Prima colonna -->
                <li class="li_infield">
                    <input class="input_infield" type="password" id="pass" name="pass" placeholder="Almeno di 8 caratteri" />
                    <label class="label_infield">Cambia Password</label>	<!-- Regex presa da qui: https://www.thepolyglotdeveloper.com/2015/05/use-regex-to-test-password-strength-in-javascript/ -->
                </li>
            </div>
            <div class="col-sm">	<!-- Seconda colonna -->
                <li class="li_infield">
                    <input class="input_infield" type="password" id="confirm" name="confirm" />
                    <label class="label_infield">Conferma Password</label>
                </li>
            </div>
          </div>
          <br>
          <br>
            <button type="submit"> Salva </button>
        </form>
      </ul>
  </div>
</div>


<br><br><br>
<?php
include('footer.php');
include('navbar.php');

} // Chiude isset
else {
  header("Location: registration_form.php");
}
?>

</body>
</html>
