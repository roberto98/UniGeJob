<?php
// https://www.cloudways.com/blog/live-search-php-mysql-ajax/         Ho usato questo sito
// https://ajaxlivesearch.com/    Plugin che si potrebbe usare, altrimenti teniamo il nostro
require_once('../db/mysql_credentials.php');


//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
$search = mysqli_real_escape_string($con, trim($_POST['search']));  // replace null with $_GET and sanitization

function search($search, $con) {
    //Search query.
       $Query = "SELECT id, title, description, immagine, Year(insert_date) AS Year, Month(insert_date) AS Month, Day(insert_date) AS Day FROM annunci WHERE title LIKE '%$search%' LIMIT 5";  // Non voglio prendere il tempo, solo data

    //Query execution
       $ExecQuery = mysqli_query($con, $Query);

    // Return array of results  Edit: forse è object ma ok, foreach va sia su array che object
    return $ExecQuery;
}

// Get user from login
$results = search($search, $con);

  if ($results) {
     // Format as you like and print search results

         echo '<ul class="contents" >';   // Stile modificabile

          if(mysqli_num_rows($results) > 0){
         //Fetching result from database.
            foreach ($results as $result) {
                 ?>
             <!-- Creating unordered list items.
                  Calling javascript function named as "fill" found in "script.js" file.
                  By passing fetched result as parameter. -->
             <a href="../~S4486648/view_annuncio.php?id=<?php echo $result['id']; ?>">
             <li class="live-search-box" style="padding-left: 0px;margin-left:0px;list-style-position: inside ">
             <!-- Assigning searched result in "Search box" in "search.php" file. -->

             <div class="card bg-dark text-white">
               <img class="card-img image_annunci" src="immagini/foto_annunci/<?php echo $result['immagine']; ?>" alt="Card image">
               <div class="card-img-overlay">
                 <h5 class="card-title">   <?php echo $result['title']; ?> </h5>
                 <p class="card-text">  <?php echo substr($result['description'], 0, 100); ?>... </p>
                 <p class="card-text">Pubblicato il <?php echo $result['Day'];?>/<?php echo $result['Month'];?>/<?php echo $result['Year'];?> </p>
               </div>
             </div>

             </li></a>
             <!-- Below php code is just for closing parenthesis. Don't be confused. -->
             <?php
          }
  } else {
      // No matches found
      echo '<div class="center"> Nessun risultato trovato </div>';
    }
} else { header("Location: errore.php");
      }
} // Chiude isset
