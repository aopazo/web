<?php
	ob_start();
	session_start();

	error_log("\n".date("Y/m/d H:i:s")." form-processor:: sessionCorreo: ".$_SESSION['correo'], 3, "debug.log");

	require_once("connection.php");
	require_once("functions.php");
		error_log("\n".date("Y/m/d H:i:s")." form-processor:: plan: ".$plan, 3, "debug.log");
	require_once("getFormData.php");
		error_log("\n".date("Y/m/d H:i:s")." form-processor:: plan: ".$plan, 3, "debug.log");
	require_once("UsuarioDAO.php");
	
	error_log("\n".date("Y/m/d H:i:s")." form-processor:: sessionCorreo: ".$_SESSION['correo'], 3, "debug.log");

    // require_once ("TDAs.php"); // Para el refactor de clases

	$getFecha = getdate();
	$current_date = date('Y-m-d'); //"$getFecha[year]-$getFecha[mon]-$getFecha[mday]";
	$activaPago = "";
	$action = "inicio";
	$errorMessage = "";

	if ($section == "usuario") {
		$action = "registro";
		// conseguir datos del formulario

		// validar consistencia
		$error_consistencia = "";
		if (empty($plan)) {
			$action = "planes";
			$errorMessage = "Vaya! Algo ha ocurrido.\\nNo recordamos que plan quieres contratar.\\nPor favor int&eacute;ntalo de nuevo\n";
			error_log("\n".date("Y/m/d H:i:s")." form-processor::usuario:: Se intento registrar errorMessage y varCorreo: ".$errorMessage.", ".$correo, 3, "error.log"); 	// dejamos un mensaje en log de errores
			}

		if ($correo==null || $correo=="")					$error_consistencia .= "- Debes ingresar tu Correo.\\n";
		if (!filter_var ($correo, FILTER_VALIDATE_EMAIL) || strlen($correo)<6)	$error_consistencia .= "- Correo inv\\u00e1lido.\\n";
		if ($correo != $correo_repetir)					$error_consistencia .= "- Tus correos no coinciden.\\n";

		if ($contrasena == null || $contrasena == "")		$error_consistencia .= "- Debes ingresar tu Contrase\\u00f1a.\\n";
		if ($contrasena != $contrasena_repetir)				$error_consistencia .= "- Tus contrase\\u00f1as no coinciden.\\n";
		if (strlen($contrasena) < 6)						$error_consistencia .= "- Tu contrase\\u00f1a debe tener al menos 6 caracteres\\n";

                // TODO: Activar captcha
		// if ($captcha == null || $captcha == "")			$error_consistencia .= "- Debes ingresar la palabra del captcha.\\n";
		//validamos el captcha

		// if (!isset($_POST['checkboxes']))				$error_consistencia .= "- Debes aceptar los T\\u00e9rminos y Condiciones.\\n";

		if (!empty($error_consistencia)) {
			$section = "usuarioActive";
			$errorMessage = "Encontramos los siguientes errores en tu formulario:\\n\\n".$error_consistencia;
		} else {
                    // Se confirma que no existe el correo
			$result = mysql_query("SELECT * FROM $table WHERE correo = '$correo'");
			if (mysql_num_rows($result) == 0) {
                // Se crea el usuario.
                // TODO: Yo haria un gran refactor para sacar la logica de usuario y su modelo fuera de un procesador de formularios
				$varMd5 = md5(substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8));
				$contrato = "";
				if ($plan=="Gratis") {
					$plan_nombre = "Gratis";
					$vigente = "Vigente";
					$contrato = "Contrato3MGratisHCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 3 months'));
					$planes_anteriores = $plan_nombre."/".$current_date."/".$current_date."/".$varFechaFin."/".$vigente."/".$contrato."/";
				}
				if ($plan=="12000") {
					$plan_nombre = "Anual";
					$vigente = "Pendiente";
					$contrato = "Contrato1Y12000HCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 1 year'));
				}
				if ($plan=="20400") {
					$plan_nombre = "BiAnual";
					$vigente = "Pendiente";
					$contrato = "Contrato2Y20400HCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 2 year'));
				}
				if ($plan=="12000" || $plan=="20400"){
					$plan_nombre = "";
					$planes_anteriores =  "";
					$contrato = "";
					$plan_vacio = "";
				}

				$sql_insert_newuser = "INSERT INTO $table (correo, contrasena, fecha_incorporacion, md52confirm, fecha_inicio_plan_actual, fecha_fin_servicio, tipo_plan, planes_anteriores, contratos, tipo_usuario, correo_validado, mailchimp_suscrito) VALUES (\"$correo\", \"" . encrypt($contrasena) . "\", \"$current_date\", \"$varMd5\", \"$current_date\", \"$varFechaFin\", \"$plan_vacio\", \"". $planes_anteriores . "\", \"". $contrato ."\", \"0\", \"false\", \"false\")";
				if (mysql_query($sql_insert_newuser)) {
					// correo no encontrado en bd, correctamente ingresado, redirigir a inicio &eacute;xito
					// Pasando el codigo a functions...
					if ($plan!="Gratis") {
						$activaPago = "si";
					}

					$dao = new UsuarioDAO($correo);
					// enviar_bienvenida_mailchimp($correo, "", "");  // no es necesario enviar un correo acá, se manda al setear el nuevo plan (setNewPlan)
					// $_SESSION['correo_validado'] = 0;
					$section = "validarActive";
				} else {
					// correo no encontrado en bd, error en el ingreso, redirigir a inicio fracaso
					$errorMessage = "Hubo un problema al crear tu cuenta.<br />Intentalo de nuevo mas tarde, por favor.";
					error_log("\n".date("Y/m/d H:i:s")." form-processor::usuario:: ".$correo." intento registrarse. Error al ejecutar insert en BD, plan pago. SQL_USR: ".$sql_insert_newuser, 3, "error.log");
				}
			} else {
				$section = "usuarioActive";
				$action = "ingreso";
				$errorMessage = "Este correo ya existe en nuestra base de datos, intenta ingresar con el.";
			}
		}
	}

	else if ($section == "validacion") {
		if ($success)
			$section = "usuarioActive";
		else
			$section = "usuarioActive";
	}
	else if ($section == "suscripcion") {

	}
	else if ($section == "facturacion") {
		$action = "registro";
		// conseguir datos del formulario

        // validar consistencia
		$error_consistencia = "";
		if($nombres == null || $nombres == "")		$error_consistencia .= "- Debes ingresar tus Nombres. \\n";
		if($apellidos == null || $apellidos == "")	$error_consistencia .= "- Debes ingresar tus Apellidos. \\n";

		if(empty($rut))								$error_consistencia .= "- Debes ingresar tu Rut. \\n";
        $stopchars = array(".", ",");
        $rut_sinpuntos = str_replace($stopchars, "", $rut);
        $rut = $rut_sinpuntos;
        $rut_separated = explode("-", $rut_sinpuntos);
		if ($rut == "" || strlen($rut)<9 || dv($rut)!=$rut_separated[1])		$error_consistencia .= "- Rut inv\\u00e1lido.\\nRecuerda ingresarlo con gui\\u00f3n (ej: 12345678-9)\\n";

		if($direccion == null || $direccion == "")	$error_consistencia .= "- Debes ingresar tu Direcci\\u00f3n. \\n";
		if($comuna == null || $comuna == "")		$error_consistencia .= "- Debes ingresar tu Comuna. \\n";
		if($ciudad == null || $ciudad == "")		$error_consistencia .= "- Debes ingresar tu Ciudad. \\n";
		if($region == null || $region == "")		$error_consistencia .= "- Debes ingresar tu Regi\\u00f3n. \\n";

		if (!empty($error_consistencia)) {
			$section = "facturacionActive";
			$errorMessage = "Encontramos los siguientes errores en tu formulario:\\n".$error_consistencia;
		} else {
			// if($test); else {
			$sql = "UPDATE $table SET nombres = '".$nombres."', apellidos = '".$apellidos."', rut = '".$rut."', direccion = '".$direccion."', comuna = '".$comuna."', ciudad = '".$ciudad."', region = '".$region."' WHERE correo = '".$_SESSION['correo']."'";
			if(mysql_query($sql)){
				$section = "transferenciaActive";
				$errorMessage = "Datos actualizados exit\u00f3samente";
			} else{
				$section = "facturacionActive";
				$errorMessage = "Se ha producido un error al actualizar tus datos. Int\u00e9ntalo de nuevo por favor.";
				error_log("\n".date("Y/m/d H:i:s")." form-processor: ".$sql." error al actualizar los datos", 3, "error.log");
				}
			// }xml_error_string
		}
	}

    // section = transferencia -> el usuario viene de registro y quiere pagar
    // si message == suscripcion -> suscripcion nueva
    // si message == renovacion -> renovacion
	else if($section == "transferencia"){
        require("connection.php");
        $varCorreo = $_SESSION['correo'];
        $varCorreo_get = str_replace("+", "%2B", $_SESSION['correo']);
        $varPlan = $plan;
        
        if($varPlan == "12000"){
            $subject = 'Plan Premium Anual';
            $body = 'Suscripción Plan Premium Anual';
            $amount = '12000';
            $transaction_id = 'PlanAnual';
			error_log("\n".date("Y/m/d H:i:s")." form-processor:: plan 12000:".$varCorreo_get, 3, "debug.log");
            }
        if($varPlan == "20400"){
            $subject = 'Plan Premium BiAnual';
            $body = 'Suscripción Plan Premium BiAnual';
            $amount = '20400';
            $transaction_id = 'PlanBianual';
			error_log("\n".date("Y/m/d H:i:s")." form-processor:: plan 20400:".$varCorreo_get, 3, "debug.log");
            }

        // vp = ValidacionPlan es para que nadie pueda llamar a notificacion-khipu y autohabilitarse su plan
        $vp = substr(str_shuffle('./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') , 0 , 11);
        $sql = "UPDATE $table SET vp = '".$vp."' WHERE correo = '".$varCorreo."'";
        if(mysql_query($sql)){
            error_log(print_r("form-processor:: ".$sql." vp actualizado", TRUE), 0);
        } else{
            error_log(print_r("form-processor:: ".$sql." error al actualizar vp", TRUE), 0);
        }

        $notify_url = $URL.'notificacion-khipu.php?datos=notificacion&message=IntentoDePago;Usuario:'.$varCorreo_get.';Plan:'.$varPlan; //.';varDatos:'.$datos;
        $return_url = $URL.'notificacion-khipu.php?datos=renovado&message=pago-realizado&user='.$varCorreo_get.'&plan='.$varPlan.'&vp='.$vp; //.'&varDatos:'.$datos;
		$cancel_url = $URL.'cuenta.php?errorMessage=Has cancelado tu pago.';
        // guardar intento en logs
        $expires_date = time() + 2*24*60*60; // dos dias a partir de ahora
        $payer_correo = $varCorreo;
        $bank_id='';
        $picture_url = '';
        $custom = '';
        $action = 'https://khipu.com/api/1.3/createPaymentPage';
        // creamos el hash
		if(strpos($correo, '+beta') !== false){
			$receiver_id = '10380';		// prueba
			$secret = 'e89388ae5d57251a3e4f038b4a3d310e9c018541';	// prueba
		}

		$concatenated = "receiver_id=$receiver_id&subject=$subject&body=$body&amount=$amount&payer_email=$payer_email&bank_id=$bank_id&expires_date=$expires_date&transaction_id=$transaction_id&custom=$custom&notify_url=$notify_url&return_url=$return_url&cancel_url=$cancel_url&picture_url=$picture_url";
		$hash = hash_hmac('sha256', $concatenated , $secret);
		// error_log("\n".date("Y/m/d H:i:s")." form-processor:: concatenated:".$concatenated, 3, "debug.log");
	}

	else if($section == "usuario, validacion, suscripcion, facturacion, transferencia"){

	}
	else if($section == "actualizarContrasena") {
		ob_end_clean();
		if ($contrasena_antes == null || $contrasena_antes == "") { echo "contrasenaActualVacia"; }
		else if ($contrasena == null || $contrasena == "") { echo "contrasenaNuevaVacia"; }
		else if ($contrasena_repetir == null || $contrasena_repetir == "") { echo "contrasenaRepetirVacia"; }
		else if ($contrasena != $contrasena_repetir) { echo "contrasenasNoCoinciden"; }
		else if (strlen($contrasena) < 6) { echo "contrasenaMuyCorta"; } 
		else {
			$contra_sql = "SELECT contrasena FROM $table WHERE correo = '".$_SESSION['correo']."'";
			$contra_query = mysql_query($contra_sql);
			if (mysql_num_rows($contra_query) == 1){
				$userdata = mysql_fetch_array($contra_query);
				if(crypt($contrasena_antes, $userdata['contrasena']) == $userdata['contrasena']){
					$sql = "UPDATE $table SET contrasena = '".encrypt($contrasena)."' WHERE correo = '".$_SESSION['correo']."'";
					if($query_result = mysql_query($sql)) {
						error_log("\n".date("Y/m/d H:i:s")." form-processor::actualizarContrasena:: datos actualizados para sql: ".$sql." query_result: ".$query_result." contra ".$contrasena, 3, "debug.log");
						echo "contrasenaActualizadaOK";
					} else {
					error_log("\n".date("Y/m/d H:i:s")." form-processor::actualizarContrasena:: error al actualizar los datos \n  sql: ".$sql." query_result: ".$query_result, 3, "error.log");
					echo "contrasenaActualizadaNOK";
					}
				} else {
					error_log("\n".date("Y/m/d H:i:s")." form-processor::actualizarContrasena:: contrasena actual no coincide con registros: ".$contrasena_antes. " y userdata contrasena: ".$userdata['contrasena'].$_SESSION['correo'].$result, 3, "error.log");
					echo "contrasenaActualNOK";
				}
			} else{
				error_log("\n".date("Y/m/d H:i:s")." form-processor::actualizarContrasena:: usuario con sesion iniciada no pudo cambiar clave, no se encontro correo - SQL: ".$contra_sql, 3, "error.log");
			}
		}
		exit (0);
	}
	else if($section == "actualizarDireccion") {
		ob_end_clean();
		$error_consistencia = "";
		// error_log("form-processor:: direccion ".$direccion.$comuna.$ciudad.$region, 3, "debug.log");

        if($direccion == null || $direccion == ""){	$error_consistencia .= "- Debes ingresar tu Direcci\\u00f3n. \\n"; }
        if($comuna == null || $comuna == ""){		$error_consistencia .= "- Debes ingresar tu Comuna. \\n"; }
        if($ciudad == null || $ciudad == ""){		$error_consistencia .= "- Debes ingresar tu Ciudad. \\n"; }
        if($region == null || $region == ""){		$error_consistencia .= "- Debes ingresar tu Regi\\u00f3n. \\n"; }

		if (!empty($error_consistencia)) {
			echo "datosVacios";
		} else {
			$sql = "UPDATE $table SET direccion = '".$direccion."', comuna = '".$comuna."', ciudad = '".$ciudad."', region = '".$region."' WHERE correo = '".$_SESSION['correo']."'";
			if(mysql_query($sql)) {
				error_log("\n".date("Y/m/d H:i:s")." form-processor::actualizarDireccion:: direccion actualizada -> sql: ".$sql, 3, "transactions.log");
				echo "direccionActualizadaOK";
			} else {
				error_log("\n".date("Y/m/d H:i:s")." form-processor::actualizarDireccion:: error al actualizar la direccion \n  sql: ".$sql, 3, "error.logs");
				echo "direccionActualizadaNOK";
			}
		}
		exit (0);
	}
	else if ($section == "contacto"){
		$de = "contacto@atempus.cl";
		$deNombre = "Contacto Atempus";
		$para = $correo;
		$paraNombre = $nombres;
		$mensaje = "Estimado $nombres,<br /><br />Hemos recibido tu mensaje: $mensaje<br /><br />Nos contactaremos contigo a la brevedad.<br /><br />Equipo Atempus.";
		// echo $de."<br />".$deNombre."<br />".$para."<br />".$paraNombre."<br />".$asunto."<br />".$mensaje;
		// exit (0);
		enviaCorreo($de, $deNombre, $para, $paraNombre, $asunto, $mensaje);
		$action = "inicio";
		$errorMessage = "Hemos recibido tu mensaje.<br />Nos contactaremos contigo a la brevedad.";
	}


	// mysql_close($db);
?>

<html>
<body>
	<form action="<?php echo $action; ?>" method='post' name='form_processor'>
		<input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>" />
		<input type="hidden" name="subject" value="<?php echo $subject; ?>" />
		<input type="hidden" name="body" value="<?php echo $body; ?>" />
		<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
		<input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
		<input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
		<input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>" />
		<input type="hidden" name="custom" value="<?php echo $custom; ?>" />
		<input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>" />
		<input type="hidden" name="payer_correo" value="<?php echo $payer_correo; ?>" />
		<input type="hidden" name="expires_date" value="<?php echo $expires_date; ?>" />
		<input type="hidden" name="bank_id" value="<?php echo $bank_id; ?>" />
		<input type="hidden" name="picture_url" value="<?php echo $picture_url; ?>" />
		<input type="hidden" name="hash" value="<?php echo $hash; ?>" />
		<input type="hidden" name="plan" value="<?php echo $plan; ?>" />
		<input type="hidden" name="section" value="<?php echo $section; ?>" />
		<input type="hidden" name="nombres" value="<?php echo $nombres; ?>" />
		<input type="hidden" name="apellidos" value="<?php echo $apellidos; ?>" />
		<input type="hidden" name="rut" value="<?php echo $rut; ?>" />
		<input type="hidden" name="direccion" value="<?php echo $direccion; ?>" />
		<input type="hidden" name="comuna" value="<?php echo $comuna; ?>" />
		<input type="hidden" name="ciudad" value="<?php echo $ciudad; ?>" />
		<input type="hidden" name="region" value="<?php echo $region; ?>" />
		<input type="hidden" name="correo" value="<?php echo $correo; ?>" />
		<input type="hidden" name="errorMessage" value="<?php echo $errorMessage; ?>" />
	</form>

	<script language="JavaScript">
		document.form_processor.submit();
	</script>

</body>
</html>

