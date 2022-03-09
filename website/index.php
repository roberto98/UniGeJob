<?php

require_once('db/mysql_credentials.php');

  session_start();

// https://github.com/Philipinho/Simple-PHP-Blog
 ?>

<!DOCTYPE html>
<html lang="it">	<!-- https://internetingishard.com/html-and-css/responsive-design/ DA SEGUIRE SPIEGA BENISSIMO -->
<head>
	<!-- ***************** PARTE RESPONSIVE preso da https://dzone.com/articles/using-csshtml-make-responsive ********** -->
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">

  <!-- Serve per la ricerca ma bisgna approfondire, WARNING: campi generici -->
	<title>Home</title>
	<meta name="keywords" content="keywords here" />
	<meta name="author" content ="name and surname here" />
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="css/mystyle.css" />

	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="https://use.typekit.net/nyv3ogw.css"> 	<!-- Web kit adobe fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Icone social e navbar -->

	 <!-- Including jQuery is required.			Serve per la live search  -->

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <!-- Including our scripting file. -->
   <script  src="js/search_script.js"></script>

</head>

<body>

	<a href="index.php"><img src="immagini/loghi/logo_blu_desktop_3.png" alt="Logo blu versione desktop" class="center image2"></a>
	<a href="index.php"><img src="immagini/loghi/logo_blu_mobile_3.png" alt="Logo blu versione mobile" class="center image1"></a>

<div class="container">
			<h2> Trova il tuo lavoretto </h2>
			<p class ="contents" style="text-align: left;"> Qui puoi ricercare un lavoro che sia adatto alle tue esigenze e disponibilità da studente universitario. </p>

			<!-- Search form -->
			<div class="center" style="padding-top:10px;">
				  <div class="form-group mb-4">
		        <input id="search" type="" placeholder="Cosa stai cercando?" class="form-control form-control-underlined border-primary" style="border-radius: 0px;">
		      </div>
		 	</div>
			<!-- Suggestions will be displayed in below div. -->
			<div id="display"></div>
			<!-- Fine search form -->
			<br>

      <section id="annunci"></section>  <!-- Definisco sezione del sito così posso riportare direttamente qui con index.php?#annunci-->
			<p class="subtitle" style="text-align: left;">
				<i class="far fa-clock"></i></i> <a href='?ord=id' style="color: black;"> Più recenti </a>			&nbsp;&nbsp;&nbsp;
				<i class="fas fa-sort-alpha-down"></i> <a href='?ord=title' style="color: black;"> Ordine Alfabetico </a>
			</p>

			<?php
			// COUNT
			$sql = "SELECT COUNT(*) FROM annunci"; //Conto quanti annunci ci sono nel db
			$result = mysqli_query($con, $sql);
			$r = mysqli_fetch_row($result);  //Prendo la tupla contenente il numero annunci
			$numrows = $r[0];  // Gli passo quanti sono gli annunci contati

			$rowsperpage = 6;  // Corrisponde al numero di annunci in una pagina, prima di cambiarla
			$totalpages = ceil($numrows / $rowsperpage); // ceil approssima il numero all'intero più vicino per eccesso.. es: 5.1 diventa 6

      $page = 0; //  if the if statement returns false, $page would be an undefined variable.  <-- Quindi devo definirla prima
			if (isset($_GET['page']) && is_numeric($_GET['page'])) { //Numeric strings consist of optional sign, any number of digits, optional decimal part and optional exponential part. Thus +0123.45e6 is a valid numeric value.
			    $page = (INT)mysqli_real_escape_string($con, trim($_GET['page'])); // (INT) converte ad intero, non si sa mai
			}

			if ($page > $totalpages) {
			    $page = $totalpages;
			}

			if ($page < 1) {
			    $page = 1;
			}
			$offset = ($page - 1) * $rowsperpage;

      /* Prepare Query */
      $query = "SELECT * FROM annunci"; // Di default nella homepage compaiono gli annunci presi dal db dal basso verso l'alto, senza un ordine preciso
      $limit = " LIMIT $offset, $rowsperpage";  // Voglio tenere conto del limite altrimenti compaiono tutti gli annunci in una pagina sola
      $sql =$query.$limit;

      $ord = ""; //Nel caso fossi nella homepage, mi darebbe che ord non è definita
      if(isset($_GET["ord"])) {
      	$ord = mysqli_real_escape_string($con, $_GET["ord"]);                // Prendo dal get il valore attuale di ord che può essere id o title
          if($ord == "id")
              $sql = $query." ORDER BY $ord DESC".$limit;      // Ordino in base all'id e quindi metto sopra il più recente
          if($ord == "title")
      	      $sql = $query." ORDER BY $ord ASC".$limit;      // Ordine Alfabetico
      }

 // LIMIT serve per prendere solo x risultati, altrimenti  vengono presi tutti e messi nella stessa pagina
 // esempio: LIMIT 3, 5 -- Parte dal terzo risultato e prende i 5 a venire

			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) < 1) {
			    echo '<div class="center contents">Nessun annuncio disponibile</div>';
			}



			$count = 0;
			while ($row = mysqli_fetch_assoc($result)) {   // ------------------ Inizio ciclo WHILE ------------- //

			    $id = htmlentities($row['id']);

        // ----------------------------- Trovo il proprietario del post  ------------------ //
        $owner_query = "SELECT email FROM annunci WHERE id='$id'";
        $owner_res = mysqli_query($con, $owner_query);
        $owner_row = mysqli_fetch_assoc($owner_res);
        $owner_email = $owner_row['email'];

          // Non la migliore soluzione per non mostrare le cards se finisco gli annunci
          if($id!="") { // Ho dovuto se voglio mantenere class deck che contiene tutt e 3 le cards per riga, aaltrimenti non sapevo come metterne 3 in riga e andare a capo
      			    $title = htmlentities($row['title']);
      			    $des = htmlentities($row['description']);
      			    $time = substr(htmlentities($row['insert_date']), 0, 10);  // Uso substr per togliere il tempo dalla stringa
                $date = explode('-', $time);  // Divido anno, mese, giorno in base al trattino in mezzo
                $year = $date[0];   $month = $date[1];    $day = $date[2];  // Salvo distintamente anno, mese, giorno
      					$img = htmlentities($row['immagine']);
          ?>
          <div  class="card-deck" style="padding-top:20px;">

                <div class="card no_round_border">  <!-- PRIMA CARD -->
                  <img class="card-img-top" src="immagini/foto_annunci/<?php echo"$img";?>" alt="Foto dell'annuncio">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo "$title";?></h5>
                    <p class="card-text"><?php echo substr($des, 0, 100); ?>...</p>
              			<a href="view_annuncio.php?id=<?php echo"$id"; ?>" class="btn btn-primary">Leggi di più...</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Pubblicato il <?php echo "$day/$month/$year";?></small>
                    <?php
                    if(isset($_SESSION['SESS_EMAIL'])) {
                        $email = $_SESSION['SESS_EMAIL'];
                        if($email == $owner_email)  {   // Se il creatore del post sono io che lo sto guardando allora posso modificare ed eliminare
                        ?>
                        &ensp; <a href="edit_annuncio.php?id=<?php echo $id; ?>">[Edit]</a>

                        &ensp; <a href="php/delete_annuncio.php?id=<?php echo $id; ?>" onclick="return confirm('Sei sicuro di voler cancellare questo post?'); ">[Delete]</a>
                      <?php  } }// Chiude i due if ?>
                      <div class="icon_wrp"><i class="far fa-heart favourite_icon"></i></div>
                  </div>
                </div>
          <?php
          }


          $count += 1;	// Indice di tupla corrente
          mysqli_data_seek($result,$count); // Sposto il puntatore dell'array alla nuova tupla
          $row = mysqli_fetch_assoc($result);
			    $id = htmlentities($row['id']);

          // ----------------------------- Trovo il proprietario del post  ------------------ //
          $owner_query = "SELECT email FROM annunci WHERE id='$id'";
          $owner_res = mysqli_query($con, $owner_query);
          $owner_row = mysqli_fetch_assoc($owner_res);
          $owner_email = $owner_row['email'];

          if($id!="") {
        		    $title = htmlentities($row['title']);
        		    $des = htmlentities($row['description']);
        		    $time = substr(htmlentities($row['insert_date']), 0, 10);
                $date = explode('-', $time);
                $year = $date[0];   $month = $date[1];    $day = $date[2];
        				$img = htmlentities($row['immagine']);
          ?>
                <div class="card">  <!-- SECONDA CARD -->
                  <img class="card-img-top" src="immagini/foto_annunci/<?php echo"$img";?>" alt="Foto dell'annuncio">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo "$title";?></h5>
                    <p class="card-text"><?php echo substr($des, 0, 100); ?>...</p>    <!-- substr prende solo i primi 100 caratteri di $des partendo da 0 -->
                    <a href="view_annuncio.php?id=<?php echo"$id"; ?>" class="btn btn-primary">Leggi di più...</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Pubblicato il <?php echo "$day/$month/$year";?></small>
                    <?php

                    if(isset($_SESSION['SESS_EMAIL'])) {
                        $email = $_SESSION['SESS_EMAIL'];
                        if($email == $owner_email)  {   // Se il creatore del post sono io che lo sto guardando allora posso modificare ed eliminare
                        ?>
                        &ensp; <a href="edit_annuncio.php?id=<?php echo $id; ?>">[Edit]</a>

                        &ensp; <a href="php/delete_annuncio.php?id=<?php echo $id; ?>" onclick="return confirm('Sei sicuro di voler cancellare questo post?'); ">[Delete]</a>
                      <?php  } }// Chiude i due if ?>
                      <div class="icon_wrp"><i class="far fa-heart favourite_icon"></i></div>
                  </div>
                </div>
          <?php
          }


          $count += 1;	// Indice di tupla corrente
          mysqli_data_seek($result,$count); // Sposto il puntatore dell'array alla nuova tupla
          $row = mysqli_fetch_assoc($result);
			    $id = htmlentities($row['id']);

          // ----------------------------- Trovo il proprietario del post  ------------------ //
          $owner_query = "SELECT email FROM annunci WHERE id='$id'";
          $owner_res = mysqli_query($con, $owner_query);
          $owner_row = mysqli_fetch_assoc($owner_res);
          $owner_email = $owner_row['email'];


          if($id!="") {
      			    $title = htmlentities($row['title']);
      			    $des = htmlentities($row['description']);
      			    $time = substr(htmlentities($row['insert_date']), 0, 10);
                $date = explode('-', $time);
                $year = $date[0];   $month = $date[1];    $day = $date[2];
      					$img = htmlentities($row['immagine']);
          ?>
                <div class="card">  <!-- TERZA CARD -->
                  <img class="card-img-top" src="immagini/foto_annunci/<?php echo"$img";?>" alt="Foto dell'annuncio">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo "$title";?></h5>
                    <p class="card-text"><?php echo substr($des, 0, 100); ?>...</p>
                    <a href="view_annuncio.php?id=<?php echo"$id"; ?>" class="btn btn-primary">Leggi di più...</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Pubblicato il <?php echo "$day/$month/$year";?></small>
                    <?php

                      if(isset($_SESSION['SESS_EMAIL'])) {
                          $email = $_SESSION['SESS_EMAIL'];
                          if($email == $owner_email)  {   // Se il creatore del post sono io che lo sto guardando allora posso modificare ed eliminare
                          ?>
                          &ensp; <a href="edit_annuncio.php?id=<?php echo $id; ?>">[Edit]</a>

                          &ensp; <a href="php/delete_annuncio.php?id=<?php echo $id; ?>" onclick="return confirm('Sei sicuro di voler cancellare questo post?'); ">[Delete]</a>
                        <?php  } }// Chiude i due if ?>
                            <div class="icon_wrp"><i class="far fa-heart favourite_icon"></i></div>
                </div>
                </div>
          <?php
          }

          echo "</div>";  // Chiusura class deck

          $count += 1;
          mysqli_data_seek($result,$count); //Prima che riprenda il while, senza quest'istruzione stampa degli annunci doppi
			} // Chiusura while


// ----------------------------- Gestione di numerazione pagine -------------------------- //
// &emsp; corrisponde alla spaziatura tra gli indici delle pagine
// &raquo; corrisponde a >> ed invece $laquo; a <<
echo "<br> <table align='center'> <tr>";  // Per allineare i numeri delle pagine sulla stessa riga
			if ($page > 1) {
			    echo "<td><a href='?ord=$ord&page=1#annunci'>&laquo;</a> &emsp; </td>"; // simbolo <<      // Riporta alla prima pagina
			    $prevpage = $page - 1;
			    echo "<td><a href='?ord=$ord&page=$prevpage#annunci'><</a> &emsp; </td>";  // Simbolo <    //Torno indietro di 1 decrementando e salvando in $prevpage
			}
			$range = 5;  // Imposto variabile range a 5 perchè ho <<, <, 1, >, >>
			for ($x = $page - $range; $x < ($page + $range) + 1; $x++) { // For tenendo conto della distanza di 5
			    if (($x > 0) && ($x <= $totalpages)) { // Finchè non x>0 gira a vuoto non facendo nulla, appena x>0 stampa i numeri pagine
			        if ($x == $page) { // Pagina corrente, stampa il valore
			            echo "<td> $x  &emsp; </td>";
			        } else {
			            echo "<td><a href='?ord=$ord&page=$x#annunci'>$x</a> &emsp; </td>"; // Altre pagine, non quella corrente, stampa il link ad esse
			        }
			    }
			}

			if ($page != $totalpages && $totalpages != 0) {  //Se non mi trovo già all'ultima pagina stampo per proseguire //$totalpages != 0 perchè se ci sono zero annunci la divisione fa zero e considera 0 pagine tot
			    $nextpage = $page + 1;
			    echo "<td><a href='?ord=$ord&page=$nextpage#annunci'>></a> &emsp; </td>";  // simbolo > // Vado avanti di 1 incrementando $nextpage
			    echo "<td><a href='?ord=$ord&page=$totalpages#annunci'>&raquo;</a> &emsp; </td>"; // simbolo >> // Vado all'ultima pagina in base alle pagine totali
			}
echo " </tr> </table>  </div> <br> ";  // ultimo div chiude class container

include('footer.php');
include('navbar.php');
?>


</body>
</html>
