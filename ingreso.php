<?php

// Inialize session
session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Ingreso - AFP | Atempus</title>		
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
									<li class="active">Ingresar</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Ingreso</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="row featured-boxes login">
								<div class="col-sm-6 col-sm-offset-3 page-login">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Ingreso</h4>
											<form action="login-processor.php" id="formIngresoLogin" novalidate="novalidate" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>E-mail</label>
															<input type="email" value="aopazo@gmail.com" data-msg-required="Ingresa tu e-mail." data-msg-email="Ingresa un e-mail valido." maxlength="100" class="form-control valid input-lg" name="correo" id="correo" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Contraseña</label>
															<input type="password" value="qwe" data-msg-required="Ingresa tu contraseña." maxlength="20" class="form-control valid input-lg" name="contra" id="contra" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<span class="remember-box checkbox">
															<label for="rememberme">
																<input type="checkbox" id="rememberme" name="rememberme">Recuérdame
															</label>
														</span>
													</div>
													<div class="col-md-6">
														<button type="submit" id="buttonIngresar" value="Ingresar" class="btn btn-primary pull-right push-bottom" data-loading-text="Ingresando...">Ingresar <i class="fa fa-sign-in"></i></button>
													</div>
												</div>
												<input type="hidden" value="login" name="action" />
											</form>
											<hr>
											<a class="pull-right" href="#" id="pageLoginheaderRecover">¿Olvidaste tu contraseña?</a>
															
											<p class="sign-up-info">¿No estás registrado? <a href="planes">Escoje un plan</a></p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-sm-offset-3 page-recover">
									<div class="featured-box featured-box-secundary default info-content">	
										<div class="box-content">
											<div class="recover-form">
												<h4>Resetear contraseña</h4>
												<p>Ingresa tu e-mail para recibir un código de autentificación y resetear tu contraseña.</p>

												<form action="JavaScript:MostrarModal('#ModalRecuperarClave')" id="formIngresoRecuperarMail" novalidate="novalidate">
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>E-mail</label>
																<input type="email" value="" data-msg-required="Ingresa tu e-mail." data-msg-email="Ingresa un e-mail valido." maxlength="100" class="form-control valid input-lg" name="email" id="email" required="" aria-required="true" aria-invalid="false">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<button type="submit" value="Enviar" class="btn btn-primary pull-right push-bottom" data-loading-text="Enviando...">Enviar <i class="fa fa-send"></i></button>
														</div>
													</div>
												</form>
												<hr>
												<p class="log-in-info">¿Ya tienes una cuenta? <a href="#" id="pageRecoverHeaderLogin">Ingresar</a></p>
											</div>
										</div>										
									</div>
								</div>

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
		
		<script>
			$('#buttonIngresar').click(function(e){
				$.ajax({
					url: 'login-processor.php',
					type: 'post',
					data: {
						section: "ingresar",
						correo: $("#correo").val(),
						contra: $("#contra").val(),
					},
					success: function(result) {
						if(result=="datosVacios"){
							$('#myModalBody').html('Datos Vacios');
							$('#ModalGenerico').modal({show: 'true'});
						}
						else if(result=="direccionActualizadaOK"){
							$('#myModalBody').html('Tu direcci&oacute;n ha sido actualizada correctamente');
							$('#ModalGenerico').modal({show: 'true'});
						}
						else if(result=="direccionActualizadaNOK"){
							$('#myModalBody').html('No hemos podido actualizar tu direcci&oacute;n. Int&eacute;ntalo m&aacute;s tarde.');
							$('#ModalGenerico').modal({show: 'true'});
						}
					}
				});
			});
		</script>

        </body>
</html>

<?php

	if(isset($_REQUEST['errorMessage'])) {
		if($_REQUEST['errorMessage'] == "correoError") {
			echo "<script languaje=’javascript’>"
                    . "$('#myModalTitle').html('Ingreso');"
                    . "$('#myModalBody').html('Nombre de usuario inv&aacute;lido. Int&eacute;ntalo de nuevo.');"
                    . "$(document).ready(MostrarModal('#ModalGenerico'));"
               . "</script>";
			echo "<script languaje=’javascript’>alert('Nombre de usuario inv\u00e1lido')</script>";
		}
		if($_REQUEST['errorMessage'] == "contraError") {
			echo "<script languaje=’javascript’>"
                    . "$('#myModalTitle').html('Ingreso');"
                    . "$('#myModalBody').html('Contrase&ntilde;a incorrecta. Int&eacute;ntalo de nuevo.');"
                    . "$(document).ready(MostrarModal('#ModalGenerico'));"
               . "</script>";
		}
		if($_REQUEST['errorMessage'] == "sessionStart") {
			echo "<script languaje=’javascript’>alert('Bienvenido ".$_SESSION['username'].". Su sesi\u00f3n ha sido iniciada.')</script>";
//			$_REQUEST['errorMessage'] = "";
		}
		if($_REQUEST['errorMessage'] == "tokenInvalido") {
			echo "<script languaje=’javascript’>alert('Token Inv&aacute;lido.\nPor favor, reintenta copiar y pegar el link que te enviamos nuevamente.\nSi el problema persiste, env&iacute;anos un correo ;)')</script>";
//			$_REQUEST['errorMessage'] = "";
		}
		if($_REQUEST['errorMessage'] == "tokenNoEncontrado") {
			echo "<script languaje=’javascript’>alert('Token No Encontrado.\nPor favor, reintenta copiar y pegar el link que te enviamos nuevamente.')</script>";
//			$_REQUEST['errorMessage'] = "";
		}
	}

?>
