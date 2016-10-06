<?php

// error_log("\n".date("Y/m/d H:i:s")." functions:: sesion correo ".$_SESSION['correo'], 3, "debug.log");

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

// echo encrypt("qwe");

function iniciarSesion($userdata){
	if($userdata['nombres']==null || $userdata['nombres']=="")
        {
            $_SESSION['username'] = $userdata['correo'];
        } else {
            $_SESSION['username'] = $userdata['nombres'];
        }
	$_SESSION['id'] = $userdata['id'];
	$_SESSION['rut'] = $userdata['rut'];
	$_SESSION['plan'] = $userdata['tipo_plan'];
	$_SESSION['correo'] = $userdata['correo'];
	$_SESSION['vp'] = $userdata['vp'];
	$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
	if($userdata['correo_validado'] == "1") {
            $_SESSION['correo_validado'] = true;
        } else {
            $_SESSION['correo_validado'] = false;
        }
	if($userdata['mailchimp_suscrito'] == "1") {
            $_SESSION['mailchimp_suscrito']= true;
        } else {
            $_SESSION['mailchimp_suscrito'] = false;
        }
	if($userdata['tipo_usuario'] == "9") {
            $_SESSION['expirado'] = true;
        }
        else {
            $_SESSION['expirado'] = false;
        }
	(strpos($_SERVER["HTTP_REFERER"], "?action=inits") !== false) ? $url_destino = substr($_SERVER["HTTP_REFERER"], 0, -13) : $url_destino = $_SERVER["HTTP_REFERER"];
	}

function enviaCorreo($de, $deNombre, $para, $paraNombre, $asunto, $mensaje){
	require("PHPMailer/class.phpmailer.php");
	$para = str_replace("%2B", "+", $para);
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
    $mail->CharSet = 'UTF-8';
	if(!$mail->Send()) {
		error_log("\nfunctions:: Correo con asunto:\"".$asunto."\" no se pudo enviar a: ".$para.", codigo de error: " .$mail->ErrorInfo, 3, "error.log");
		} else {
		error_log("\nfunctions:: Correo con asunto:\"".$asunto."\" enviado a: ".$para, 3, "transactions.log");
		}
	}

function enviar_bienvenida_mailchimp($correo, $nombres, $apellidos){
    require("connection.php");
    require("inc/Mailchimp.php");
    $merge_vars = array('EMAIL'=>$correo, 'FNAME'=>$nombres, 'LNAME'=>$apellidos, 'DESFC'=>'0', 'ACTIVO'=>'SI'); // usuario queda activo pero con desfase hasta que se confirme su pago
    try {
        $MailChimp = new Mailchimp($apikey); // v2.0.6
    } catch (Mailchimp_Error $e) {
        error_log("\n".date("Y-m-d H:i:s")." functions:: problemas al crear mailchimp wrapper: ".$e, 3, "error.log");
    }
    try {
		$returned_value_array = $MailChimp->lists->subscribe($listId, array( 'email' => $correo ), $merge_vars);
    } catch (Mailchimp_Error $e) {
        error_log("\n".date("Y-m-d H:i:s")." functions:: problemas al suscribir al usuario: ".$e->getMessage()." apikey: ".$apikey, 3, "error.log");
    }

	if (empty($returned_value_array['leid'])) {
        error_log("\n".date("Y-m-d H:i:s")." functions:: problemas al dar de alta el correo ".$correo.". Valores retornados: email: ".$returned_value_array['email'].", euid: ".$returned_value_array['euid'].", leid empty", 3, "error.log");
    } else {
        error_log("\n".date("Y-m-d H:i:s")." functions:: correo dado de alta en MC. Valores retornados: email: ".$returned_value_array['email'].", euid: ".$returned_value_array['euid'].", leid ".$returned_value_array['leid'], 3, "transactions.log");
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


function enviaCorreoValidacion($plan, $correo, $md5){
    $de = "contacto@atempus.cl";
    $deNombre = "Equipo Atempus";
    $para = $correo;
    $paraNombre = "";
    $asunto = "Suscripción Atempus";

    $mensaje = "Estimado usuario,<br /><br />Te enviamos este correo pues te est&aacute;s suscribiendo al ";
    if($plan=="Gratis") {
        $mensaje .= "plan B&aacute;sico y a";
    }
    if($plan=="12000")  {
        $mensaje .= "plan Premium Anual y a";
    }
    if($plan=="24000")  {
        $mensaje .= "plan Premium BiAnual y a";
    }
    $mensaje .=	" las notificaciones que ofrece Atempus.<br /><br />Para terminar tu suscripci&oacute;n, debes realizar estos simples pasos:<br /><br />1. Confirmar tu correo ingresando al siguiente enlace http://www.atempus.cl/confirma_tu_correo?token=".$md5." (tambi&eacute;n puedes copiarlo y pegarlo en tu navegador)<br />2. Aceptar la suscripci&oacute;n a nuestras notificaciones (que te llegar&aacute;n luego que confirmes tu correo).";
    $mensaje .= "<br /><br />Atentamente,<br />Equipo Atempus.";

    enviaCorreo($de, $deNombre, $para, $paraNombre, $asunto, $mensaje);
}

function actualizarDB($campos, $valores){
   	require_once("connection.php");
    $set = "";
    for ($i = 0; $i <= count($campos); $i++) {
        $set .= " ".$campos[$i]." = '".$valores[$i]."', ";
    }
    $sql = "UPDATE $table SET $set where id = ".$_SESSION['id'];
}

// $campos = array('nombres', 'apellidos', 'rut');
// $valores[0] = "ale";
// $valores[1] = "opazo";
// $valores[2] = "14";
// actualizarDB($campos, $valores);

function getDatosUsuario($correo){
	require("connection.php");
	$result = mysql_query("SELECT * FROM $table WHERE correo = '".$correo."'");
	// if sale mal la consulta :(
	$userdata = mysql_fetch_array($result);
    return $userdata;
}

?>