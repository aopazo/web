<?php 

	// Inialize session
	session_start();
    require_once 'connection.php';

    if($_SESSION['correo']){
        $correo = $_SESSION['correo'];
        $username = $_SESSION['correo'];
    } else { $correo = ""; $username = ""; }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>AFP - Fondos | Atempus</title>		
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
		
		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

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
				<div class="slider-container">
					<div class="slider" id="revolutionSlider" data-plugin-revolution-slider data-plugin-options='{"startheight": 500}'>
						<ul>
							<li data-transition="fade" data-slotamount="13" data-masterspeed="300" >
				
								<img src="img/slides/slide-bg.jpg" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				
								<div class="tp-caption sft stb visible-lg"
									 data-x="87"
									 data-y="180"
									 data-speed="300"
									 data-start="1000"
									 data-easing="easeOutExpo"><img src="img/slides/slide-title-border.png" alt=""></div>
				
								<div class="tp-caption top-label lfl stl"
									 data-x="137"
									 data-y="180"
									 data-speed="300"
									 data-start="500"
									 data-easing="easeOutExpo">¿QUIERES MEJORAR TU PENSIÓN?</div>
				
								<div class="tp-caption sft stb visible-lg"
									 data-x="513"
									 data-y="180"
									 data-speed="300"
									 data-start="1000"
									 data-easing="easeOutExpo"><img src="img/slides/slide-title-border.png" alt=""></div>
				
								<div class="tp-caption main-label sft stb"
									 data-x="60"
									 data-y="210"
									 data-speed="300"
									 data-start="1500"
									 data-easing="easeOutExpo">Toma el control!</div>
				
								<div class="tp-caption bottom-label sft stb"
									 data-x="75"
									 data-y="280"
									 data-speed="500"
									 data-start="2000"
									 data-easing="easeOutExpo">y sigue nuestras recomendaciones de cambio de fondo</div>
				
								<div class="tp-caption randomrotate"
									 data-x="905"
									 data-y="248"
									 data-speed="500"
									 data-start="2500"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-1.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="955"
									 data-y="200"
									 data-speed="400"
									 data-start="3000"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-2.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="925"
									 data-y="170"
									 data-speed="700"
									 data-start="3150"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-3.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="875"
									 data-y="130"
									 data-speed="1000"
									 data-start="3250"
									 data-easing="easeOutBack"><img src="img/slides/slide-concept-2-4.png" alt=""></div>
				
								<div class="tp-caption sfb"
									 data-x="605"
									 data-y="80"
									 data-speed="600"
									 data-start="3450"
									 data-easing="easeOutExpo"><img src="img/slides/slide-concept-2-5.png" alt=""></div>
				
								<div class="tp-caption blackboard-text lfb "
									 data-x="635"
									 data-y="300"
									 data-speed="500"
									 data-start="3450"
									 data-easing="easeOutExpo" style="font-size: 37px;">Toma una</div>
				
								<div class="tp-caption blackboard-text lfb "
									 data-x="660"
									 data-y="350"
									 data-speed="500"
									 data-start="3650"
									 data-easing="easeOutExpo" style="font-size: 47px;">Decisión</div>
				
								<div class="tp-caption blackboard-text lfb "
									 data-x="685"
									 data-y="400"
									 data-speed="500"
									 data-start="3850"
									 data-easing="easeOutExpo" style="font-size: 32px;">Inteligente</div>
							</li>
							<li data-transition="fade" data-slotamount="5" data-masterspeed="1000" >
				
								<img src="img/slides/slide-bg.jpg" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				
									<div class="tp-caption sft stb"
										 data-x="155"
										 data-y="100"
										 data-speed="600"
										 data-start="100"
										 data-easing="easeOutExpo"><img src="img/slides/slide-concept.png" alt=""></div>
				
									<div class="tp-caption blackboard-text sft stb"
										 data-x="285"
										 data-y="180"
										 data-speed="900"
										 data-start="1000"
										 data-easing="easeOutExpo" style="font-size: 30px;">Mejora tú</div>
				
									<div class="tp-caption blackboard-text sft stb"
										 data-x="285"
										 data-y="220"
										 data-speed="900"
										 data-start="1200"
										 data-easing="easeOutExpo" style="font-size: 40px;">futuro hoy</div>
				
									<div class="tp-caption main-label sft stb"
										 data-x="685"
										 data-y="190"
										 data-speed="300"
										 data-start="900"
										 data-easing="easeOutExpo">ES FÁCIL!</div>
				
									<div class="tp-caption bottom-label sft stb"
										 data-x="685"
										 data-y="250"
										 data-speed="500"
										 data-start="2000"
										 data-easing="easeOutExpo">Nuestros números hablan por nosotros</div>
				
							</li>
						</ul>
					</div>
				</div>
				<div class="home-intro" id="home-intro">
					<div class="container">
				
						<div class="row">
							<div class="col-md-7">
								<p>
									El momento <em>justo</em> para mejorar tu futuro es <em>ahora</em>
									<span>Suscríbete a nuestras recomendaciones hoy</span>
								</p>
							</div>
							<div class="col-md-5">
								<div class="get-started">
									<a href="planes" class="btn btn-lg btn-primary">¡Escoje tu plan ahora!</a>
									<div class="learn-more">o <a href="queganoyo.html">revisa nuestros resultados</a></div>
								</div>
							</div>
						</div>
				
					</div>
				</div>
				
				<div class="container">
				
					<div class="row center">
						<div class="col-md-12">
							<h1 class="short word-rotator-title">
								Seguir nuestras recomendaciones es
								<strong class="inverted">
									<span class="word-rotate" data-plugin-options='{"delay": 2000, "animDelay": 300}'>
										<span class="word-rotate-items">
											<span>fácil</span>
											<span>rápido</span>
											<span>simple</span>
										</span>
									</span>
								</strong>
							</h1>
							<p class="featured lead">
								Sólo necesitas contar con la clave para ingresar al portal web de tu AFP y la clave para poder cambiarte de fondo.
							</p>
						</div>
					</div>
				
				</div>
				
				<div class="home-concept">
					<div class="container">
				
						<div class="row center">
							<span class="sun"></span>
							<span class="cloud"></span>
							<div class="col-md-2 col-md-offset-1">
								<div class="process-image" data-appear-animation="bounceIn">
									<a href="planes"><img alt="Regístrate" width="145" height="145" src="custom/img_custom/planperspectiva.png" alt="" /></a>
									<a href="planes"><strong>Escoge tu plan</strong></a>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="200">
									<a href="planes"><img alt="Regístrate" width="145" height="145" src="custom/img_custom/registro.png" alt="" /></a>
									<a href="planes"><strong>regístrate</strong></a>
								</div>
							</div>
							<div class="col-md-2">
								<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="400">
									<a href="planes"><img alt="Recomendaciones" width="145" height="145" src="custom/img_custom/recomendacionesdesenfocado.png" alt="" /></a>
									<a href="planes"><strong>sigue las recomendaciones</strong></a>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-1">
								<div class="project-image">
									<div id="fcSlideshow" class="fc-slideshow">
										<ul class="fc-slides">
											<li><a href="queganoyo.html"><img class="img-responsive" src="custom/img_custom/HA-A-perspectiva.jpg" /></a></li>
											<li><a href="queganoyo.html"><img class="img-responsive" src="custom/img_custom/CA-E-sin-perspectiva.jpg" /></a></li>
											<li><a href="queganoyo.html"><img class="img-responsive" src="custom/img_custom/mail-atempus.jpg" /></a></li>
										</ul>
									</div>
									<a href="queganoyo.html"><strong class="our-work">...y relájate</strong></a>
								</div>
								<!--
								<div class="project-image">
									<div id="fcSlideshow" class="fc-slideshow">
										<ul class="fc-slides">
											<li><a href="queganoyo.html"><img class="img-responsive" src="custom/img_custom/HA-A-perspectiva.jpg" /></a></li>
											<li><a href="queganoyo.html"><img class="img-responsive" src="img/projects/project-home-2.jpg" /></a></li>
											<li><a href="queganoyo.html"><img class="img-responsive" src="img/projects/project-home-3.jpg" /></a></li>
										</ul>
									</div>
									<a href="queganoyo.html"><strong class="our-work">...y relájate</strong></a>
								</div>
								-->
							</div>
						</div>
				
					</div>
				</div>
				
				<div class="container">
				
					<div class="row">
						<hr class="tall" />
					</div>
				
				</div>
				
				<div class="container">
					<h2>Nuestro <strong>Compromiso</strong></h2>
					<div class="row">
						<div class="col-sm-6">
							<div class="feature-box">
								<div class="feature-box-icon">
									<i class="fa fa-shield"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Privacidad de la información</h4>									
									<p class="tall">Tu información personal no será divulgada a terceros.</p>
								</div>
							</div>
							<div class="feature-box">
								<div class="feature-box-icon">
									<i class="fa fa-envelope"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Mensajería justa y necesaria</h4>
									<p class="tall">Sólo te enviaremos información pertinente.</p>
								</div>
							</div>
							<div class="feature-box">
								<div class="feature-box-icon">
									<i class="fa fa-users"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Número de usuarios acotado</h4>
									<p class="tall">Y mantener la demora del cambio efectivo de fondos en el mínimo.</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="feature-box">
								<div class="feature-box-icon">
									<i class="fa fa-flask"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Revisiones periodicas a la metodología</h4>
									<p class="tall">Mejoramos y adaptamos nuestros modelos constantemente.</p>
								</div>
							</div>
							<div class="feature-box">
								<div class="feature-box-icon">
									<i class="fa fa-line-chart"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="shorter">Monitoreo continuo de los mercados</h4>
									<p class="tall">Estamos siempre atentos para mejorar nuestros cálculos.</p>
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
