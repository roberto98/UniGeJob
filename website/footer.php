<!DOCTYPE html>
<html lang="it">
<head>
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   <!-- Per il footer -->
		 <link rel="stylesheet" href="css/social_buttons.css" />
</head>

<body>
		    <!-- Inizio Footer -->
		    <footer class="page-footer font-small unique-color-dark" style="  background-color: #D9D9D6; padding-top: 10px;">

		      <!-- Footer Links -->
		      <div class="container text-center text-md-left mt-5">

		        <!-- Grid row -->
		        <div class="row mt-3">

		          <!-- Grid column -->
		          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

		            <!-- Content -->
		            <h6 class="text-uppercase font-weight-bold">Newsletter</h6>
		            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

		                <form action="php/newsletter.php" method="POST">				<!-- NEWS LETTER -->
		                <p>Iscriviti alla newsletter per rimanere aggiornato sui nuovi annunci.</p>
											<!-- Material input preso da: https://mdbootstrap.com/docs/jquery/forms/inputs/ -->


												<div class="input-group contents">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-envelope prefix"></i></span>
													</div>
													<input type="email" class="form-control"  placeholder="Email" name="newsletter">
												</div>

		                </form>
		          </div>
		          <!-- Grid column -->

		          <!-- Grid column -->
		          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

		            <!-- Links -->
		            <h6 class="text-uppercase font-weight-bold">Link utili</h6>
		            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
		              <p> <a href="chi_siamo.php" style="color: black;">Chi siamo</a> </p>
		              <p> <a href="profilo_form.php" style="color: black;">Il tuo account</a> </p>
		              <p> <a href="index.php?#annunci" style="color: black;">Annunci</a> </p>
		              <p> <a href="faq.php" style="color: black;">Aiuto</a> </p>
		        </div>
		          <!-- Grid column -->

		          <!-- Grid column -->
		          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

		            <!-- Links -->
		            <h6 class="text-uppercase font-weight-bold">Contattaci</h6>
		            <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
		            <p> <i class="fas fa-home mr-3"></i> Genova, via dodecaneso 12</p>
		            <p> <i class="fas fa-envelope mr-3"></i>uniGejobs@gmail.com</p>
		            <p> <i class="fas fa-phone mr-3"></i> + 010 234 567 88</p>
		            <p>
							 </p>

		          </div>
		          <!-- Grid column -->

		        </div>
		        <!-- Grid row -->

		      </div>
		      <!-- Footer Links -->
					<div class="center">
						<div class="social-buttons"> <!-- https://www.youtube.com/watch?v=WESIes0U_ds -->
									<a href="https://it-it.facebook.com/" style="text-decoration: none; color: black;"><i class="fab fa-facebook-f"></i></a>
									<a href="https://twitter.com/login?lang=it" style="text-decoration: none; color: black;"><i class="fab fa-twitter"></i></a>
									<a href="https://www.instagram.com/?hl=it" style="text-decoration: none; color: black;"><i class="fab fa-instagram"></i></a>
									<a href="https://it.linkedin.com/" style="text-decoration: none; color: black;"><i class="fab fa-linkedin-in"></i></a>
						</div>
					</div>
		      <!-- Copyright -->
		      <div class="footer-copyright text-center py-3">© 2020 Copyright:
		        <a href="index.php" style="color: black;"> UniGeJob.com</a>
		        <a href="#" style="color: black;">| Privacy</a>
		        <a href="#" style="color: black;">| Condizioni</a>
		      </div>
		      <!-- Copyright -->

		    </footer>
		    <!-- Footer -->
</body>
