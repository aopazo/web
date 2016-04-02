<?php
	// Inialize session
	session_start();
	require_once("connection.php");
	require_once("functions.php");
	require_once("getFormData.php");

    $userdata = getDatosUsuario($_SESSION['correo']);
    // TODO: Seria bueno sacar el flag de debug a connection, que es privado y local
	$test = true;

	// if(isset($_POST['section'])) { $section = safe($_POST['section']); }
	// else { header('Location: inicio'); }

	$validarActive = "";
	$suscripcionActive = "";
	$facturacionActive = "";
	$transferenciaActive = "";
	
	if(!empty($section)) { 
		if      ($section=="usuarioActive")       $usuarioActive="active";
		else if ($section=="validarActive")       $validarActive="active";
		else if ($section=="suscripcionActive")   $suscripcionActive="active";
		else if ($section=="facturacionActive")   $facturacionActive="active";
		else if ($section=="transferenciaActive") $transferenciaActive="active";
		}
	else{
                // Condicion de entrada, se muestra primero tab "Usuario"
		$usuarioActive="active";
	}

	if($test) {
		// $usuarioActive="active";
		// $validarActive="active";
		// $suscripcionActive="active";
		// $facturacionActive="active";
		// $transferenciaActive="active";
		}

	if(isset($_POST['renovacion'])) {
        if($_POST['renovacion']=="enproceso") $_SESSION['vp']="enproceso";
    }
	if(isset($_POST['errorMessage'])) { echo "<br />".$_POST['errorMessage']; }
	
	if($test){
            echo "requestplan".$_REQUEST['plan'];
            isset($_SESSION['username'])?:$_SESSION['username']="n/a";
            isset($_SESSION['correo_validado'])?:$_SESSION['correo_validado']=FALSE;
            echo "<br />TEST:plan: ".$plan;
//            echo "<br />TEST:varplan: ".$varPlan;
//            echo "<br />TEST:section: ".$section;
//            echo "<br />TEST:correo: ".$correo;
//            echo "<br />TEST:sessionusername: ".$_SESSION['username'];
            echo "<br />TEST:sessioncorreovalidado: ".$_SESSION['correo_validado'];
            echo "<br />TEST:sessionVP: ".$_SESSION['VP'];
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
									<li class="active">
										<a href="#registro" data-toggle="tab" aria-expanded="false"><i class="fa fa-user"></i> Usuario<span></span></a>
									</li>
									<li class="disable">
										<a href="#validar" aria-expanded="false"><i class="fa fa-check-square-o"></i> Validaci&oacute;n<span></span></a>
									</li>
                                    <li class="disable">
                                        <a href="#facturacion" aria-expanded="false"><i class="fa fa-file-text-o"></i> Datos para facturaci&oacute;n<span></span></a>
                                    </li>
                                    <li class="disable">
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
															<input type="email" value="aopazo@gmail.com" data-msg-required="Ingresa tu e-mail." data-msg-email="Ingresa un e-mail valido." maxlength="100" class="form-control valid input-lg" name="correo" id="correo" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-6">
															<label>Repetir e-mail (*)</label>
															<input type="email" value="aopazo@gmail.com" data-msg-required="Repite tu e-mail." data-msg-equalTo="No ingresaste el mismo e-mail." maxlength="100" class="form-control valid input-lg" name="correo_repetir" id="correo_repetir" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Contrase&ntilde;a (*)</label>
															<input type="password" value="qwe" data-msg-required="Ingresa tu contrase&ntilde;a." maxlength="20" class="form-control valid input-lg" name="contrasena" id="contrasena" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-6">
															<label>Repetir Contrase&ntilde;a (*)</label>
															<input type="password" value="qwe" data-msg-required="Repite tu contrase&ntilde;a." data-msg-equalTo="No ingresaste la misma contrase&ntilde;a." maxlength="20" class="form-control valid input-lg" name="contrasena_repetir" id="contrasena_repetir" required="" aria-required="true" aria-invalid="false">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-4">
															<label>Codigo de verificaci&oacute;n (*)</label>
															<!--
															<input type="text" value="" maxlength="6" data-msg-captcha="C&oacute;digo erroneo." data-msg-required="Ingresa el c&oacute;digo de verificaci&oacute;n." class="form-control input-lg captcha-input" name="captcha" id="captcha" aria-required="true">
															USE RECAPTCHA  
															-->
															<input type="text" value="a" maxlength="6" data-msg-required="Ingresa el c&oacute;digo de verificaci&oacute;n." class="form-control valid input-lg" required="" aria-required="true">
														</div>
														<div class="col-md-8 captcha" style = "clear: none;	margin-bottom: 0px;	margin-top: 10px;">
															<div class="captcha-image">
																<img id="captcha-image" src="custom/img_custom/captcha.png" alt="CAPTCHA code">
															</div>
															<div class="captcha-refresh">
																<a href="#" id="refreshCaptcha"><i class="fa fa-refresh"></i></a>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-8">
															<div class="checkbox-group" data-msg-required="Debes aceptar los requisitos.">
																<label class="checkbox-inline">
																	<input type="checkbox" name="checkboxes" id="inlineCheckbox1" value="option1" checked> Acepto los <a href="terminos_y_condiciones" target="_blank">T&eacute;rminos y Condiciones</a>, la <a href="politica_de_privacidad" target="_blank">Pol&iacute;tica de Privacidad</a> y los t&eacute;rminos expresados en el <a href="http://www.atempus.cl/contratos/
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
																</label>
															</div>
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
													<?php if($_SESSION['correo_validado'] == "0") : ?>
														<!-- <form id="formValidacion" action="form-processor" method="post" novalidate="novalidate"> -->
														<p>Te hemos enviado un e-mail para validar tu direcci&oacute;n de correo electr&oacute;nico. Rev&iacute;salo y pincha el link de validaci&oacute;n para poder continuar.</p>
														<p>¿No has recibido el e-mail de validaci&oacute;n? Escríbenos <a href="contactanos">ac&aacute;</a> para reenvi&aacute;rtelo.</p>
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
															<input type="text" value="<?php echo $userdata['nombres']; ?>" data-msg-required="Ingresa tus nombres." maxlength="200" class="form-control input-lg" name="nombres" id="nombres" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-4">
															<label>Apellidos</label>
															<input type="text" value="<?php echo $userdata['apellidos']; ?>" data-msg-required="Ingresa tus apellidos." maxlength="200" class="form-control input-lg" name="apellidos" id="apellidos" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-4">
															<label>RUT</label>
															<input type="rut" value="<?php echo $userdata['rut']; ?>" data-msg-required="Ingresa tu RUT." data-msg-rut="Ingresa un RUT v&aacute;lido (ej: 12345XXX-X)." maxlength="20" class="form-control input-lg" name="rut" id="rut" required="" aria-required="true" aria-invalid="false" placeholder="ej: 12345XXX-X">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label>Direcci&oacute;n</label>
															<input type="text" value="<?php echo $userdata['direccion']; ?>" data-msg-required="Ingresa tu direcci&oacute;n." maxlength="200" class="form-control input-lg" name="direccion" id="direccion" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-3">
															<label>Comuna</label>
															<input type="text" value="<?php echo $userdata['comuna']; ?>" data-msg-required="Ingresa tu comuna." maxlength="200" class="form-control input-lg" name="comuna" id="comuna" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-3">
															<label>Ciudad</label>
															<input type="text" value="<?php echo $userdata['ciudad']; ?>" data-msg-required="Ingresa tu ciudad." maxlength="200" class="form-control input-lg" name="ciudad" id="ciudad" required="" aria-required="true" aria-invalid="false">
														</div>
														<div class="col-md-3">
															<label>Regi&oacute;n</label>
															<input type="text" value="<?php echo $userdata['region']; ?>" data-msg-required="Ingresa tu regi&oacute;n." maxlength="200" class="form-control input-lg" name="region" id="region" required="" aria-required="true" aria-invalid="false">
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

<!--		<script>
			$('button').click(function(e){
				e.preventDefault();
				// alert("hola");
				$.ajax({
					url: 'form-processor.php',
					success: function(result) {
						if(result=="holi")
							alert ("lala");
						// $('#div1').html(result);
					}
				});
			});
		</script>
-->

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
		echo "<script languaje=’javascript’>"
                    . "$('#myModalTitle').html('Notificación');"
                    . "$('#myModalBody').html('".$_POST['errorMessage']."');"
                    . "$(document).ready(MostrarModal('#ModalGenerico'));"
                    . "</script>";
            }
		/*
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
                 */
	}

?>