<?php
// TODO: sacar test a connection
        $test_getFormData = TRUE;

	$datos = "";
	$plan = "";
	$nombres = "";
	$apellidos = "";
	$rut = "";
	$direccion = "";
	$comuna = "";
	$ciudad = "";
	$region = "";
	$telefono = "";
	$correo = "";
	$correo_repetir = "";
	$contrasenaAntes = "";
	$contrasena = "";
	$contrasena_repetir = "";
	$mensaje = "";
	$errorMensaje = "";
	$captcha = "";
	$section = "";

	if(isset($_POST['datos'])) { $datos = safe($_POST['datos']); } // puede ser actualizar, ingresar, contactar
	if(isset($_POST['plan'])) { $plan = safe($_POST['plan']); } // puede ser gratis, 12000, 20400
	if(isset($_POST['nombres'])) { $nombres = safe($_POST['nombres']); }
	if(isset($_POST['apellidos'])) { $apellidos = safe($_POST['apellidos']); }
	if(isset($_POST['rut'])) { $rut = safe($_POST['rut']); }
	if(isset($_POST['direccion'])) { $direccion = safe($_POST['direccion']); }
	if(isset($_POST['comuna'])) { $comuna = safe($_POST['comuna']); }
	if(isset($_POST['ciudad'])) { $ciudad = safe($_POST['ciudad']); }
	if(isset($_POST['region'])) { $region = safe($_POST['region']); }
	if(isset($_POST['telefono'])) { $telefono = safe($_POST['telefono']); }
	if(isset($_POST['correo'])) { $correo = safe($_POST['correo']); }
	if(isset($_POST['correo_repetir'])) { $correo_repetir = safe($_POST['correo_repetir']); }
	if(isset($_POST['contrasena_antes'])) { $contrasena_antes = safe($_POST['contrasena_antes']); }
	if(isset($_POST['contrasena'])) { $contrasena = safe($_POST['contrasena']); }
	if(isset($_POST['contrasena_repetir'])) { $contrasena_repetir = safe($_POST['contrasena_repetir']); }
	if(isset($_POST['mensaje'])) { $mensaje = safe($_POST['mensaje']); }
	if(isset($_POST['errorMensaje'])) { $errorMensaje = safe($_POST['errorMensaje']); }
	if(isset($_POST['captcha'])) { $captcha = safe($_POST['captcha']); }
	if(isset($_POST['section'])) { $section = safe($_POST['section']); }

	if ($test_getFormData) {
            echo "GetFormData - Section: ".$section;
        }

	// if(isset($_SESSION['plan'])) { $plan = $_SESSION['plan']; }
	// if(isset($_SESSION['correo'])) { $correo = $_SESSION['correo']; }

?>