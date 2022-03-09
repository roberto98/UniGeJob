<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title>Cerca annunci</title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script  src="js/search_script.js"></script>
</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_3.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_3.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container">
  <div class="center">
			<h1> Cerca un annuncio </h1>
      <div class="center" style="padding-top:10px;">
				    <div class="form-group mb-4">
		          <input id="search" type="" placeholder="Cosa stai cercando?" class="form-control form-control-underlined border-primary" style="border-radius: 0px;">
		        </div>
		 	</div>
  </div>
        <div id="display"></div>
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
