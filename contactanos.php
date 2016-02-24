<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Contacto - AFP | Atempus</title>		
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

		<!-- Theme CSS  -->
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
						<a href="inicio.html">
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
									<li><a href="incio.html">Inicio</a></li>
									<li class="active">Contacto</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Contacto</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row center">
						<div class="col-md-12">
							<h2>Completa la siguiente información y te contactaremos muy pronto</h2>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-10 col-md-offset-1">	

							<div class="box-content">
								<h4>Formulario de contacto</h4>
								
								<div id="form-contacto">
									<form id="formContactenos" action="JavaScript:ContactoEnviado(ModalConfirmacionEvionMensaje)" novalidate="novalidate">
										<div class="row">
											<div class="form-group">
												<div class="col-md-6">
													<label>Nombre (*)</label>
													<input type="text" value="" data-msg-required="Ingresa tu nombre." maxlength="100" class="form-control valid" name="name" id="name" required="" aria-required="true" aria-invalid="false">
												</div>
												<div class="col-md-6">
													<label>E-mail (*)</label>
													<input type="email" value="" data-msg-required="Ingresa tu dirección de correo electrónico." data-msg-email="Ingresa una dirección de correo electrónico valida." maxlength="100" class="form-control valid" name="email" id="email" required="" aria-required="true" aria-invalid="false">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-group">
												<div class="col-md-12">
													<label>Asunto (*)</label>
													<input type="text" value="" data-msg-required="Ingresa el asunto del mensaje." maxlength="100" class="form-control valid" name="subject" id="subject" required="" aria-required="true" aria-invalid="false">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-group">
												<div class="col-md-4">
													<label>Codigo de verificación (*)</label>
													<!--
													<input type="text" value="" maxlength="6" data-msg-captcha="Código erroneo." data-msg-required="Ingresa el código de verificación." class="form-control input-lg captcha-input" name="captcha" id="captcha" aria-required="true">
													-->
													<input type="text" value="" maxlength="6" data-msg-required="Ingresa el código de verificación." class="form-control valid input-lg" required="" aria-required="true">
													<div class="captcha" style = "clear: none;	margin-bottom: 0px;	margin-top: 30px;">
														<div class="captcha-image">
															<img id="captcha-image" src="custom/img_custom/captcha.png" alt="CAPTCHA code">
														</div>
														<div class="captcha-refresh">
															<a href="#" id="refreshCaptcha"><i class="fa fa-refresh"></i></a>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<label>Mensaje (*)</label>
													<textarea maxlength="5000" data-msg-required="Ingresa tu mensaje." rows="10" class="form-control valid" name="message" id="message" required="" aria-required="true" aria-invalid="false"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<button type="submit" value="Enviar" class="btn btn-primary pull-right push-bottom" data-loading-text="Enviando...">Enviar <i class="fa fa-send"></i></button>
											</div>
										</div>
									</form>
									<div class="modal fade" id="ModalConfirmacionEvionMensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 class="modal-title" id="myModalLabel">Confirmación envío de mensaje</h4>
												</div>
												<div class="modal-body">
													<strong>¡Excelente!</strong> Tu mensaje ha sido enviado.
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
												</div>
											</div>
										</div>
									</div>
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
