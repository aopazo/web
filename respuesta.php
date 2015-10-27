<?php
	session_start();
	if(isset($_REQUEST['message'])) {
		$message = $_REQUEST['message'];
	}
	else{
		header('Location: inicio'); 
	}
	if(isset($_REQUEST['plan'])) {
		$plan = $_REQUEST['plan'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Atempus - Respuesta</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" type="image/png" href="favicon.png" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="Ale Opazo" />
	<meta name="robots" content="index,follow" />
	<meta name="description" content="Atempus es una compania especializada en la recomendacion de fondos de pension para optimizar y maximizar el monto de tu jubilacion." />
	<meta name="keywords" content="fondo, fondos, pension, jubilacion, recomendacion fondos afp" />

	<!-- photos when sharing site -->
	<meta property="og:site_name" content="Atempus" />
	<meta property="og:title" content="Atempus - Respuesta" />
	<meta property="og:url" content="http://www.atempus.cl/" />
	<meta property="og:image" content="http://www.atempus.c://www.atempus.cl/jpg/atempus_logo_big.jpg" />

	<!-- <link rel="stylesheet" type="text/css" href="atempus.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="atempus-mobile.css" media="only screen and (max-device-width: 480px)" /> -->

</head>

<body>
<?php // include_once("analyticstracking.php"); ?>

	<div id="container">

		<div id="header">
			<?php include("header.php") ?>
		</div>

        <hr />

		<div id="content">
			<div class="title"><h1>
				<?php
					if($message=="sessionStart" || $message=="OK" || $message=="recoveryOK" || $message=="recoveryDoneOK" || $message=="contactoOK" || $message=="CP-Update" || $message=="P-Update" || $message=="pago-realizado"){
						echo ("Operaci&oacute;n exitosa"); }
					else{
						echo ("Operaci&oacute;n NO exitosa"); }
				?>
			</h1></div>
			<div class="spanCentered">
					<?php
						if($message=="OK"){
							echo ("<div><h2 class=\"muted\">Gracias por suscribirte.</h2><h3 class=\"muted\">Te enviamos un correo para que nos confirmes tus datos");
							if($plan!="Gratis") echo ", indic&aacute;ndote las instrucciones para el pago.</h3></div>"; else echo ".</h3></div>";
						}
						// login incorrecto - contraseña incorrecta
						else if($message=="contraError"){
							echo ("<div><h3 class=\"muted\"><ul><li>Contrase&ntilde;a incorrecta.<br /><br /><li>Int&eacute;ntalo de nuevo.</ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"javascript:void(0)\" onclick = \"hidestuff('contacto');hidestuff('paswd');showstuff('light');\" />Ingresar</a><br />&nbsp;";
						}
						// login incorrecto - correo inválido
						else if($message=="correoError"){
							echo ("<div><h3 class=\"muted\"><ul><li>Lo sentimos, no encontramos ese correo en nuetros registros.<br /><br /><li>Reg&iacute;strate primero para poder ver nuestras recomendaciones.</ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"planes\" />Quiero suscribirme!</a><br />&nbsp;";
						}
						// inicio de sesión exitoso
						else if($message=="sessionStart"){
							echo ("<div><h3 class=\"muted\"><ul><li>Bienvenido ".$_SESSION['username'].".<br /><br /><li>Has ingresado exis&oacute;samente a tu cuenta.</ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"mi_cuenta\" />Ir a mi cuenta</a><br />&nbsp;";
						}
						// inicio de sesión exitoso de usuario expirado
						else if($message=="sessionStartExpiredUser"){
							echo ("<div><h3 class=\"muted\"><ul><li>Bienvenido nuevamente ".$_SESSION['username'].".<br /><br /><li>Hemos detectado que tu cuenta expir&oacute; :( Renueva tu plan desde \"Mi cuenta\"</ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"mi_cuenta\" />Ir a mi cuenta</a><br />&nbsp;";
						}
						// inicio de sesión con correo de cliente que aún no ha validado su correo
						else if($message=="loginNVUser"){
							echo ("<div><h3 class=\"muted\"><ul><li>A&uacute;n no has validado tu cuenta. Revisa tu correo y sigue las instrucciones que te enviamos.<br /><br /><li>Si tienes cualquier duda, cont&aacute;ctanos.</ul></h3></div>");
						}
						// cambio de contraseña - luego de que cliente solicita el cambio
						else if($message=="recoveryOK"){
							echo ("<div><h3 class=\"muted\"><ul><li>Solicitaste recuperar tu contrase&ntilde;a.<br /><br /><li>Te enviamos un correo con las instrucciones para recuperarla.</ul></h3></div>");
						}
						// cambio de contraseñ luego de que cliente modifica su nueva contraseña
						else if($message=="recoveryDoneOK"){
							echo ("<div><h3 class=\"muted\"><ul><li>Has modificado tu contrase&ntilde;a.<br /><br /><li>Ya puedes revisar nuestras recomendaciones.</ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"recomendaciones\" />Ir a Recomendaciones</a><br />&nbsp;";
						}
						// luego de enviar un mensaje a atempus
						else if($message=="contactoOK"){
							echo ("<div><h3 class=\"muted\"><ul><li>Hemos recibido tu mensaje.<br /><br /><li>Nos pondremos en contacto contigo a la brevedad.</ul></h3></div>");
						}
						// actualización de datos - contraseña plan
						// else if($message=="CP-Update"){
							// echo ("<div><h3 class=\"muted\"><ul><li>Tu plan, datos y contrase&ntilde;a fueron actualizados exit&oacute;samente.<br /><br /><li>Te enviamos un correo indic&aacute;ndote las instrucciones para el pago.</ul></h3></div>");
							// echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"mi_cuenta\" />Volver a mi cuenta</a><br />&nbsp;";
						// }
						// actualización de datos - sólo plan, no se debería llegar acá, sino a plan exitoso
						// else if($message=="P-Update"){
							// echo ("<div><h3 class=\"muted\"><ul><li>Tu plan fue actualizado exit&oacute;samente.<br /><br /></ul></h3></div>");
							// echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"mi_cuenta\" />Ir a mi cuenta</a><br />&nbsp;";
						// }
						else if($message=="400"){
							echo ("<div><h3 class=\"muted\"><ul><li>Error 400: La solicitud contiene una sintaxis incorrecta.<br /><br /><li>Te invitamos a seguir navegando por nuestro sitio.</ul></h3></div>");
							error_log(print_r("respuesta::error401:", TRUE), 0);
						}
						else if($message=="401"){
							echo ("<div><h3 class=\"muted\"><ul><li>Error 401: La solicitud requiere autenticaci&oacute;n.<br /><br /><li>Te invitamos a <a href = \"javascript:void(0)\" class=\"botonconestilo\" onclick=\"hidestuff('contacto');hidestuff('paswd');showstuff('light');\">Ingresar</a> en nuestro sitio e intentarlo nuevamente.</ul></h3></div>");
							error_log(print_r("respuesta::error401: ".$_SERVER["HTTP_REFERER"], TRUE), 0);
						}
						else if($message=="403"){
							echo ("<div><h3 class=\"muted\"><ul><li>Error 403: Archivo prohibido.<br /><br /><li>Te invitamos a seguir navegando por nuestro sitio.</ul></h3></div>");
							error_log(print_r("respuesta::error403: ".$_SERVER["HTTP_REFERER"], TRUE), 0);
						}
						else if($message=="404"){
							echo ("<div><h3 class=\"muted\"><ul><li>Error 404: La p&aacute;gina que ingresaste no existe.<br /><br /><li>Te invitamos a seguir navegando por nuestro sitio.</ul></h3></div>");
							error_log(print_r("respuesta::error404 ip ". $_SERVER['REMOTE_ADDR']."; address: ".$_SERVER['REQUEST_URI'], TRUE), 0);
						}
						else if($message=="500"){
							echo ("<div><h3 class=\"muted\"><ul><li>Error 500: Error Interno del Servidor.<br /><br /><li>Te invitamos a seguir navegando por nuestro sitio.</ul></h3></div>");
							error_log(print_r("respuesta::error500:", TRUE), 0);
						}
						// intento de pago sin un correo // llave
						else if($message=="correoPagoVacio"){
							echo ("<div><h3 class=\"muted\"><ul><li>Lo sentimos, no hemos podido realizar tu solicitud.</li><li>Int&eacute;ntalo nuevamente m&aacute;s tarde!</li></ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"inicio\" />Volver a inicio</a><br />&nbsp;";
							
						}	// pago exitoso
						else if($message=="pago-realizado"){
							echo ("<div><h3 class=\"muted\"><ul><li>Felicitaciones. Hemos recibido una notificación de tu pago, por lo que tu plan ha sido actualizado.</li><li>Atento a nuestras notificaciones!</li></ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"inicio\" />Volver a inicio</a><br />&nbsp;";
						}
						// pago cancelado
						else if($message=="pago-cancelado"){
							echo ("<div><h3 class=\"muted\"><ul><li>Lo sentimos, pero no has realizado tu pago.</li><br /><li>Int&eacute;ntalo de nuevo ;)</li></ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"planes\" />Volver a planes</a><br />&nbsp;";
						}
						else if($message=="fallo-vp"){
							echo ("<div><h3 class=\"muted\"><ul><li>Lo sentimos, aun no podemos validar tu pago.</li><br /><li>Este podr&iacute;a demorar hasta 48 horas.</li></ul></h3></div>");
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"inicio\" />Ir a inicio</a><br />&nbsp;";
						}
						else{
							echo "<div><h3 class=\"muted\">$message</h3></div>";
							echo "<div>&nbsp;</div><a class=\"botonconestilo\" href=\"inicio\" />Ir a Inicio</a><br />&nbsp;";
						}
					?>
			</div>
		</div>


		<div id="footer">
			<?php include("footer.php") ?>
		</div> 
	</div>

	<!-- <script type="text/javascript" src="atempus.js"></script> -->
</body>
</html>