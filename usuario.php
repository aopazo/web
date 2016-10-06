<?php 
	// Inialize session
	session_start();
	error_log("\n".date("Y/m/d H:i:s")." usuario:: sesion correo ".$_SESSION['correo'], 3, "debug.log");
	require_once("connection.php");
	require_once("functions.php");
	error_log("\n".date("Y/m/d H:i:s")." usuario:: sesion correo ".$_SESSION['correo'], 3, "debug.log");

    $correo = $_SESSION['correo'];
    $userdata = getDatosUsuario($_SESSION['correo']);
	$result = mysql_query("SELECT * FROM $table WHERE correo = '".$correo."'");
	// if sale mal la consulta :(
	if(mysql_num_rows($result) == 0 || $correo == "") {
		header("Location: $URL");
	} else {
		$userdata = mysql_fetch_array($result);
		$_SESSION['correo_validado'] = $userdata['correo_validado'];
		$_SESSION['mailchimp_suscrito'] = $userdata['mailchimp_suscrito'];
	}

    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    if($message == "correoValidadoAnteriormente") {
		echo "<script languaje=’javascript’>alert('Tu correo ya ha sido validado, no es necesario validarlo nuevamente.')</script>"; 
        $message = "";
    }
    if($message == "correoValidado") {
        echo "<script languaje=’javascript’>alert('Gracias por confiar en nosotros.\n\nTu correo ha sido validado y tu sesi\u00f3n ha sido iniciada.\n\nPara culminar el proceso de suscripci\u00f3n s\u00f3lo falta que aceptes tu suscripci\u00f3n a la lista de correos para recibir las alertas de Atempus.'</script>"; 
        $message = "";
    }
	
	// $popup = "";
	// if (isset($_GET['popup'])) $popup = $_GET['popup'];
?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Usuario - AFP | Atempus</title>		
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
										<a href="#facturacion" data-toggle="tab"><i class="fa fa-file-text-o"></i> Facturaci&oacute;n</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="usuario" class="tab-pane active">
										<h4 class="mb-none">Datos de usuario</h4>
										<br>
										<span id="mail"><b>E-mail:</b> <?php echo $_SESSION['correo']; ?></span><br /><br />
										<span class="width:30%"id="suscripcion"><b>Suscripci&oacute;n e-mail:</b></span>
												<?php if ($_SESSION['mailchimp_suscrito'] == 1) : ?>
													<span class="label label-success">E-mail suscrito </span><br /><br />
												<?php else : ?>
													<span class="label label-danger">E-mail no suscrito </span>&nbsp;
													<button type="button" id="buttonReenviarSuscripcion" class="btn btn-borders btn-default btn-xs"><i class="fa fa-send"></i> reenviar e-mail de suscripci&oacute;n</button><br />
													<span class="width:30%">&nbsp;&nbsp;</span><span><small><i>&nbsp;&nbsp; tu suscripci&oacute;n podr&iacute;a tardar hasta 4 horas en verse reflejada </i></small></span><br /><br />
												<?php endif ; ?>
										<span id="contrasena"><b>Contrase&ntilde;a:</b> ******** <button id="editarclave" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></span>
										<form style="display:none" id="formcambioclave" action="JavaScript:OcultarFormClaveyQuizasMostrarModal('#formcambioclave', '#ModalCambioClave', 0);" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<input type="password" value="" placeholder="Actual contrase&ntilde;a (*)" data-msg-required="Ingresa tu actual contrase&ntilde;a." maxlength="20" class="form-control valid input-sm" name="passwordactual" id="passwordactual" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3">
														<input type="password" value="" placeholder="Nueva contrase&ntilde;a (*)" data-msg-required="Ingresa tu nueva contrase&ntilde;a." maxlength="20" class="form-control valid input-sm" name="password" id="password" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3">
														<input type="password" value="" placeholder="Repetir nueva contrase&ntilde;a (*)" data-msg-required="Repite tu nueva contrase&ntilde;a." data-msg-equalTo="No ingresaste la misma contrase&ntilde;a." maxlength="20" class="form-control valid input-sm" name="password_repetir" id="password_repetir" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3">
														<button id="buttonGuardarCambioClave" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
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
														<h4 class="modal-title" id="myModalLabel">Actualizaci&oacute;n de contrase&ntilde;a</h4>
													</div>
													<div id="ModalCambioClaveMensaje" class="modal-body">
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div>

									
									</div>
									<div id="facturacion" class="tab-pane">
										<h4 class="mb-none">Datos de facturaci&oacute;n</h4>
										<br>
										<p><b>Nombre: </b><span id="nombres"><?php echo $userdata['nombres']; ?></span>
										                  <span id="apellidos"><?php echo $userdata['apellidos']; ?></span></p>
										<p><b>RUT: </b><span id="rut"><?php echo $userdata['rut']; ?></span> </p>
										   <!-- <button id="editarrut" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button>
										<form style="display:none" id="formcambiorut" action="JavaScript:OcultarFormRUTyQuizasMostrarModal('#formcambiorut', '#ModalCambioRut', '#rut', 0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="rut" value="" placeholder="Ejemplo: 12345XXX-X" data-msg-required="Ingresa tu RUT." data-msg-rut="Ingresa un RUT v&aacute;lido (ej: 12345XXX-X)." maxlength="20" class="form-control valid input-sm" name="rut" id="rut" required="" aria-required="true" aria-invalid="false">
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
														<h4 class="modal-title" id="myModalLabel">Actualizaci&oacute;n de RUT</h4>
													</div>
													<div class="modal-body">
														Se ha actualizado tu RUT. Esta modificaci&oacute;n se ver&aacute; reflejada en futuras facturaciones, pero no necesariamente en facturaciones en curso.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</button>
													</div>
												</div>
											</div>
										</div> -->
										<p><b>Direcci&oacute;n:</b> <span id="direccion_completa"><?php echo $userdata['direccion']; ?>, <?php echo $userdata['comuna']; ?>, <?php echo $userdata['ciudad']; ?>, <?php echo $userdata['region']; ?></span> <button id="editardireccion" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-pencil"></i> editar</button></p>
										<form style="display:none" id="formcambiodireccion" action="JavaScript:OcultarFormDireccionyQuizasMostrarModal('#formcambiodireccion', '#ModalCambioDireccion', '#direccion', '#comuna', '#ciudad', '#region', 0)" novalidate="novalidate">
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="text" value="" placeholder="Direcci&oacute;n" data-msg-required="Ingresa tu direcci&oacute;n." maxlength="100" class="form-control valid input-sm" name="direccion" id="direccion" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-4">
														<input type="text" value="" placeholder="Comuna" data-msg-required="Ingresa tu comuna." maxlength="100" class="form-control valid input-sm" name="comuna" id="comuna" required="" aria-required="true" aria-invalid="false">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="form-group">
													<div class="col-md-4">
														<input type="text" value="" placeholder="Ciudad" data-msg-required="Ingresa tu ciudad." maxlength="100" class="form-control valid input-sm" name="ciudad" id="ciudad" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-4">
														<input type="text" value="" placeholder="Regi&oacute;n" data-msg-required="Ingresa tu regi&oacute;n." maxlength="100" class="form-control valid input-sm" name="region" id="region" required="" aria-required="true" aria-invalid="false">
													</div>
													<div class="col-md-3 col-md-offset-1">
														<button id="buttonGuardarCambioDireccion" value="Guardar" class="btn btn-primary btn-sm" data-loading-text="Guardando...">Guardar</button>
														<button type="button" onclick="JavaScript:OcultarFormDireccionyQuizasMostrarModal('#formcambiodireccion','','','','','',1)" value="Cancelar" class="btn btn-borders btn-default btn-sm" data-loading-text="Guardando...">Cancelar</button>
													</div>
												</div>
											</div>
										</form>

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
		
        <!-- Boton para guardar cambios de CLAVE -->
		<script>
			$('#buttonGuardarCambioClave').click(function(e){
				$.ajax({
					url: 'form-processor.php',
					type: 'post',
					data: {
						section: "actualizarContrasena",
						contrasena_antes: $("#passwordactual").val(),
						contrasena: $("#password").val(),
						contrasena_repetir: $("#password_repetir").val()
					},
					success: function(result) {
						switch (result){
							case ("contrasenaActualVacia"):
								var mensaje = "Debes ingresar tu contrase&ntilde;a"; break;
							case ("contrasenaNuevaVacia"):
								var mensaje = "Tu nueva contrase&ntilde;a no puede ser vac&iacute;a"; break;
							case ("contrasenaRepetirVacia"):
								var mensaje = "Debes repetir tu contrase&ntilde;a"; break;
							case ("contrasenasNoCoinciden"):
								var mensaje = "Tus contrase&ntilde;as no coinciden"; break;
							case ("contrasenaMuyCorta"):
								var mensaje = "Tu contrase&ntilde;a debe tener al menos 6 caracteres"; break;
							case ("contrasenaActualNOK"):
								var mensaje = "La contrase&ntilde;a actual que ingresaste no coincide con nuestros registros. Int&eacute;ntalo de nuevo"; break;
							case ("contrasenaActualizadaOK"):
								var mensaje = "Se ha actualizado tu contrase&ntilde;a"; break;
							case ("contrasenaActualizadaNOK"):
								var mensaje = "No hemos podido actualizar tu contrase&ntildea<br />Int&eacute;ntalo m&aacute;s tarde"; break;
							default: 
								var mensaje = "No hemos podido actualizar tu contrase&ntildea<br />Int&eacute;ntalo m&aacute;s tarde"; break;
						}
						$('#ModalCambioClaveMensaje').html(mensaje);
						$('#ModalCambioClave').modal({show: 'true'});
					}
				});
			});
		</script>

        <!-- Boton para guardar cambios de DIRECCION -->
		<script>
			$('#buttonGuardarCambioDireccion').click(function(e){
				var direccion_completa = $("#direccion").val()+', '+$("#comuna").val()+', '+$("#ciudad").val()+', '+$("#region").val();
				$.ajax({
					url: 'form-processor.php',
					type: 'post',
					data: {
						section: "actualizarDireccion",
						direccion: $("#direccion").val(),
						comuna: $("#comuna").val(),
						ciudad: $("#ciudad").val(),
						region: $("#region").val()
					},
					success: function(result) {
						//alert(result);
						if(result=="datosVacios"){
                            $('#myModalTitle').html('Cambio de Dirección');
                            $('#myModalBody').html('Tu dirección no parece completa. Por favor, llena todos los campos.');
							$('#ModalGenerico').modal({show: 'true'});
						}
						else if(result=="direccionActualizadaOK"){
                            $('#myModalTitle').html('Cambio de Dirección');
                            $('#myModalBody').html('Tu direcci&oacute;n ha sido actualizada correctamente');
							$('#ModalGenerico').modal({show: 'true'});
							$('#direccion_completa').html(direccion_completa);
						}
						else if(result=="direccionActualizadaNOK"){
                            $('#myModalTitle').html('Cambio de Dirección');
                            $('#myModalBody').html('No hemos podido actualizar tu direcci&oacute;n. Int&eacute;ntalo m&aacute;s tarde.');
							$('#ModalGenerico').modal({show: 'true'});
						}
					}
				});
			});
		</script>
		
        <!-- Boton para REENVIAR MAILCHIMP -->
		<script>
			$('#buttonReenviarSuscripcion').click(function(e){
                            var ajaxurl = 'api/envio_correo.php';
                            data = {'correo': '<?php echo $correo ?>',
                                    'action': 'suscripcion'};
                            $.post(ajaxurl, data, function (response) {
                                //TODO: Seria bueno tomar el response y mostrarlo en el modal de alguna manera
									$('#myModalLabel').html('Reenvío de Correo');
									$('#ModalCambioClaveMensaje').html('Te hemos reenviado el correo a: <?php echo $correo ?>');
									$('#ModalCambioClave').modal({show: 'true'});
                            });
                        });
		</script>
                
        <!-- Boton para REENVIAR VERIFICACION -->
        <script>
			$('#buttonReenviarValidacion').click(function(e){
                            var ajaxurl = 'api/envio_correo.php';
                            data = {'correo': '<?php echo $correo ?>',
                                    'action': 'validacion'};
                            $.post(ajaxurl, data, function (response) {
                                //TODO: Seria bueno tomar el response y mostrarlo en el modal de alguna manera
                            });
                        });
		</script>
	</body>
</html>
<?php
 // Mas manejo de errores
 
 // ARREGLAR
	// if(isset($_REQUEST['errorMessage'])) {
		// if ($_REQUEST['errorMessage'] != "") {
			// echo "<script languaje=’javascript’>"
				// . "$('#myModalTitle').html('Notificación');"
				// . "$('#myModalBody').html('".$_REQUEST['errorMessage']."');"
				// . "$(document).ready(MostrarModal('#ModalGenerico'));"
				// . "</script>";
        // }
	// }

?>