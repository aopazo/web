<?php 
	// Inialize session
	session_start();
	require("connection.php");
	require("functions.php");
	require_once("UsuarioDAO.php");
	if(isset($_SESSION['correo'])) {
		$dao = new UsuarioDAO($_SESSION['correo']);
	}

    require_once("functions.php");
	// implementar despliegue de errores
	$errorMessage = "";
	if(isset($_REQUEST['errorMessage'])) {
            $displayErrors = "block";
            $errorMessage = safe($_REQUEST['errorMessage']);
            if($test=="on") {
                echo "TEST: ".$errorMessage;
            }
        }
	else $displayErrors = "none";

?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Planes - AFP | Atempus</title>		
		<meta name="keywords" content="Atempus Pensiones Fondos Ahorro AFP" />
		<meta name="description" content="Atempus - pensión bajo control">
		<meta name="author" content="www.atempus.cl">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css" media="screen">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.theme.default.min.css" media="screen">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" media="screen">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="custom/css/theme.css">
		<link rel="stylesheet" href="custom/css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Favicon -->
		<link rel="icon" href="custom/img_custom/logo-ae-3.png">
		
		<!-- Skin CSS -->
		<link rel="stylesheet" href="custom/css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="custom/css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

		<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="vendor/respond/respond.js"></script>
			<script src="vendor/excanvas/excanvas.js"></script>
		<![endif]-->

	</head>
	<body>
	<?php include_once("analyticstracking.php") ?>

		<div class="body" id="contenido" style="visibility: hidden">
			<header id="header">
				<div id="header-logo" class="container">
					<div class="logo">
						<a href="inicio">
							<img alt="Atempus" width="180" height="90" data-sticky-width="90" data-sticky-height="45" src="custom/img_custom/logosvg.svg">
						</a>
					</div>
					<ul class="social-icons">
						<li class="facebook"><a href="http://www.facebook.com/AtempusCL" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="http://www.twitter.com/AtempusCL" target="_blank" title="Twitter">Twitter</a></li>
						<li class="linkedin"><a href="http://www.linkedin.com/company/Atempus" target="_blank" title="Linkedin">Linkedin</a></li>
					</ul>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse" id="header-navegacion"></div>
			</header>

			<div role="main" class="main">

				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="inicio">Inicio</a></li>
									<li class="active">Planes</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Planes</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row center">
						<div class="col-md-12">
							<h2>Escoje uno de nuestros planes y mejora tu futuro <span class="alternative-font">ahora</span></h2>
						</div>
					</div>
					
					<div class="row">

						<div class="pricing-table">
                                <div class="col-md-4">
                                    <div class="plan">
                                        <h3>Básico<span>Gratis</span></h3>
                                        <form name="formPlanGratis" id="formPlanGratis" action="registro" method="post">
											<input type="hidden" value="Gratis" name="plan" />
                                            <?php if(isset($_SESSION['plan'])) : ?>
                                                <input type="submit" class="btn btn-lg btn-primary" value="Suscríbete gratis" disabled>
                                            <?php else : ?>
                                                <input type="submit" class="btn btn-lg btn-primary" value="Suscríbete gratis" />
                                            <?php endif; ?>
                                        </form>
                                        <ul>
                                            <li>Suscripción por <big><big><b>3</b></big></big> meses</li>
                                            <li><big><big><b>4</b></big></big> días hábiles de desfase<br><span class="text-muted"><small>las alertas te llegarán con demora</small></span></li>
                                            <li><big><big><b>Gratis</b></big></big></li>
                                        </ul>
                                    </div>
                                </div>
							<div class="col-md-4">
								<div class="plan">
									<h3>Premium Anual<span>$12.000</span></h3>
									<form name="formPlan12000" id="formPlan12000" action="registro" method="post">
                                        <?php if(isset($_SESSION['plan'])) : ?>
											<input type="hidden" value="enproceso" name="renovacion" />
										<?php endif; ?>
										<input type="hidden" value="12000" name="plan" />
										<input type="submit" class="btn btn-lg btn-primary" value="Contratar" />
                                    </form>
									<ul>
										<li>Suscripción por <big><big><b>1</b></big></big> año</li>
										<li><big><big><b>Sin</b></big></big> desfase</li>
										<li>Equivale a <big><big><b>$1.000</b></big></big> mensuales</li>
									</ul>
								</div>
							</div>
							<div class="col-md-4">
								<div class="plan most-popular">
									<div class="plan-ribbon-wrapper"><div class="plan-ribbon"><i class="fa fa-star" style="color:orange"></i> <i class="fa fa-star" style="color:orange"></i> <i class="fa fa-star" style="color:orange"></i></div></div>
									<h3>Premium Bianual<span>$20.400</span></h3>
									<form name="formPlan20400" id="formPlan20400" action="registro" method="post">
											<input type="hidden" value="20400" name="plan" />
                                        <?php if(isset($_SESSION['plan'])) : ?>
											<input type="hidden" value="enproceso" name="renovacion" />
										<?php endif; ?>
											<input type="hidden" value="20400" name="plan" />
											<input type="submit" class="btn btn-lg btn-primary" value="Contratar" />
									</form>
									<ul>
										<li>Suscripción por <big><big><b>2</b></big></big> años</li>
										<li><big><big><b>Sin</b></big></big> desfase</li>
										<li>Equivale a <big><big><b>$850</b></big></big> mensuales</li>
									</ul>
								</div>
							</div>
						</div>

					</div>

				</div>

                <!-- agregando manejo de errores -->
                <div class="modal fade" id="ModalGenerico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalTitle"></h4>
                            </div>
                            <div id="myModalBody" class="modal-body"></div>
                            <div class="modal-footer">
                                <a href="#" id="myModalFooter" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin manejo de errores -->


			<footer class="short" id="footer"></footer>
		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.js"></script>
		<script src="vendor/bootstrap/bootstrap.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="custom/vendor/jquery.validation/jquery.validation.js"></script>
		<script src="vendor/jquery.stellar/jquery.stellar.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.js"></script>
		<script src="vendor/isotope/jquery.isotope.js"></script>
		<script src="vendor/owlcarousel/owl.carousel.js"></script>
		<script src="vendor/jflickrfeed/jflickrfeed.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/vide/vide.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="custom/js/theme.js"></script>
		
		<!-- Specific Page Vendor and Views -->
		<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="js/views/view.home.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
				
		<!-- Theme Custom -->
		<script src="custom/js/custom.js"></script>
		
	</body>
</html>
<?php
 // Mas manejo de errores
	if(isset($_REQUEST['errorMessage'])) {
            if ($_REQUEST['errorMessage'] != "") {
		echo "<script languaje=’javascript’>"
                    . "$('#myModalTitle').html('Notificación');"
                    . "$('#myModalBody').html('".$_REQUEST['errorMessage']."');"
                    . "$(document).ready(MostrarModal('#ModalGenerico'));"
                    . "</script>";
            }
	}

?>