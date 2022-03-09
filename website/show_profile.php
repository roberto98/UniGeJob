<?php
session_start();
require_once('db/mysql_credentials.php');

// Get profile data from database (check current session)
 if (isset($_SESSION['SESS_EMAIL'])) {

    $email = $_SESSION['SESS_EMAIL'];
    $user_data= "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con,$user_data) or die (mysql_error());
    $row=mysqli_fetch_array($res);

    /*Prelevo l'identificativo dell'utente */
    $first_name=$row['first_name'];
    $last_name=$row['last_name'];
    $sesso =  $row['sesso'];
    $birthday = $row['birthday'];
    $address =  $row['address'];
    $city =  $row['city'];
    $state =  $row['state'];

    include('php/display_image.php');
?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title> Informazioni personali </title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e nav bar... sono tutti i css  -->

  <link rel="stylesheet" type="text/css" href="css/Infield_Top_Aligned_Form_Labels.css" />

</head>

<body>

    <a href="index.php"><img src="immagini/loghi/logo_blu_desktop_1.png" alt="Logo blu versione desktop" class="center image2"></a>
    <a href="index.php"><img src="immagini/loghi/logo_blu_mobile_1.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container contents">
		<h1>Informazioni Personali</h1>
    <br>
    <form method="post" action="php/store_image.php" enctype='multipart/form-data'>
     <div class="center">
          		    <img   class="img_profilo" src="<?php echo $image_src;  ?>"/>  <!-- C'erano queste classi bootstrap che direi non servono: rounded-circle z-depth-1-half avatar-pic  -->
                  <br><br>
                  <input type="file" class="change_photo" id="img_file" name="file" accept=".jpeg, .jpg, .png, .gif" onchange="this.form.submit()"/> <!-- input modificato solo per i files-->
                  <label class="label_cambiafoto" for="img_file">CAMBIA FOTO</label> <!-- Aggiunta nel css sottolineatura in hover -->

    </form>

    <p class="errorLog"><?php if(isset($_SESSION['UpdateProfErr'])){
                                    echo htmlspecialchars($_SESSION['UpdateProfErr'], ENT_QUOTES);
                                    unset($_SESSION['UpdateProfErr']);}?>
   </p>
   <p class="success_msg"><?php if(isset($_SESSION['UpdateProf'])){
                                  echo htmlspecialchars($_SESSION['UpdateProf'], ENT_QUOTES);
                                  unset($_SESSION['UpdateProf']);}?>
  </p>
    </div>
		<form method="post" action="php/update_profile.php">
        <ul class="ul_infield">
                <div class="row"> <!-- Prima riga -->
                    <div class="col-sm">	<!-- Prima colonna -->
                    				<li class="li_infield">
                    						<input class="input_infield" type="text" name="firstname" value="<?php echo $first_name?>" />
                    						<label class="label_infield">Nome</label>
                    				</li>
                    </div>
                    <div class="col-sm"> <!-- Seconda colonna -->
                       				<li class="li_infield">
                      						<input class="input_infield" type="text" name="lastname" value="<?php echo $last_name?>"/>
                      						<label class="label_infield">Cognome</label>
                      				</li>
                    </div>
                </div>

                <div class="row"> <!-- Seconda riga -->
                  <div class="col-sm">	<!-- Prima colonna -->
                      <li class="li_infield">
                        <select  class="input_infield" name="sesso">
                          <option <?php if($sesso == 'Non specificare'){echo("selected");}?>>Non specificare</option>
                          <option <?php if($sesso == 'Uomo'){echo("selected");}?>>Uomo</option>
                          <option <?php if($sesso == 'Donna'){echo("selected");}?>>Donna</option>
                        </select>
                        <label class="label_infield" >Sesso</label>
                      </li>
                  </div>
                  <div class="col-sm">	<!-- Seconda colonna -->
                      <li class="li_infield">
                          <input class="input_infield" type="date" name="birthday" value="<?php echo $birthday?>"/>
                          <label class="label_infield" >Data di nascita</label>
                      </li>
                  </div>
                </div>

              <div class="row">
                <div class="col-sm">	<!-- Prima colonna -->
                    <li class="li_infield">
                        <input class="input_infield" type="text" name="address" value="<?php echo $address?>"/>
                        <label class="label_infield" >Indirizzo</label>
                    </li>
                </div>
                <div class="col-sm">	<!-- Seconda colonna -->
                    <li class="li_infield">
                        <select class="input_infield" name="city" value="<?php echo $city?>">
                          <option <?php if($city == 'Nessuno'){echo("selected");}?>>Nessuno</option>
                          <option <?php if($city == 'Genova'){echo("selected");}?>>Genova</option>
                        </select>
                        <label class="label_infield" >Città</label>
                    </li>
                </div>
                <div class="col-sm">	<!-- Terza colonna -->
                      <li class="li_infield">
                          <select class="input_infield" name="state" value="<?php echo $state?>">
                            <option <?php if($state == 'Nessuno'){echo("selected");}?>>Nessuno</option>
                            <option <?php if($state == 'Italia'){echo("selected");}?>>Italia</option>
                          </select>
                          <label  class="label_infield" >Stato</label>
                      </li>
                </div>
              </div>

              <li class="li_infield">
                <input class="input_infield cant_be_modify" type="email" readonly value="<?php echo $email ?>">
                  <label class="label_infield">Email</label>
              </li>
        </ul>
        <br>
              <div class="center contents">
                  <button type="submit" name="update_profile"> Conferma </button>
              </div>
	 </form>
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
