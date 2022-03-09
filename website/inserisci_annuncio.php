<?php
session_start();

if (isset($_SESSION['SESS_EMAIL'])) {

//$email = $_SESSION['SESS_EMAIL'];

 ?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title>Inserisci annuncio</title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar -->

	<link rel="stylesheet" type="text/css" href="css/Infield_Top_Aligned_Form_Labels.css" />
	<link rel="stylesheet" type="text/css" href="css/drag_drop_upload.css" />
</head>

<body>

<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_1.png" alt="Logo blu versione desktop" class="center image2"></a>
<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_1.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container contents">
	<h1>Pubblica</h1>

<form action="php/store_annuncio.php" method="POST"  enctype='multipart/form-data'>
	<ul class="ul_infield">

											<li class="li_infield">
													<input class="input_infield" type="text" name="title" required/>
													<label class="label_infield">Titolo *</label>
											</li>

											<li class="li_infield">
													<textarea class="input_infield" name="description" required/></textarea>
													<label class="label_infield">Descrizione *</label>
											</li>
											<br>

				      	     <!-- DRAG AND DROP delle foto -->
			              <div class="form-group files">
			                <input type="file" name="foto_annuncio" class="form-control input_infield" title="   " accept=".jpeg, .jpg, .png, .gif" multiple="">
											<label class="label_infield">Carica una foto</label>

			              </div>




					<div class="row"> <!-- Seconda riga -->
						<div class="col-sm">	<!-- Prima colonna -->
								<li class="li_infield">
									<select  class="input_infield" name="priv_azienda" required>
										<option>Privato</option>
										<option>Azienda</option>
									</select>
									<label class="label_infield">Sono un/una: *</label>
								</li>
						</div>
						<div class="col-sm">	<!-- Seconda colonna -->
								<li class="li_infield">
										<input class="input_infield" type="text" name="number" />
										<label class="label_infield">Numero di telefono</label>
								</li>
						</div>
					</div>
				<br>
				<div class="center">
						<button type="submit"> Conferma </button>
				</div>
	</ul>
 </form>

</div>

<?php
include('footer.php');
include('navbar.php');
?>

</body>
</html>


<?php
} else {
          header("Location: login_form.php");
}
?>
