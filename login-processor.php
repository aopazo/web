<?php

$test="on";

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
	echo $varCorreo = safe($_POST['correo']);
	echo $varContra = safe($_POST['contra']);
	$login_query = mysql_query("SELECT * FROM $table WHERE (correo = '" . $varCorreo . "')");
	$userdata = mysql_fetch_array($login_query);

	if (mysql_num_rows($login_query) == 1) {
		// Check username and password match
		if(crypt($varContra, $userdata['contrasena']) == $userdata['contrasena']){
			// Set username session variable
			if($userdata['nombres']==null || $userdata['nombres']=="")	$_SESSION['username'] = $userdata['correo'];
																else	$_SESSION['username'] = $userdata['nombres'];
			$_SESSION['id'] = $userdata['id'];
			$_SESSION['rut'] = $userdata['rut'];
			$_SESSION['plan'] = $userdata['tipo_plan'];
			$_SESSION['correo'] = $varCorreo;
			$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['correo_validado'] = false;
			$_SESSION['mailchimp_suscrito'] = false;
			$_SESSION['expirado'] = false;
			(strpos($_SERVER["HTTP_REFERER"], "?action=inits") !== false) ? $url_destino = substr($_SERVER["HTTP_REFERER"], 0, -13) : $url_destino = $_SERVER["HTTP_REFERER"];
			// validar que usuario haya completado proceso
			if($userdata['correo_validado']=="1"){ $_SESSION['correo_validado'] = true; }
			if($userdata['mailchimp_suscrito']=="1"){ $_SESSION['mailchimp_suscrito']= true; }

			error_log($size_of_session_estimate = strlen( serialize( $_SESSION ) ),0);
			$url_destino = "inicio";
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
			echo ("	<form name=\"login_form\" action=\"ingreso.php\" method=\"post\">
					<input type=\"hidden\" value=\"\" name=\"errorMessage\" /></form>
					<script language=\"JavaScript\">document.login_form.submit();</script>");
			break;
		case "usuarioExpirado":
			echo ("	<form name=\"login_form\" action=\"ingreso.php\" method=\"post\">
					<input type=\"hidden\" value=\"sessionStartExpiredUser\" name=\"errorMessage\" /></form>
					<script language=\"JavaScript\">document.login_form.submit();</script>");
			break;
		case "usuarioAutorizado":
			echo ("	<form name=\"login_form\" action=\"$url_destino\" method=\"post\">
					<input type=\"hidden\" name=\"errorMessage\" value=\"$message\" /></form>
					<script language=\"JavaScript\">document.login_form.submit();</script>");
			break;
		case "contrasenaIncorrecta":
			echo ("	<form name=\"login_form\" action=\"ingreso.php\" method=\"post\">
					<input type=\"hidden\" value=\"contraError\" name=\"errorMessage\" /></form>
					<script language=\"JavaScript\">document.login_form.submit();</script>");
			break;
		case "correoInexistente":
			echo ("	<form name=\"login_form\" action=\"ingreso.php\" method=\"post\">
					<input type=\"hidden\" value=\"correoError\" name=\"errorMessage\" /></form>
					<script language=\"JavaScript\">document.login_form.submit();</script>");
			break;
	}

}

else if ($_POST['action']=="recover"){
	require_once("connection.php");
	require_once("PHPMailer/class.phpmailer.php");
	$correo = safe($_POST['correo']);
	$data_query = mysql_query("SELECT md52confirm FROM $table WHERE correo = '" . $correo . "'");
	// error_log(print_r("login-processor: data_query:".$data_query, TRUE), 0);
	if (mysql_num_rows($data_query) == 1) {
		$userdata = mysql_fetch_array($data_query);
		// crear nuevo md52confirm y enviarlo por mail
		$nuevoMd5 = md5(substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8));
		$update_query = mysql_query("UPDATE $table SET md52confirm = '".$nuevoMd5."' WHERE correo = '".$correo."'");
		if($update_query){
			$mail = new PHPMailer();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->Host     = "smtp.gmail.com"; // SMTP server
			$mail->SetFrom('noresponder@atempus.cl', 'Robot Atempus');
			$mail->AddReplyTo('noresponder@atempus.cl', 'Robot Atempus');
			$mail->AddAddress($correo, "");
			$mail->Subject  = "Cambio de contrase&ntilde;a en Atempus";
			$mail->Body     = "Estimado usuario,\n\nHemos recibido tu solicitud de cambio de contraseña.\nPara realizar este cambio, ingresa al siguiente enlace http://www.atempus.cl/cambiar_mi_contrasena?token=".$nuevoMd5."\n\nSi crees que este mensaje lo has recibido por error y no deseas cambiar tu contraseña, puedes omitir este correo y ningún dato de tu cuenta será modificado.\n\n Atentamente Equipo Atempus.";
			$mail->AltBody    = "Para ver este mensaje, por favor use un cliente de correo que pueda mostrar mensajes HTML"; // optional, comment out and test
			$mail->MsgHTML(str_replace("\n","<br />",$mail->Body));

			if(!$mail->Send()) {
				error_log(print_r("login-processor:: Correo no se pudo enviar: ".$mail->ErrorInfo, TRUE), 0);
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
	error_log(print_r("login-processor::recover:: message: ".$message." from: ".$correo, TRUE), 0);
	echo ("	<form name=\"login_form\" action=\"respuesta\" method=\"post\">
				<input type=\"hidden\" value=\"" . $message . "\" name=\"message\" /></form>
			<script language=\"JavaScript\">document.login_form.submit();</script>");
	exit();
}

?>