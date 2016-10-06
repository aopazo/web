<?php
	// Inialize session
	session_start();

	error_log("\n".date("Y/m/d H:i:s")." registro:: sesion correo ".$_SESSION['correo']." userdata correo ".$userdata['correo'], 3, "debug.log");

	require_once("connection.php");
	require_once("functions.php");
	require_once("getFormData.php");
	require_once("UsuarioDAO.php");
	if(isset($_SESSION['correo'])) {
		$dao = new UsuarioDAO($_SESSION['correo']);
	}
	include("php/simple-php-captcha/simple-php-captcha.php");
    $userdata = getDatosUsuario($_SESSION['correo']);

	error_log("\n".date("Y/m/d H:i:s")." registro:: sesion correo ".$_SESSION['correo']." userdata correo ".$userdata['correo'], 3, "debug.log");

	$usuarioActive="disable";
	$validarActive = "disable";
	$suscripcionActive = "disable";
	$facturacionActive = "disable";
	$transferenciaActive = "disable";
	
	if(!empty($section)) { 
		if      ($section=="usuarioActive")       $usuarioActive="active";
		else if ($section=="validarActive")       $validarActive="active";
		else if ($section=="suscripcionActive")   $suscripcionActive="active";
		else if ($section=="facturacionActive")   $facturacionActive="active";
		else if ($section=="transferenciaActive") $transferenciaActive="active";
	} else if($renovacion == "enproceso") { 
        $_SESSION['vp'] = "enproceso";
		$facturacionActive = "active";
    } else {
        // Condicion de entrada, se muestra primero tab "Usuario"
		$usuarioActive="active";
	}
	if(isset($_SESSION['correo']) && $plan == "Gratis"){
		$usuarioActive="disable";
		$validarActive="active";
		$dao->setNewPlan("Gratis");
	}
	if(isset($_SESSION['correo']) && $plan != "Gratis"){
		$usuarioActive="disable";
		$validarActive="disable";
		$facturacionActive="active";
	}
	if($transferenciaActive=="active"){
		$usuarioActive="disable";
		$validarActive="disable";
		$facturacionActive="disable";
	}
		

?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Registro - AFP | Atempus</title>		
		<meta name="keywords" content="Atempus Pensiones Fondos Ahorro AFP" />
		<meta name="description" content="Atempus - pensi&oacute;n bajo control">
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
									<li class="active">Registro</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">Registro</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row center">
						<div class="col-md-12">
							<h2>Sigue estos pasos para completar tu registro y recibir nuestras recomendaciones</h2>
						</div>
					</div>

					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="tabs wizard-tabs" id="tabs">							
								<ul class="nav nav-tabs nav-justified wizard-steps">
									<li class="<?php echo $usuarioActive; ?>">
										<a href="#registro" aria-expanded="false"><i class="fa fa-user"></i> Usuario<span></span></a>
									</li>
									<li class="<?php echo $validarActive; ?>">
										<a href="#validar" aria-expanded="false"><i class="fa fa-check-square-o"></i> Validaci&oacute;n<span></span></a>
									</li>
                                    <li class="<?php echo $facturacionActive; ?>">
                                        <a href="#facturacion" aria-expanded="false"><i class="fa fa-file-text-o"></i> Datos para facturaci&oacute;n<span></span></a>
                                    </li>
                                    <li class="<?php echo $transferenciaActive; ?>">
                                        <a href="#transferencia" aria-expanded="false"><i class="fa fa-exchange"></i> Transferencia<span></span></a>
                                    </li>
								</ul>
								<div class="tab-content"> 
									<div id="registro" class="tab-pane <?php echo $usuarioActive; ?>">
										<div class="box-content">
											<h4>Registro del usuario</h4>
											<!-- JavaScript:ActiveTab('#registro','#validar'); -->
											<form id="formUsuario" action="form-processor" method="post" novalidate="novalidate">
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>E-mail (*)</label>
															<input type="email" value="" data-msg-required="Ingresa tu e-mail." data-msg-email="Ingresa un e-mail valido." maxlength="100" class="form-control valid input-lg" name="correo" id="correo" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-6">
															<label>Repetir e-mail (*)</label>
															<input type="email" value="" data-msg-required="Repite tu e-mail." data-msg-equalTo="No ingresaste el mismo e-mail." maxlength="100" class="form-control valid input-lg" name="correo_repetir" id="correo_repetir" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Contrase&ntilde;a (*)</label>
															<input type="password" value="" data-msg-required="Ingresa tu contrase&ntilde;a." maxlength="20" class="form-control valid input-lg" name="contrasena" id="contrasena" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-6">
															<label>Repetir Contrase&ntilde;a (*)</label>
															<input type="password" value="" data-msg-required="Repite tu contrase&ntilde;a." data-msg-equalTo="No ingresaste la misma contrase&ntilde;a." maxlength="20" class="form-control valid input-lg" name="contrasena_repetir" id="contrasena_repetir" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-4">
															<label>Codigo de verificación (*)</label>
															<input type="text" value="" maxlength="6" data-msg-captcha="Código incorrecto." data-msg-required="Ingresa el código de verificación." class="form-control input-lg captcha-input" name="captcha" id="captcha" aria-required="true">
														</div>
														<div class="col-md-8">
															<div class="captcha" style = "clear: none;	margin-bottom: 0px;	margin-top: 30px;">
																<div class="captcha-image">
																	<?php
																	$_SESSION['captcha'] = simple_php_captcha(array(
																		'min_length' => 6,
																		'max_length' => 6,
																		'min_font_size' => 22,
																		'max_font_size' => 22,
																		'angle_max' => 3
																	));

																	$_SESSION['captchaCode'] = $_SESSION['captcha']['code'];

																	echo '<img id="captcha-image" src="' . "php/simple-php-captcha/simple-php-captcha.php/" . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
																	?>
																</div>
																<div class="captcha-refresh">
																	<a href="#" id="refreshCaptcha"><i class="fa fa-refresh"></i></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-8">
															<!--<div class="checkbox-group" data-msg-required="Debes aceptar los requisitos.">
																<label class="checkbox-inline">
																	<input type="checkbox" name="checkboxes" id="inlineCheckbox1" value="option1" checked>--> Haciendo click en <b>Siguiente</b>, aceptas los <a href="terminos_y_condiciones" target="_blank">T&eacute;rminos y Condiciones</a>, la <a href="politica_de_privacidad" target="_blank">Pol&iacute;tica de Privacidad</a> y los t&eacute;rminos expresados en el <a href="http://www.atempus.cl/contratos/
																	<?php
																		if($plan=="Gratis") echo "Contrato3MGratisHCo.pdf"; 
																		if($plan=="12000") echo "Contrato1Y12000HCo.pdf"; 
																		if($plan=="20400") echo "Contrato2Y20400HCo.pdf"; 
																	?>"
																	target="_blank">Contrato</a> asociado al <b>
																	<?php
																		if($plan=="Gratis") echo "Plan Basico"; 
																		if($plan=="12000") echo "Plan Premium Anual"; 
																		if($plan=="20400") echo "Plan Premium Bianual"; 
																	?>
																	</b>.
																<!--</label>
															</div>-->
														</div>
														<div class="col-md-4">
															<?php if ($_SESSION['correo_validado']) : ?>
																<button id="button-reg-sig" type="submit" value="Siguiente" class="btn btn-primary pull-right push-bottom" data-loading-text="Registrando...">Siguiente <i class="fa fa-arrow-right"></i></button>
															<?php else : ?>
																<button id="button-reg-recargar" type="submit" value="Siguiente" class="btn btn-primary pull-right push-bottom" data-loading-text="Registrando...">Siguiente <i class="fa fa-arrow-right"></i></button>
																
															<?php endif; ?>

														</div><br /><br />
													</div>
												</div>
												<input type="hidden" name="plan" value="<?php echo $plan; ?>" />
												<input type="hidden" name="section" value="usuario" />
											</form>
										</div>
									</div>

									<div id="validar" class="tab-pane <?php echo $validarActive; ?>">
										<div class="box-content">
											<h4>Validaci&oacute;n de e-mail</h4>
											<div class="row">
												<div class="col-md-12">
													<?php if($_SESSION['correo_validado'] == "0" || $_SESSION['correo_validado'] == "") : ?>
														<!-- <form id="formValidacion" action="form-processor" method="post" novalidate="novalidate"> -->
														<p>Te hemos enviado un e-mail para validar tu direcci&oacute;n de correo electr&oacute;nico. Rev&iacute;salo y pincha el link de validaci&oacute;n para poder continuar.</p>
														<p>Si no has recibido el e-mail de validaci&oacute;n, ingresa a tu cuenta para reenv&iacute;atelo.</p>
														<hr>
													<?php else : ?>
																<p>Tu direcci&oacute;n de correo electr&oacute;nico ha sido validada.</p>
													<?php endif; ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-8">
												</div>
												<div class="col-md-4">
													<?php if($plan != "Gratis") : ?>
														<button onclick="JavaScript:ActiveTab('#facturacion')" onsubmit="return ActiveTab('#facturacion')" value="Siguiente" class="btn btn-primary pull-right push-bottom tologged" data-loading-text="Actualizando...">Siguiente <i class="fa fa-arrow-right"></i></button>
													<?php else : ?>
														<a href="ingreso" class="btn btn-primary pull-right push-bottom tologged">Ingresa ahora <i class="fa fa-sign-in"></i></a>
													<?php endif; ?>

												</div>
											</div>
											<!-- <input type="hidden" name="section" value="validacion" />
											</form> -->
										</div>
									</div>

									<div id="facturacion" class="tab-pane <?php echo $facturacionActive; ?>">
										<div class="box-content">
											<h4>Datos para facturaci&oacute;n</h4>
                                            <form id="formFacturacion" action="form-processor" method="post" novalidate="novalidate">
												<div class="row">
													<div class="form-group">
														<div class="col-md-4">
															<label>Nombres</label>
															<input type="text" value="<?php echo $nombres.$userdata['nombres']; ?>" data-msg-required="Ingresa tus nombres." maxlength="200" class="form-control input-lg" name="nombres" id="nombres" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-4">
															<label>Apellidos</label>
															<input type="text" value="<?php echo $apellidos.$userdata['apellidos']; ?>" data-msg-required="Ingresa tus apellidos." maxlength="200" class="form-control input-lg" name="apellidos" id="apellidos" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-4">
															<label>RUT</label>
															<input type="rut" value="<?php echo $rut.$userdata['rut']; ?>" data-msg-required="Ingresa tu RUT." data-msg-rut="Ingresa un RUT v&aacute;lido (ej: 12345XXX-X)." maxlength="20" class="form-control input-lg" name="rut" id="rut" required="" aria-required="true" aria-invalid="false" placeholder="ej: 12345XXX-X">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label>Direcci&oacute;n</label>
															<input type="text" value="<?php echo $direccion.$userdata['direccion']; ?>" data-msg-required="Ingresa tu direcci&oacute;n." maxlength="100" class="form-control input-lg" name="direccion" id="direccion" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-3">
															<label>Comuna</label>
															<input type="text" value="<?php echo $comuna.$userdata['comuna']; ?>" data-msg-required="Ingresa tu comuna." maxlength="100" class="form-control input-lg" name="comuna" id="comuna" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-3">
															<label>Ciudad</label>
															<input type="text" value="<?php echo $ciudad.$userdata['ciudad']; ?>" data-msg-required="Ingresa tu ciudad." maxlength="100" class="form-control input-lg" name="ciudad" id="ciudad" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-3">
															<label>Regi&oacute;n</label>
															<input type="text" value="<?php echo $region.$userdata['region']; ?>" data-msg-required="Ingresa tu regi&oacute;n." maxlength="100" class="form-control input-lg" name="region" id="region" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-8">
														</div>
														<div class="col-md-4">
															<button type="submit" value="Siguiente" class="btn btn-primary pull-right push-bottom tologged" data-loading-text="Guardando...">Siguiente <i class="fa fa-arrow-right"></i></button>
														</div>
													</div>
												</div>
												<input type="hidden" name="section" value="facturacion" />
												<input type="hidden" name="plan" value="<?php echo $plan; ?>" />
											</form>
										</div>
									</div>

									<div id="transferencia" class="tab-pane <?php echo $transferenciaActive; ?>">
										<div class="box-content">
											<h4>Transferencia</h4>
											<form id="formTransferencia" action="form-processor" method="post" novalidate="novalidate">
												<?php if ($_SESSION['vp'] == "enproceso") : ?>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p>Presiona el bot&oacute;n y ser&aacute;s redirigido al portal de pago para realizar la transferencia.</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="submit"><img src="./custom/img_custom/200x50.png" border="0" alt="Khipu"></button> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p>Si ya realizaste la transferencia, inf&oacute;rmanos <a href="contacto">aqu&iacute;</a>.</p>
                                                        </div>
                                                    </div>
    												<input type="hidden" name="message" value="renovacion" />
												<?php elseif ($_SESSION['vp'] == "pago-ok") : ?>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p>Felicitaciones. Hemos confirmado la transferencia y tu registro ha sido completado exitosamente. </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="recomendaciones" class="btn btn-lg btn-primary pull-right">Ir a recomendaciones</a>
                                                        </div>
                                                    </div>
												<?php else : ?>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p>Presiona el bot&oacute;n y ser&aacute;s redirigido al portal de pago para realizar la transferencia.</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="submit"><img src="./custom/img_custom/200x50.png" border="0" alt="Khipu"></button> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p>Si ya realizaste la transferencia, inf&oacute;rmanos <a href="contacto">aqu&iacute;</a>.</p>
                                                        </div>
                                                    </div>
    												<input type="hidden" name="message" value="suscripcion" />
												<?php endif ; ?>
												<hr>
												<input type="hidden" name="section" value="transferencia" />
												<input type="hidden" name="plan" value="<?php echo $plan; ?>" />
												<input type="hidden" name="correo" value="<?php echo $_SESSION['correo']; ?>" />
											</form>
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
	    <script src="custom/vendor/jquery-visible-master/jquery.visible.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="custom/js/theme.js"></script>

		<!-- Specific Page Vendor and Views -->
		<script src="js/views/view.contact.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
		
		<!-- Theme Custom -->
		<script src="custom/js/custom.js"></script>

<?php
	if(isset($_SESSION['plan'])){
		if($_SESSION['plan']=="Gratis"){
			echo '<script type="text/javascript">ActiveTab(\'#facturacion\');</script>';
		} else {
			echo '<script type="text/javascript">ActiveTab(\'#transferencia\');</script>'; 
		}
	}
?>
<?php if($validarActive=="active") echo '<script type="text/javascript">ActiveTab(\'#validar\');</script>'; ?>
<?php if($suscripcionActive=="active") echo '<script type="text/javascript">ActiveTab(\'#suscripcion\');</script>'; ?>
<?php if($facturacionActive=="active") echo '<script type="text/javascript">ActiveTab(\'#facturacion\');</script>'; ?>
<?php if($transferenciaActive=="active") echo '<script type="text/javascript">ActiveTab(\'#transferencia\');</script>'; ?>
	
	</body>
</html>

<?php
 // Mas manejo de errores
	if(isset($_POST['errorMessage'])) {
        if ($_POST['errorMessage'] != "") {
			$message = str_replace("\\n","<br />",$_POST['errorMessage']);
			$message = str_replace("- ","<li>",$message);
			echo "<script languaje=’javascript’>"
                    . "$('#myModalTitle').html('Notificación');"
                    . "$('#myModalBody').html('".$message."');"
                    . "$(document).ready(MostrarModal('#ModalGenerico'));"
                    . "</script>";
        }
	}
?>