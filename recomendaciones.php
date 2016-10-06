<?php 
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Recomendaciones - AFP | Atempus</title>		
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
						<li class="facebook"><a href="http://www.facebook.com/AtempusCL" target="_blank" data-placement="bottom" data-tooltip title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="https://twitter.com/intent/follow?screen_name=AtempusCL"target="_blank" data-placement="bottom" data-tooltip title="Twitter">Twitter</a></li>
						<li class="linkedin"><a href="https://www.linkedin.com/company/Atempus" target="_blank" data-placement="bottom" data-tooltip title="Linkedin">Linkedin</a></li>
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
									<li class="active">Recomendaciones</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Recomendaciones</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					<h2>Las recomendaciones de Atempus te indican qué hacer con tus fondos de AFP para aumentar tu jubilación:</h2>
					<div class="row">
						<div class="col-md-4">
							<div class="feature-box secundary">
								<div class="feature-box-icon">
									<i class="fa fa-random"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Fondo A</h4>
									<p class="tall">Mueve tu dinero al fondo A, independiente del fondo en que estés actualmente.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="feature-box secundary">
								<div class="feature-box-icon">
									<i class="fa fa-pause"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Mantener</h4>
									<p class="tall">Mantén tu dinero en el fondo en el que lo tienes actualmente.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="feature-box secundary">
								<div class="feature-box-icon">
									<i class="fa fa-random"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Fondo E</h4>
									<p class="tall">Mueve tu dinero al fondo E, independiente del fondo en que estés actualmente.</p>
								</div>
							</div>
						</div>
					</div>
					<hr>	
								
					<div class="row">
						<div class="col-md-12">
						
							<div class="blog-posts">
							
								<div class="col-md-8 col-md-offset-2 visible-md-block visible-lg-block">
									<div class="col-md-4">
										<h3 class = "center">FONDO A</h3>
										<h3 class = "center"><i class="fa fa-long-arrow-down"></i></h3>
									</div>
									<div class="col-md-4 col-md-offset-4">
										<h3 class = "center">FONDO E</h3>
										<h3 class = "center"><i class="fa fa-long-arrow-down"></i></h3>
									</div>
								</div>

								<section class="timeline">
									<div class="timeline-body">
									
										<div class="timeline-date" id="mostrarhistroia-box">
											<h3><a id="mostrarmashistoria" style="cursor: pointer;">Cargar más historia</a></h3>
										</div>

									</div>

								</section>

							</div>
						</div>

					</div>

				</div>

			</div>

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

		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
		
		<!-- Theme Custom -->
		<script src="custom/js/custom.js"></script>
		
		<!-- Esta pagina -->
		<script src="custom/js/recomendaciones.js"></script>
	</body>
</html>
