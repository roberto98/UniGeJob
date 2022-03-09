<?php
// Prendo la foto profilo dal db per caricarla in seguito
    $sql = "SELECT foto_profilo from users where email = '$email'";
    $result = mysqli_query($con,$sql);
    $row_img = mysqli_fetch_array($result);

    $image = $row_img['foto_profilo'];
    $image_src = "immagini/foto_profilo/".$image;

    ?>
