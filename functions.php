<?php

function safe($key) {
	require_once("connection.php");
	$rKey = mysql_real_escape_string($key);
	$rKey = str_replace("\n","",$rKey);
	$rKey = str_replace("\r","",$rKey);
	$rKey = str_replace("'","",$rKey);
    $rKey = str_replace('"','',$rKey);
	return $rKey;
	}

function dv($r){
		$s=1;for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
		return chr($s?$s+47:75);
	}

function encrypt($pass) {
	$salt = sprintf('$2a$%02d$', 7);
	$salt .= substr(str_shuffle('./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') , 0 , 22);
	return crypt($pass, $salt);
	}

	// echo phpinfo();
// echo $e = encrypt("qwe");
// echo "<br />";
// echo crypt("qwe", $e);

function enviaCorreo($de, $deNombre, $para, $paraNombre, $asunto, $mensaje){
	require("PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->SMTPAuth   = true;               // enable SMTP authentication
	$mail->SMTPSecure = "tls";             	// sets the prefix to the servier
	$mail->Host     = "smtp.gmail.com";		// SMTP server
	$mail->SetFrom($de, $deNombre);
	$mail->AddReplyTo($de, $deNombre);		// 'contacto@atempus.cl', 'Equipo Atempus'

	$mail->AddAddress($para, $paraNombre);
	$mail->AddBCC('jose.vaisman@atempus.cl', 'Jose');
	if ($para != "alejandro.opazo@atempus.cl"){
		$mail->AddBCC('alejandro.opazo@atempus.cl', 'Ale');
	}
	$mail->AltBody    = "Para ver este mensaje, por favor use un cliente de correo que pueda mostrar mensajes HTML"; // optional, comment out and test
	$mail->Subject = $asunto;
	$mail->MsgHTML($mensaje);
	$mail->IsHTML(true);
	if(!$mail->Send()) {
		error_log(print_r("connection:: Correo no se pudo enviar: ".$mail->ErrorInfo, TRUE), 0);
		} else {
		error_log(print_r("connection:: Correo enviado a: ".$para, TRUE), 0);
		}
	}

function enviaValidaCorreo($email, $userName, $plan){
	$mailMessageText = "Estimado usuario,<br /><br />Te enviamos este correo pues te estás suscribiendo al ";
	if($plan=="Gratis") $mailMessageText .= "plan Básico y a";
	if($plan=="12000")  $mailMessageText .= "plan Premium Anual y a";
	if($plan=="24000")  $mailMessageText .= "plan Premium BiAnual y a";
	$mailMessageText .=	" las notificaciones que ofrece Atempus.<br /><br />Para terminar tu suscripción, debes realizar estos simples pasos:<br /><br />1. Confirmar tu correo ingresando al siguiente enlace http://www.atempus.cl/confirma_tu_correo?token=".$userName." (también puedes copiarlo y pegarlo en tu navegador)<br />2. Aceptar la suscripción a nuestras notificaciones (que te llegarán luego que confirmes tu correo).";
	$mailMessageText .= "<br /><br />Atentamente,<br />Equipo Atempus.";
	enviaCorreo("contacto@atempus.cl", "Equipo Atempus", $email, "Estimado usuario", "", $mailMessageText);
	}

function toChileanMonth($numeroMes) {
	switch($numeroMes) {
		case 1:
			return "Enero";
		case 2:
			return "Febrero";
		case 3:
			return "Marzo";
		case 4:
			return "Abril";
		case 5:
			return "Mayo";
		case 6:
			return "Junio";
		case 7:
			return "Julio";
		case 8:
			return "Agosto";
		case 9:
			return "Septiembre";
		case 10:
			return "Octubre";
		case 11:
			return "Noviembre";
		case 12:
			return "Diciembre";
	}
	return "No es mes";
}

?>