<?php session_start(); ?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title> Mail inviata </title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar. Lo tengo qui perchè da desktop non ci sta navbar ma icone socials si -->

</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_2.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_2.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container center">
		<br>
		<br>
		<h1 class="wordwrap" style="font-size:30px;"> Abbiamo inviato un'email a <b><?php echo wordwrap($_GET['email'], 20, "\n", true); ?></b> </h1>
		<br>
		<p class="note wordwrap" style="font-size: 20px;">
		   Per favore accedi alla tua casella di posta e clicca sul link che ti abbiamo mandato per reimpostare la password
		</p>
</div>
<br>
<br>
<br>
<?php
include('footer.php');
include('navbar.php');
?>

</body>
</html>
