<?php

session_start();
require_once('../db/mysql_credentials.php');

if (isset($_SESSION['SESS_EMAIL'])) {
    $email = $_SESSION['SESS_EMAIL'];



    // ---------- Salvo i DATI dal form "inserisci annuncio" -------------- //
    $title = mysqli_real_escape_string($con, trim($_POST['title']));
    $description = mysqli_real_escape_string($con, trim($_POST['description']));
    $priv_azienda = mysqli_real_escape_string($con, trim($_POST['priv_azienda']));
    $number = mysqli_real_escape_string($con, trim($_POST['number']));


    // ---------- Salvo la FOTO dal form "inserisci annuncio" -------------- //
    $img = $_FILES['foto_annuncio']['name'];  //Con il primo campo prendo il name dell'input e con il secondo il nome del file
    $target_dir = "../immagini/foto_annunci/";
    $target_file = $target_dir . basename($_FILES["foto_annuncio"]["name"]); // basename ritorna l'ultima cartella del percorso

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // pathinfo prende il percorso e mette tutti i vari /.../ in array e restituisce l'estensione grazie all'attributo PATHINFO_EXTENSION
    // trasformo minuscolo per controllare poi con array creato sotto
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");


  // ---------------------------- Eseguo le QUERY ------------------------- //
    if( in_array($imageFileType,$extensions_arr) || !$img ){  // Check extension // !img nel caso non volessi mettere foto nell'annuncio
        if(!isset($_GET['id'])) {    // Se non esiste un id inserisco altrimenti modifico
              if(!$img) $img='../icon/not-found.png';   //Se non metto foto in annuncio, salvo e faccio comparire immagine di default
              $query = "INSERT INTO annunci (email, title, description, immagine, rag_sociale, num_cell) VALUES( '$email', '$title', '$description', '$img', '$priv_azienda', '$number')";
          } else {
              $id = mysqli_real_escape_string($con, trim($_GET['id']));

              if(!$img) { // Se non ricarica nessuna foto vado a riprendere quella che aveva dal db
                $sql = "SELECT immagine from annunci where id = '$id'";
                $result = mysqli_query($con,$sql);
                $row_img = mysqli_fetch_array($result);
                $img = $row_img['immagine'];
              }
              $query = "UPDATE annunci SET title = '$title', description = '$description', immagine = '$img', rag_sociale = '$priv_azienda', num_cell = '$number' WHERE id = '$id'";
          }

        $ok = mysqli_query($con, $query) or die("<br> <br> <h1>Error in the insert of query: </h1>".mysqli_error($con));

        // Upload file
        move_uploaded_file($_FILES['foto_annuncio']['tmp_name'],$target_dir.$img); // sposta immagine sul server  // concateno $target_dir con $img perchè img può cambiare
    }


    //------------- Controllo sia andata bene ------------------------- //
    if($ok){
      header("Location: ../index.php?ord=id");
    } else {
      header("Location: errore.php");
    }


} else {  // Chiusura isset
      header("Location: ../login_form.php");
}


?>
