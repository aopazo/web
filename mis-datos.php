<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
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
						<a href="index.html">
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
									<li><a href="index.html">Inicio</a></li>
									<li class="active">Mis Datos</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Mis Datos</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="tabs">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#usuario" data-toggle="tab"><i class="fa fa-user"></i> Usuario</a>
									</li>
									<li>
										<a href="#facturacion" data-toggle="tab"><i class="fa fa-file-text-o"></i> Facturacion</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="usuario" class="tab-pane active">
										<h4 class="mb-none">Datos de usuario</h4>
										<br>
										<p><b>E-mail:</b> <span id="mail">peter.veneno@atempus.cl</span> <button id="editarmail" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></p>
										<p id="seccionemailprovisorio" class="hidden text-muted"><b>E-mail provisorio:</b> <span id="mailprovisorio"></span></p>
										<form style="display:none" id="formcambiomail" data-type="advanced" action="JavaScript:OcultarFormMailyQuizasMostrarModal('#formcambiomail','#ModalEnvioMail','#mail',0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="email" value="" placeholder="Nuevo e-mail (*)" data-msg-required="Ingresa tu nuevo e-mail." data-msg-email="Ingresa un e-mail valido." maxlength="100" class="form-control valid input-sm" name="email" id="email" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-4">
														<input type="email" value="" placeholder="Repetir nuevo e-mail (*)" data-msg-required="Repite tu nuevo e-mail." data-msg-equalTo="No ingresaste el mismo e-mail." maxlength="100" class="form-control valid input-sm" name="email_repetir" id="email_repetir" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3 col-md-offset-1">
														<button type="submit" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
														<button type="button" onclick="JavaScript:OcultarFormMailyQuizasMostrarModal('#formcambiomail','','',1)" value="Cancelar" class="btn btn-borders btn-default btn-sm" data-loading-text="Guardando...">Cancelar</button>
													</div>
												</div>
											</div>
										</form>		
										<p id="validacionOK"><b>Validación e-mail:</b> <span class="label label-success">E-mail validado</span></p>
										<p id="validacionKO" class="hidden"><b>Validación e-mail:</b> <span class="label label-danger">E-mail no validado</span> <button type="button" class="btn btn-borders btn-default btn-xs" data-toggle="modal" data-target="#ModalEnvioMailValidacion"><i class="fa fa-send"></i> reenviar e-mail de validación</button></p>
										<p id="suscripcionOK"><b>Suscripción e-mail:</b> <span class="label label-success">E-mail suscrito</span></p>
										<p id="suscripcionKO" class="hidden"><b>Suscripción e-mail:</b> <span class="label label-danger">E-mail no suscrito</span> <button type="button" class="btn btn-borders btn-default btn-xs" data-toggle="modal" data-target="#ModalEnvioMailSuscripcion"><i class="fa fa-send"></i> reenviar e-mail de suscripción</button></p>
										<p><b>Contraseña:</b> ******** <button id="editarclave" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></p>
										<form style="display:none" id="formcambioclave" action="JavaScript:OcultarFormClaveyQuizasMostrarModal('#formcambioclave', '#ModalCambioClave', 0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<input type="password" value="" placeholder="Actual contraseña (*)" data-msg-required="Ingresa tu actual contraseña." maxlength="100" class="form-control valid input-sm" name="passwordactual" id="passwordactual" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3">
														<input type="password" value="" placeholder="Nueva contraseña (*)" data-msg-required="Ingresa tu nueva contraseña." maxlength="100" class="form-control valid input-sm" name="password" id="password" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3">
														<input type="password" value="" placeholder="Repetir nueva contraseña (*)" data-msg-required="Repite tu nueva contraseña." data-msg-equalTo="No ingresaste la misma contraseña." maxlength="100" class="form-control valid input-sm" name="password_repetir" id="password_repetir" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3">
														<button type="submit" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
														<button type="button" onclick="JavaScript:OcultarFormClaveyQuizasMostrarModal('#formcambioclave','',1)" value="Cancelar" class="btn btn-borders btn-default btn-sm" data-loading-text="Guardando...">Cancelar</button>
													</div>
												</div>
											</div>
										</form>	
										
										<div class="modal fade" id="ModalCambioClave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">Actualización de contraseña</h4>
													</div>
													<div class="modal-body">
														Se ha actualizado tu contraseña.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>
										
										<div class="modal fade" id="ModalEnvioMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">Actualización de e-mail</h4>
													</div>
													<div class="modal-body">
														Se te ha enviado un e-mail para validar tu nueva dirección de correo electrónico. Una vez validado se te enviará un e-mail para que te vuelvas a suscribir a la lista de distribución de las recomentaciones. Revisalo y acepta la invitación para completar la actualización de correo electrónico.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>
										
										<div class="modal fade" id="ModalEnvioMailValidacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">E-mail de validación</h4>
													</div>
													<div class="modal-body">
														Se te ha enviado un e-mail para validar tu nueva dirección de correo electrónico.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>
										
										<div class="modal fade" id="ModalEnvioMailSuscripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">E-mail de suscripción</h4>
													</div>
													<div class="modal-body">
														Se te ha enviado un e-mail para que te vuelvas a suscribir a la lista de distribución de las recomentaciones. Revisalo y acepta la invitación.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="facturacion" class="tab-pane">
										<h4 class="mb-none">Datos de facturación</h4>
										<br>
										<p><b>Nombre:</b> <span id="nombres">Peter</span> <span id="apellidos">Veneno</span> <button id="editarnombres" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></p>
										<form style="display:none" id="formcambionombre" action="JavaScript:OcultarFormNombreyQuizasMostrarModal('#formcambionombre', '#ModalCambioNombre', '#nombres', '#apellidos', 0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="text" value="" placeholder="Nombres (*)" data-msg-required="Ingresa tus nombres." maxlength="200" class="form-control valid input-sm" name="nombres" id="nombres" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-4">
														<input type="text" value="" placeholder="Apellidos (*)" data-msg-required="Ingresa tus apellidos." maxlength="200" class="form-control valid input-sm" name="apellidos" id="apellidos" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3 col-md-offset-1">
														<button type="submit" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
														<button type="button" onclick="JavaScript:OcultarFormNombreyQuizasMostrarModal('#formcambionombre','','','',1)" value="Cancelar" class="btn btn-borders btn-default btn-sm" data-loading-text="Guardando...">Cancelar</button>
													</div>
												</div>
											</div>
										</form>	
										<div class="modal fade" id="ModalCambioNombre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">Actualización de nombre</h4>
													</div>
													<div class="modal-body">
														Se ha actualizado tu nombre. Esta modificación se verá reflejada en futuras facturaciones, pero no necesariamente en facturaciones en curso.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>
										
										<p><b>RUT:</b> <span id="rut">12345678-9</span> <button id="editarrut" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></p>
										<form style="display:none" id="formcambiorut" action="JavaScript:OcultarFormRUTyQuizasMostrarModal('#formcambiorut', '#ModalCambioRut', '#rut', 0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="rut" value="" placeholder="Ejemplo: 12345XXX-X" data-msg-required="Ingresa tu RUT." data-msg-rut="Ingresa un RUT válido (ej: 12345XXX-X)." maxlength="20" class="form-control valid input-sm" name="rut" id="rut" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-7 col-md-offset-1">
														<button type="submit" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
														<button type="button" onclick="JavaScript:OcultarFormRUTyQuizasMostrarModal('#formcambiorut','','','',1)" value="Cancelar" class="btn btn-borders btn-default btn-sm" data-loading-text="Guardando...">Cancelar</button>
													</div>
												</div>
											</div>
										</form>	
										<div class="modal fade" id="ModalCambioRut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">Actualización de RUT</h4>
													</div>
													<div class="modal-body">
														Se ha actualizado tu RUT. Esta modificación se verá reflejada en futuras facturaciones, pero no necesariamente en facturaciones en curso.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>
										
										<p><b>Dirección:</b> <span id="direccion">Apoquindo 1290</span>, <span id="comuna">Las Condes</span>, <span id="ciudad">Santiago</span>, <span id="region">Región Metropolitana</span> <button id="editardireccion" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></p>
										<form style="display:none" id="formcambiodireccion" action="JavaScript:OcultarFormDireccionyQuizasMostrarModal('#formcambiodireccion', '#ModalCambioDireccion', '#direccion', '#comuna', '#ciudad', '#region', 0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="text" value="" placeholder="Dirección" data-msg-required="Ingresa tu dirección." maxlength="20" class="form-control valid input-sm" name="direccion" id="direccion" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-4">
														<input type="text" value="" placeholder="Comuna" data-msg-required="Ingresa tu comuna." maxlength="20" class="form-control valid input-sm" name="comuna" id="comuna" required="" aria-required="true" aria-invalid="false">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="text" value="" placeholder="Ciudad" data-msg-required="Ingresa tu ciudad." maxlength="20" class="form-control valid input-sm" name="ciudad" id="ciudad" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-4">
														<input type="text" value="" placeholder="Región" data-msg-required="Ingresa tu región." maxlength="20" class="form-control valid input-sm" name="region" id="region" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3 col-md-offset-1">
														<button type="submit" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
														<button type="button" onclick="JavaScript:OcultarFormDireccionyQuizasMostrarModal('#formcambiodireccion','','','','','',1)" value="Cancelar" class="btn btn-borders btn-default btn-sm" data-loading-text="Guardando...">Cancelar</button>
													</div>
												</div>
											</div>
										</form>	
										<div class="modal fade" id="ModalCambioDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title" id="myModalLabel">Actualización de dirección</h4>
													</div>
													<div class="modal-body">
														Se ha actualizado tu dirección. Esta modificación se verá reflejada en futuras facturaciones, pero no necesariamente en facturaciones en curso.
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
