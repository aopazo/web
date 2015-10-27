<?php 
	// Inialize session
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Usuario - AFP | Atempus</title>		
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
		
		<div class="body" id="contenido" style="visibility: hidden">
			<header id="header">
				<div id="header-logo" class="container">
					<div class="logo">
						<a href="inicio">
							<img alt="Atempus" width="180" height="90" data-sticky-width="90" data-sticky-height="45" src="custom/img_custom/logo-ae-1.png">
						</a>
					</div>
					<ul class="social-icons">
						<li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>
						<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>
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
									<li class="active">Mi Cuenta</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Mi Cuenta</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					
					<div class="row">
						<div class="col-md-8 col-md-offset-2">	

							<div class="box-content">
								<h4 class="mb-none">Datos de tu cuenta</h4>
								<br>
								<p><b>Plan actual:</b> Anual Premium 
								 <a href="planes" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-repeat"></i> renueva tu plan</a>
								 <a href="planes" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-thumb-tack"></i> escoje un plan</a>
								 <a href="planes" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-rocket"></i> mejora tu plan</a></p>
								<br>
								
								<h4 class="mb-none">Información histórica</h4>
								
								<div id="no-more-tables">
									<table class="col-md-12 table table-striped table-center table-condensed cf">
										<thead>
											<tr>
												<th>Plan</th>
												<th>Suscripción</th>
												<th>Inicio de vigencia</th>
												<th>Vencimiento</th>
												<th>Estado</th>
												<th>Contrato</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td data-title="Plan">Anual Premium</td>
												<td data-title="Suscripción">05/08/2014</td>
												<td data-title="Inicio">05/08/2014</td>
												<td data-title="Vencimiento">05/08/2015</td>
												<td data-title="Estado">Vigente</td>
												<td data-title="Contrato"><a href="http://www.atempus.cl/contratos/Contrato1Y12000HCo.pdf" target="_blank" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-file-pdf-o" style="color:red"></i></a></td>
											</tr>
											<tr>
												<td data-title="Plan">Gratis</td>
												<td data-title="Suscripción">16/06/2014</td>
												<td data-title="Inicio">16/06/2014</td>
												<td data-title="Vencimiento">16/09/2014</td>
												<td data-title="Estado">Vencido</td>
												<td data-title="Contrato"><a href="http://www.atempus.cl/contratos/Contrato3MGratisHCo.pdf" target="_blank" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-file-pdf-o" style="color:red"></i></a></td>
											</tr>
											<tr>
												<td data-title="Plan">Anual Premium</td>
												<td data-title="Suscripción">15/06/2013</td>
												<td data-title="Inicio">15/06/2013</td>
												<td data-title="Vencimiento">15/06/2014</td>
												<td data-title="Estado">Vencido</td>
												<td data-title="Contrato"><a href="http://www.atempus.cl/contratos/Contrato1Y12000HCo.pdf" target="_blank" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-file-pdf-o" style="color:red"></i></a></td>
											</tr>
										</tbody>
									</table>
								</div>								
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

		<!-- Specific Page Vendor and Views -->
		<script src="js/views/view.contact.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
		
		<!-- Theme Custom -->
		<script src="custom/js/custom.js"></script>
		

	</body>
</html>
