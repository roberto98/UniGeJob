<?php
session_start();
require_once('db/mysql_credentials.php');

$id = (INT)$_GET['id']; //salvo id dell'annuncio cliccato

if ($id < 1) {
   header("location: index.php");
}

$sql = "SELECT * FROM annunci WHERE id = '$id'";
$result = mysqli_query($con, $sql);

$invalid = mysqli_num_rows($result);
if ($invalid == 0) {
    header("location: index.php");
}
// ----------------- Salvo dati annunci da tabella annunci ----------- //
$row = mysqli_fetch_assoc($result);

$id = htmlentities($row['id']);
$author_mail = htmlentities($row['email']);
$title = htmlentities($row['title']);
$des = htmlentities($row['description']);
$by = htmlentities($row['email']);
$img = htmlentities($row['immagine']);
$number = htmlentities($row['num_cell']);

$time = substr(htmlentities($row['insert_date']), 0, 10);
$date = explode('-', $time);
$year = $date[0];   $month = $date[1];    $day = $date[2];

// ----------------- Salvo dati autore da tabella users ----------- //
$user_query = "SELECT * FROM users WHERE email='$author_mail'";
$user_res = mysqli_query($con, $user_query);
$user_row = mysqli_fetch_assoc($user_res);

$user_mail = htmlentities($user_row['email']);
$user_first_name = htmlentities($user_row['first_name']);
$user_last_name = htmlentities($user_row['last_name']);
$user_address = htmlentities($user_row['address']);
$user_city = htmlentities($user_row['city']);
$user_foto_profilo = htmlentities($user_row['foto_profilo']);

?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<title>Mostra annuncio</title>
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

<div class="container contents word_wrap">  <!-- ******************* Annuncio ***************** -->
      <h1><?php echo "$title"; ?> </h1>
      <br>
      <div class="row">

        <div class="wrap_responsive">
          <img src="immagini/foto_annunci/<?php echo $img; ?>" alt="Foto annuncio" class="image_view_annunci">
        </div>
        <div class="col">
      <p><?php echo "$des"; ?></p>
      <br>
      <div class="note"><p> Scritto il <?php echo "$day-$month-$year"; ?> </p></div>
    </div></div>
      <?php   // ----------------------------- Poter modificare o cancellare il post ------------------ //
        $owner_query = "SELECT email FROM annunci WHERE id='$id'";
        $owner_res = mysqli_query($con, $owner_query);
        $owner_row = mysqli_fetch_assoc($owner_res);
        $owner_email = $owner_row['email'];


      if(isset($_SESSION['SESS_EMAIL'])) {

        $email = $_SESSION['SESS_EMAIL'];
        if($email == $owner_email)  {   // Se il creatore del post sono io che lo sto guardando allora...
        ?>
            <div class="subtitle">
              Hai creato te il post dunque puoi:
            </div>
            &emsp; <a href="edit_annuncio.php?id=<?php echo $id; ?>">[Edit]</a>

            &emsp; <a href="php/delete_annuncio.php?id=<?php echo $id; ?>" onclick="return confirm('Sei sicuro di voler cancellare questo post?'); ">[Delete]</a>
          <?php  } } // Chiude if ?>

      <br><br>
      <div class="row subtitle">  <!-- ******************** Informazioni autore ********************* -->
          Contatti:
      </div>
      <br>
      <div class="row">
              <img src="immagini/foto_profilo/<?php echo "$user_foto_profilo"; ?>" alt="Foto profilo autore" class="img_author">

                <p> <?php echo "&emsp; $user_first_name    $user_last_name"; ?>
                    <br>
                    <?php echo "&emsp; $user_city"; ?>
                    <br>
                    <?php echo "&emsp; $user_mail"; ?>
                    <br>
                    <?php echo "&emsp; $number"; ?>
               </p>
       </div> <!-- Chiude row -->
</div> <!-- Chiude container -->


<br><br><br>
<?php
include('footer.php');
include('navbar.php');
?>

</body>
</html>
