<?php
session_start();
require_once('db/mysql_credentials.php');

if (isset($_SESSION['SESS_EMAIL'])) {

$email = $_SESSION['SESS_EMAIL'];

include('php/display_image.php');
?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title>Profilo</title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar -->
</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_1.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_1.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container">
	<h1 style="text-align: left">Profilo</h1>

		<div class="center contents">
				<img style class="img_profilo" src="<?php echo "$image_src";  ?>"/>

					<br><br>

					<div class="row">
							<div class="col-sm spaziatura_button"> <!-- Griglia composta da 12 colonne, vogliamo usarle tutte per il primo pulsante -->
									<a href="show_profile.php" class="button_link"><button type="button" class="btn btn-primary btn-lg btn-block"><i class="far fa-user"></i> Informazioni personali </button></a>
							</div>
							<div class="col-sm spaziatura_button">
									<a href="show_profile.php" class="button_link"><button type="button" class="btn btn-primary btn-lg btn-block"><i class="far fa-file-alt"></i> CV online </button></a>
							</div>
					</div>
					<div class="row">
							<div class="col-sm spaziatura_button">
									<a href="show_profile.php" class="button_link"><button type="button" class="btn btn-primary btn-lg btn-block"><i class="far fa-heart"></i> Preferiti </button></a>
							</div>
							<div class="col-sm spaziatura_button">
									<a href="impostazioni.php" class="button_link"><button type="button"	class="btn btn-primary btn-lg btn-block"><i class="fa fa-cog"></i> Impostazioni </button></a>
							</div>
					</div>

					<div class="row">
						<div class="col-sm spaziatura_button">
							<a href="php/logout.php" class="button_link"><button type="button" class="btn btn-primary btn-lg btn-block"><i class="fas fa-sign-out-alt"></i> Logout </button></a>
						</div>
					</div>
		</div>
</div>

		<br><br>
		<?php
		include('footer.php');
		include('navbar.php');
		?>

</body>
</html>

<?php
} else {
          header("location: login_form.php");
}
?>
