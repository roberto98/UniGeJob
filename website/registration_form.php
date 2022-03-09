<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title> Registrazione </title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e nav bar... sono tutti i css  -->
	 <link rel="stylesheet" type="text/css" href="css/Infield_Top_Aligned_Form_Labels.css" />

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script  src="js/check_input.js"></script>
</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_1.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_1.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container">


	<!--<form action="registration.php" method="POST">-->
			<div class="center contents">

      		<ul class="ul_infield">
							<li>
								<h1 style="text-align: left;">Registrazione</h1>
							</li>

							<p class="errorLog"><br><?php if(isset($_SESSION['SigninErr'])){
																							echo htmlspecialchars($_SESSION['SigninErr'], ENT_QUOTES);
																							unset($_SESSION['SigninErr']);}

																						if(isset($_SESSION['WrongMail'])){
																							echo htmlspecialchars($_SESSION['WrongMail'], ENT_QUOTES);
																							unset($_SESSION['WrongMail']);}?>
							</p>
							<div id="display_all" class="errorLog"></div>
					<form action="php/registration.php" method="POST" onsubmit="return check_input_signin();">		<!-- Non metto nessun required così al submit se i campi son vuoti vengono modificati e fatti rossi ed i daati non vengono inviati -->
							<div class="row">
	 							<div class="col-sm">	<!-- Prima colonna -->
			      				<li class="li_infield">
			      						<input class="input_infield" type="text" id="firstname" name="firstname" />
			      						<label class="label_infield">Nome *</label>
			      				</li>
										<div id="display_firstname" class="errorLog"></div>
								</div>

								<div class="col-sm">
										<li class="li_infield">	<!-- Seconda colonna -->
												<input class="input_infield" type="text" id="lastname" name="lastname" />
												<label class="label_infield">Cognome *</label>
										</li>
										<div id="display_lastname" class="errorLog"></div>
								</div>
							</div>

							<li class="li_infield">
									<input class="input_infield" type="date" id="birthday" name="birthday"/> <!-- Edit 06/02: Non va max limit, non so perchè -->
									<label class="label_infield">Data di nascita</label>
							</li>
							<li class="li_infield">
									<input class="input_infield" type="email" id="email" name="email" /> <!-- pattern="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i" -->
									<label class="label_infield">Email *</label>
							</li>
							<div id="display_email" class="errorLog"></div>

							<div class="row">
								<div class="col-sm">	<!-- Prima colonna -->
			      				<li class="li_infield">
			      						<input class="input_infield" type="password" id="pass" name="pass" placeholder="Almeno di 8 caratteri" />
			      						<label class="label_infield">Password *</label>	<!-- Regex presa da qui: https://www.thepolyglotdeveloper.com/2015/05/use-regex-to-test-password-strength-in-javascript/ -->
			      				</li>
										<div id="display_password" class="errorLog"></div>
								</div>
								<div class="col-sm">	<!-- Seconda colonna -->
										<li class="li_infield">
												<input class="input_infield" type="password" id="confirm" name="confirm" />
												<label class="label_infield">Conferma Password *</label>
										</li>
										<div id="display_confirm" class="errorLog"></div>
								</div>
							</div>

							<br>
							<li style="text-align:left;">
									<div class="custom-control custom-checkbox mb-3">
										<input type="checkbox" class="custom-control-input" id="contratto" name="contratto" value="false">
										<label class="custom-control-label" for="contratto">Accetta i <a href="#">termini</a> e le <a href="#">condizioni</a> * 		</label>
										<div id="display_contratto" class="errorLog"></div>
									</div>
							</li>
            </ul>

						<button type="submit"> Entra </button>
				</form>

						<p class="note"> Hai già un account? <br>
							<a href="login_form.php">Login</a> </p>
			</div>
</div>

<?php
include('footer.php');
include('navbar.php');
?>

</body>
</html>
