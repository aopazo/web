<?php

$test="on";
$action = "inicio";
$errorMessage = "";
$timestamp = new DateTime();

// Inialize session
session_start();

if (!isset($_POST['action'])){
    header('Location: inicio');
}

else if ($_POST['action']=="logout"){
	$_SESSION = array();
	// Delete all session variables
	session_unset();
	session_destroy();
	header('Location: inicio');
	// header('Location: '.$_SERVER["HTTP_REFERER"]);
	exit();
}

else if ($_POST['action']=="login"){
	// Connnector
	require_once("connection.php");
	require_once("functions.php");

	// Retrieve username and password from database according to user's input
	$varCorreo = safe($_POST['correo']);
	$varContra = safe($_POST['contra']);
	if ($test=="on") { error_log("login-processor:: ".$varCorreo." --- ".$varContra." <br />", 3, "debug.log"); }
	$login_query = mysql_query("SELECT * FROM $table WHERE (correo = '" . $varCorreo . "')");
	$userdata = mysql_fetch_array($login_query);

	if (mysql_num_rows($login_query) == 1) {
		// Check username and password match
		if(crypt($varContra, $userdata['contrasena']) == $userdata['contrasena']){
			// iniciar session
			iniciarSesion($userdata);

			error_log("tamaño de la sesion".$size_of_session_estimate = strlen( serialize( $_SESSION ) ),0);
			// $url_destino = "inicio";
			$message = "sessionStart";
			$caso="usuarioAutorizado";

		} else {  //contraseña incorrecta
			$_SESSION = array();
			// Delete all session variables
			session_unset();
			session_destroy();
			$caso="contrasenaIncorrecta";
		}
	} else {	// correo inexistente en BD
	$caso="correoInexistente";
	}

if ($test=="on") echo "$varCorreo $varContra $caso ";

	switch ($caso) {
		case "usuarioNoHaValidadoEmail":   // llevar al usuario a mis datos (misdatos.php) y recomendaciones debe estar bloqueado en el header
			$action = "usuario";
			$errorMessage = "";
			break;
		case "usuarioExpirado":
			$action = "usuario";
			$errorMessage = "sessionStartExpiredUser";
			break;
		case "usuarioAutorizado":
			$action = "usuario";
			$errorMessage = $message;
			break;
		case "contrasenaIncorrecta":
			$action = "ingreso";
			$errorMessage = "contraError";
			break;
		case "correoInexistente":
			$action = "ingreso";
			$errorMessage = "correoError";
			break;
	}
}

else if ($_POST['action']=="recover"){
	require_once("connection.php");
	require_once("PHPMailer/class.phpmailer.php");
	$correo = safe($_POST['correo']);
	$data_query = mysql_query("SELECT nombres, md52confirm FROM $table WHERE correo = '" . $correo . "'");
	// error_log(print_r("login-processor: data_query:".$data_query, TRUE), 0);
	if (mysql_num_rows($data_query) == 1) {
		$userdata = mysql_fetch_array($data_query);
		// crear nuevo md52confirm y enviarlo por mail
		$nuevoMd5 = md5(substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8));
		$update_query = mysql_query("UPDATE $table SET md52confirm = '".$nuevoMd5."' WHERE correo = '".$correo."'");
		if($update_query){
			$de = "contacto@atempus.cl";
			$deNombre = "Contacto Atempus";
			$para = $correo;
			$paraNombre = $userdata[nombres];
			$asunto = "Cambio de contrase&ntilde;a en Atempus";
			$mensaje = "Estimado usuario,\n\nHemos recibido tu solicitud de cambio de contraseña.\nPara realizar este cambio, ingresa al siguiente enlace http://www.atempus.cl/cambiar_mi_contrasena?token=".$nuevoMd5."\n\nSi crees que este mensaje lo has recibido por error y no deseas cambiar tu contraseña, puedes omitir este correo y ningún dato de tu cuenta será modificado.\n\n Atentamente Equipo Atempus.";
			enviaCorreo($de, $deNombre, $para, $paraNombre, $asunto, $mensaje);

			if(!$mail->Send()) {
				error_log("\n".$timestamp->format('Y-m-d H:i:s')." login-processor::recover:: Correo ".$asunto." a ".$para." no se pudo enviar ErrorInfo: ".$mail->ErrorInfo, 3, "error.log");
			} else {
				$message="recoveryOK";
			}
		}
		else{
			$message="Hubo un problema al intentar reestablecer tu contrase&ntilde;a. Por favor, int&eacute;ntalo de nuevo.";
		}
	}
	else{
		$message="No encontramos este correo en nuestros registros. <br /><br />Por favor, intentalo de nuevo.";
	}
	error_log("\n".$timestamp->format('Y-m-d H:i:s')." login-processor::recover:: message: ".$message." from: ".$correo, 3, "transactions.log");
	$action = "respuesta";
	$errorMessage = $message;
}

?>

<body>
<html>
	<form name="login_form" action="<?php echo $action; ?>" method="post">
		<input type="hidden" value="<?php echo $errorMessage; ?>" name="errorMessage" />
	</form>
	<script language="JavaScript">
		document.login_form.submit();
	</script>
</body>
</html>