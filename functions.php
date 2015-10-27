<?php

$timestamp = new DateTime();

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

function iniciarSesion($userdata){
	if($userdata['nombres']==null || $userdata['nombres']=="")	$_SESSION['username'] = $userdata['correo'];
														else	$_SESSION['username'] = $userdata['nombres'];
	$_SESSION['id'] = $userdata['id'];
	$_SESSION['rut'] = $userdata['rut'];
	$_SESSION['plan'] = $userdata['tipo_plan'];
	$_SESSION['correo'] = $userdata['correo'];
	$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
	if($userdata['correo_validado'] == "1") $_SESSION['correo_validado'] = true; else $_SESSION['correo_validado'] = false;
	if($userdata['mailchimp_suscrito'] == "1") $_SESSION['mailchimp_suscrito']= true; else $_SESSION['mailchimp_suscrito'] = false;
	if($userdata['tipo_usuario'] == "9") $_SESSION['expirado'] = true; else $_SESSION['expirado'] = false;
	(strpos($_SERVER["HTTP_REFERER"], "?action=inits") !== false) ? $url_destino = substr($_SERVER["HTTP_REFERER"], 0, -13) : $url_destino = $_SERVER["HTTP_REFERER"];
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
	$mail->AltBody = "Para ver este mensaje, por favor use un cliente de correo que pueda mostrar mensajes HTML"; // optional, comment out and test
	$mail->Subject = $asunto;
	$mail->MsgHTML($mensaje);
	$mail->IsHTML(true);
	if(!$mail->Send()) {
		error_log("\nfunctions:: Correo: ".$asunto." no se pudo enviar a: ".$para.", codigo de error: " .$mail->ErrorInfo, 3, "error.log");
		} else {
		error_log("\nfunctions:: Correo: ".$asunto." enviado a: ".$para, 3, "transactions.log");
		}
	}

function enviar_bienvenida_mailchimp($row){
    require_once('inc/Mailchimp.php');
    try {
        $MailChimp = new Mailchimp($apikey); // v2.0.6
    } catch (Mailchimp_Error $e) {
        error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: problemas al crear mailchimp wrapper: ".$e, 3, "error.log");
    }
    
    $merge_vars = array('EMAIL'=>$row['correo'], 'FNAME'=>$row['nombres'], 'LNAME'=>$row['apellidos'], 'DESFC'=>'0', 'ACTIVO'=>'SI'); // usuario queda activo pero con desfase hasta que se confirme su pago
    $returned_value_array = $MailChimp->lists->subscribe($listId, array( 'email' => $row['correo'] ), $merge_vars);

    if (empty($returned_value_array['leid'])) {
        error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: problemas al dar de alta el correo ".$correo.". Valores retornados: email: ".$returned_value_array['email'].", euid: ".$returned_value_array['euid'].", leid empty", 3, "error.log");
    } else {
        error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: correo dado de alta en MC. Valores retornados: email: ".$returned_value_array['email'].", euid: ".$returned_value_array['euid'].", leid ".$returned_value_array['leid'], 3, "transactions.log");
    }
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