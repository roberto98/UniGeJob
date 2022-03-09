<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title> Cambia password </title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar. Lo tengo qui perchè da desktop non ci sta navbar ma icone socials si -->
  <link rel="stylesheet" type="text/css" href="css/Infield_Top_Aligned_Form_Labels.css" />
	<script  src="js/check_input.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_2.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_2.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container">


		<form action="php/pw_reset.php" method="POST" onsubmit="return check_input_ChangePW();">
			<div class="center contents">

            		<ul class="ul_infield" style="width:100%;">
										<h1 style="text-align: left;">Nuova Password</h1>
										<br>

										<p class="wordwrap" style="text-align: left;">
											Inserisci la tua nuova password
										</p>
            				<li class="li_infield">
            						<input class="input_infield" type="password" id="pass" name="new_pass" />
            						<label class="label_infield">Password</label>
            				</li>
                    <li class="li_infield">
                        <input class="input_infield" type="password" id="confirm" name="new_pass_c" />
                        <label class="label_infield">Conferma Password</label>
                    </li>
                </ul>

								<button type="submit" name = "new_password" value='<?php echo $_GET["token"]?>'> Entra </button>
			</form>

						<p class="errorLog"><br><?php if(isset($_SESSION['PassNotEquals'])){		// Messaaggio di errore in caso di credenziali non corrette
																						echo htmlspecialchars($_SESSION['PassNotEquals'], ENT_QUOTES);
																						unset($_SESSION['PassNotEquals']);}?>
						</p>

			</div>

</div>

<?php
include('footer.php');
include('navbar.php');
?>

</body>
</html>
