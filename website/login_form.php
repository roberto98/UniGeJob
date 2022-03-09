<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title> Accedi </title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar. Lo tengo qui perchè da desktop non ci sta navbar ma icone socials si -->
  <link rel="stylesheet" type="text/css" href="css/Infield_Top_Aligned_Form_Labels.css" />

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script  src="js/check_input.js"></script>

</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_2.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_2.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container">


		<form action="php/login.php" method="POST" onsubmit="return check_input_signUp();">
			<div class="center contents">

				                		<ul class="ul_infield" style="width:100%;">
																<li>
																	<h1 style="text-align: left;">Login</h1>
																</li>
																<p class="errorLog"><br><?php if(isset($_SESSION['SignUpErr'])){
																																echo htmlspecialchars($_SESSION['SignUpErr'], ENT_QUOTES);
																																unset($_SESSION['SignUpErr']);}
																															if(isset($_SESSION['WrongMail'])){
																																echo htmlspecialchars($_SESSION['WrongMail'], ENT_QUOTES);
																																unset($_SESSION['WrongMail']);}?>
																</p>
																<p class="success_msg"><br><?php if(isset($_SESSION['SigninOk'])){
																																	echo htmlspecialchars($_SESSION['SigninOk'], ENT_QUOTES);
																																	unset($_SESSION['SigninOk']);}?>
																</p>
																<div id="display_all" class="errorLog"></div>

				                				<li class="li_infield">
				                						<input class="input_infield" type="email" id="email" name="email" />
				                						<label class="label_infield">Email *</label>
				                				</li>
																<div id="display_email" class="errorLog"></div>
				                				<li class="li_infield">
				                						<input class="input_infield" type="password" id="pass" name="pass" />
				                						<label class="label_infield">Password *</label>
				                				</li>
																<div id="display_password" class="errorLog"></div>
															<br>	<a href="enter_mail.php"><p class="note" style="text-align:left; color:#199bfc;"> Non ricordi la password?</p></a>
				                     </ul>


						<button type="submit"> Entra </button>
			</form>

						<p class="note"> Non hai ancora un account? <br>
						<a href="registration_form.php">Registrati</a> </p>
			</div>

</div>

<?php
include('footer.php');
include('navbar.php');
?>

</body>
</html>
