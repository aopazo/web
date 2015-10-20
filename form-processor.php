<?php

	ob_start();
	session_start();
	require_once("connection.php");
	require_once("functions.php");
	require_once("getFormData.php");

	$getFecha = getdate();
	$current_date = "$getFecha[year]-$getFecha[mon]-$getFecha[mday]";
	$activaPago = "";
	$action = "inicio";
	$errorMessage = "";
	$test = true;

	if ($section == "usuario") {
		$action = "registro";
		// conseguir datos del formulario

		// validar consistencia
		$error_consistencia = "";
		if (empty($plan)) {
			$action = "planes";
			$errorMessage = "Vaya! Algo ha ocurrido.\\nNo recordamos que plan quieres contratar.\\nPor favor int&eacute;ntalo de nuevo\n";
			error_log(print_r("form-processor: Se intento registrar errorMessage y varCorreo: ".$errorMessage.", ".$correo, TRUE), 0); 	// dejamos un mensaje en log de errores
		}

		if ($correo==null || $correo=="")					$error_consistencia .= "- Debes ingresar tu Correo.\\n";
		if (!filter_var ($correo, FILTER_VALIDATE_EMAIL) || strlen($correo)<6)	$error_consistencia .= "- Correo inv\\u00e1lido.\\n";
		if ($correo != $correo_repetir)					$error_consistencia .= "- Tus correos no coinciden.\\n";

		if ($contrasena == null || $contrasena == "")		$error_consistencia .= "- Debes ingresar tu Contrase\\u00f1a.\\n";
		if ($contrasena != $contrasena_repetir)				$error_consistencia .= "- Tus contrase\\u00f1as no coinciden.\\n";
		if (strlen($contrasena) < 3)						$error_consistencia .= "- Tu contrase\\u00f1a debe tener al menos 6 caracteres\\n";

		// if ($captcha == null || $captcha == "")			$error_consistencia .= "- Debes ingresar la palabra del captcha.\\n";
		//validamos el captcha

		if (!isset($_POST['checkboxes']))				$error_consistencia .= "- Debes aceptar los T\\u00e9rminos y Condiciones.\\n";

		if (!empty($error_consistencia)) {
			$section = "usuarioActive";
			$errorMessage = "Encontramos los siguientes errores en tu formulario:\\n".$error_consistencia;
		} else {
			// if($test); else 
				$result = mysql_query("SELECT * FROM $table WHERE correo = '$correo'");
			if (mysql_num_rows($result) == 0) {
				$varMd5 = md5(substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8));
				$contrato = "";
				if ($plan=="Gratis") {
					$contrato = "Contrato3MGratisHCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 3 months'));
				} 
				if ($plan=="12000") {
					$contrato = "Contrato1Y12000HCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 1 year'));
				}
				if ($plan=="20400") {
					$contrato = "Contrato2Y20400HCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 2 year'));
				}
				$sql_insert_newuser = "INSERT INTO $table (correo, contrasena, fecha_incorporacion, md52confirm, fecha_inicio_plan_actual, fecha_fin_plan_actual, tipo_plan, planes_anteriores, contratos, tipo_usuario, correo_validado, mailchimp_suscrito) VALUES (\"$correo\", \"" . encrypt($contrasena) . "\", \"$current_date\", \"$varMd5\", \"$current_date\", \"$varFechaFin\", \"$plan\", \"\", \"". $contrato ."\", \"0\", \"false\", \"false\")";
				if (mysql_query($sql_insert_newuser)) {
					// iniciamos sesion
					$_SESSION['username'] = $correo;
					$_SESSION['plan'] = $plan;
					$_SESSION['correo'] = $correo;
					$_SESSION['correo_validado'] = false;
					$_SESSION['mailchimp_suscrito'] = false;
					$_SESSION['pago_recibido'] = false;
					$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
					$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
					// correo no encontrado en bd, correctamente ingresado, redirigir a inicio éxito
					// $errorMessage = "OK";
					if ($plan!="Gratis")	$activaPago = "si";
					// confirmamos el correo
					// if($test); else
						// enviaValidaCorreo($correo, $varMd5, $plan);
					$section = "validarActive";
					} else {
						// correo no encontrado en bd, error en el ingreso, redirigir a inicio fracaso
						$errorMessage = "Hubo un problema al crear tu cuenta.<br />Intentalo de nuevo mas tarde, por favor.";
						error_log(print_r("form-processor: ".$correo." intento registrarse. Error al ejecutar insert en BD, plan pago. SQL_USR: ".$sql_insert_newuser, TRUE), 0);
						}
			} else {
				$section = "usuarioActive";
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
		$rut_separated = explode("-", $rut);
		if ($rut != "" && (strlen($rut)<9 || dv($rut)!=$rut_separated[1]))		$error_consistencia .= "- Rut inv\\u00e1lido.\\n";

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
				$errorMessage = "Datos Actualizados Exit\u00f3samente";
			} else{
				$section = "facturacionActive";
				$errorMessage = "Se ha producido un error al actualizar tus datos. Int\u00e9ntalo de nuevo por favor.";
				error_log(print_r("form-processor: ".$sql." error al actualizar los datos", TRUE), 0);
				}
			// }xml_error_string
		}
	}
	else if($section == "transferencia"){

	}
	else if($section == "usuario, validacion, suscripcion, facturacion, transferencia"){

	}


	else if($section == "actualizarContrasena") {
		ob_end_clean();
		$contra_sql = "SELECT contrasena FROM $table WHERE correo = '".$_SESSION['correo']."'";
		$contra_query = mysql_query($contra_sql);
		if (mysql_num_rows($contra_query) == 1){
			$userdata = mysql_fetch_array($contra_query);
			if(crypt($contrasena_antes, $userdata['contrasena']) == $userdata['contrasena']){
				$sql = "UPDATE $table SET contrasena = '".encrypt($contrasena)."' WHERE correo = '".$_SESSION['correo']."'";
				$query_result = mysql_query($sql);
				if(mysql_query($sql)) {
					error_log("form-processor:actualizarContrasena: datos actualizados para sql: ".$sql." query_result: ".$query_result." contra ".$contrasena, 3, "form.logs");
					echo "contrasenaActualizadaOK";
				} else {
				error_log("form-processor:actualizarContrasena: error al actualizar los datos \n  sql: ".$sql." query_result: ".$query_result, 3, "error.logs");
				echo "contrasenaActualizadaNOK";
				}
			} else {
				error_log("\nform-processor:actualizarContrasena: contrasena actual no coincide con registros: ".$contrasena_antes. " y userdata contrasena: ".$userdata['contrasena'].$_SESSION['correo'].$result, 3, "form.logs");
				echo "contrasenaActualNOK";
			}
		} else{
			error_log("\nform-processor:actualizarContrasena: usuario con sesion iniciada no pudo cambiar clave, no se encontro correo - SQL: ".$contra_sql, 3, "error.logs");
		}
		exit (0);
	}

	else if($section == "actualizarDireccion") {
		ob_end_clean();
		$error_consistencia = "";
		error_log("hora".$direccion.$comuna.$ciudad.$region, 3, "form.logs");

		if($direccion == null || $direccion == "")	$error_consistencia .= "- Debes ingresar tu Direcci\\u00f3n. \\n";
		if($comuna == null || $comuna == "")		$error_consistencia .= "- Debes ingresar tu Comuna. \\n";
		if($ciudad == null || $ciudad == "")		$error_consistencia .= "- Debes ingresar tu Ciudad. \\n";
		if($region == null || $region == "")		$error_consistencia .= "- Debes ingresar tu Regi\\u00f3n. \\n";

		if (!empty($error_consistencia)) {
			echo "datosVacios";
		} else {
			$sql = "UPDATE $table SET direccion = '".$direccion."', comuna = '".$comuna."', ciudad = '".$ciudad."', region = '".$region."' WHERE correo = '".$_SESSION['correo']."'";
			if(mysql_query($sql)) {
				error_log("form-processor:actualizarDireccion: direeccion actualizada -> sql: ".$sql, 3, "form.logs");
				echo "direccionActualizadaOK";
			} else {
				error_log("form-processor:actualizarDireccion: error al actualizar la direccion \n  sql: ".$sql, 3, "error.logs");
				echo "direccionActualizadaNOK";
			}
		}
		exit (0);
	}










//// desde aca están las funciones/metodos del sitio antiguo (de las cuales algunas se usan)

	else if($section == "ingresar"){
		
		if(empty($varPlan)){
			$errorMessage = "Vaya! Algo ha ocurrido.\\nNo recordamos que plan quieres contratar.\\nPor favor int&eacute;ntalo de nuevo\n";
			error_log(print_r("form-processor: Se intento registrar errorMessage y varCorreo: ".$errorMessage.", ".$varCorreo, TRUE), 0); 	// dejamos un mensaje en log de errores
			$action="planes";
		}

		$error_consistencia = "";
		if ($varPlan!="Gratis"){
			if($varNombres == null || $varNombres == "")		$error_consistencia .= "- Debes ingresar tus Nombres. \\n";
			if($varApellidos == null || $varApellidos == "")	$error_consistencia .= "- Debes ingresar tus Apellidos. \\n";
			if(empty($varRut))									$error_consistencia .= "- Debes ingresar tu Rut. \\n";
			if($varDireccion == null || $varDireccion == "")	$error_consistencia .= "- Debes ingresar tu Direcci\\u00f3n. \\n";
		}
		$rut_separated = explode("-", $varRut);
		if ($varRut != "" && (strlen($varRut)<9 || dv($varRut)!=$rut_separated[1]))		$error_consistencia .= "- Rut inv\\u00e1lido.\\n";

		if ($varCorreo==null || $varCorreo=="")					$error_consistencia .= "- Debes ingresar tu Correo.\\n";
		if (!filter_var ($varCorreo, FILTER_VALIDATE_correo) || strlen($varCorreo)<6)	$error_consistencia .= "- Correo inv\\u00e1lido.\\n";
		if ($varCorreo != $varCorreoDos)						$error_consistencia .= "- Tus correos no coinciden.\\n";

		if ($varContrasena == null || $varContrasena == "")		$error_consistencia .= "- Debes ingresar tu Contrase\\u00f1a.\\n";
		if ($varContrasena == "********")						$error_consistencia .= "- Esta contrase\\u00f1a no esta permitida, por favor utiliza otra.\\n";
		if ($varContrasena != $varContrasenaDos)				$error_consistencia .= "- Tus contrase\\u00f1as no coinciden.\\n";

		if ($varRecaptcha == null || $varRecaptcha == "")		$error_consistencia .= "- Debes ingresar las 2 palabras del Recaptcha.\\n";

		//validamos el captcha
		require_once("recaptchalib.php");
		$privatekey = "6Lec7-QSAAAAALZjhgPZaP52jK-Jnu3weRzYJmnX";  // La llave privada https://www.google.com/recaptcha/admin/create
		$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
			$error_consistencia .= "- Captcha Incorrecto\\n";
		}

		if (!isset($_POST['aceptacion']))						$error_consistencia .= "- Debes aceptar los T\\u00e9rminos y Condiciones.\\n";

		if(!empty($error_consistencia)){
			$action = "suscripcion";
			$errorMessage = "Encontramos los siguientes errores en tu formulario:\\n".$error_consistencia;
		}
		// si todos los chequeos anteriores resultaron validos, entonces insertamos
		if($action=="respuesta"){
			if($test == "on"); else 
				$result = mysql_query("SELECT * FROM $table WHERE correo = '$varCorreo'");
			if(mysql_num_rows($result) == 0) {
				$varMd5 = md5(substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8));
				$contrato = "";
				if($varPlan=="Gratis"){
					$contrato = "Contrato3MGratisHCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 3 months'));
				} 
				if($varPlan=="12000"){
					$contrato = "Contrato1Y12000HCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 1 year'));
				}
				if($varPlan=="20400"){
					$contrato = "Contrato2Y20400HCo.pdf/";
					$varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 2 year'));
				}
				$sql_usr = "INSERT INTO $table (nombres, apellidos, rut, direccion, comuna, ciudad, region, telefono, correo, contrasena, fecha_incorporacion, md52confirm, fecha_inicio_plan_actual, fecha_fin_plan_actual, tipo_plan, planes_anteriores, contratos, tipo_usuario) VALUES (\"$varNombres\", \"$varApellidos\", \"$varRut\", \"$varDireccion\", \"$varComuna\", \"$varCiudad\", \"$varRegion\", \"$varTelefono\", \"$varCorreo\", \"" . encrypt($varContrasena) . "\", \"$varFecha\", \"$varMd5\", \"$varFecha\", \"$varFechaFin\", \"$varPlan\", \"\", \"". $contrato ."\",\"0\")";
				if(mysql_query($sql_usr)){
					// correo no encontrado en bd, correctamente ingresado, redirigir a inicio éxito
					$errorMessage = "OK";
					if ($varPlan!="Gratis")	$activaPago = "si";
					// confirmamos el correo
					if($test == "on"); else 
						include("enviaMailParaValidacion.php");
				}
				else {
					// correo no encontrado en bd, error en el ingreso, redirigir a inicio fracaso
					$errorMessage = "Hubo un problema al crear tu cuenta.<br />Intentalo de nuevo mas tarde, por favor.";
					error_log(print_r("form-processor: ".$varCorreo." intento registrarse, pero la BD lo impidio, plan pago. SQL_USR: ".$sql_usr, TRUE), 0);
					}
				// mysql_close($db);
				}
			else{
				$errorMessage = "Este correo ya existe en nuestra base de datos, intenta ingresar con el.";
			}
		}
	}

	else if($section == "actualizar"){
		$action = "mi_cuenta";
		$queactualizar = "";
		require_once("connection.php");
		$result = mysql_query("SELECT tipo_plan,contrasena,planes_anteriores,fecha_inicio_plan_actual,contratos FROM $table WHERE correo = '$varCorreo'");

		// quiere actualizar contraseña?
		if($varContrasenaAntes == "********" && $varContrasena == "********" && $varContrasenaDos == "********"); else $queactualizar .= "C";
		// quiere actualizar tipo de plan? ya no se puede desde mi cuenta
		// if($varPlan!=$row['tipo_plan']) $queactualizar .= "P";

		$error_consistencia = "";
		if(empty($varPlan))										$error_consistencia .= "- Debes escoger un Plan. \\n";
		if ($varPlan!="Gratis"){
			if($varNombres == null || $varNombres == "")		$error_consistencia .= "- Debes ingresar tus Nombres. \\n";
			if($varApellidos == null || $varApellidos == "")	$error_consistencia .= "- Debes ingresar tus Apellidos. \\n";
			if(empty($varRut))									$error_consistencia .= "- Debes ingresar tu Rut. \\n";
			if($varDireccion == null || $varDireccion == "")	$error_consistencia .= "- Debes ingresar tu Direcci\\u00f3n. \\n";
		}
		$rut_separated = explode("-", $varRut);
		if ($varRut != "" && (strlen($varRut)<9 || dv($varRut)!=$rut_separated[1]))		$error_consistencia .= "- Rut inv\\u00e1lido.\\n";

		if ($varCorreo==null || $varCorreo=="")					$error_consistencia .= "- Debes ingresar tu Correo.\\n";
		if (!filter_var ($varCorreo, FILTER_VALIDATE_correo) || strlen($varCorreo)<6)	$error_consistencia .= "- Correo inv\\u00e1lido.\\n";
		if ($varCorreo != $varCorreoDos)						$error_consistencia .= "- Tus correos no coinciden.\\n";

		if($queactualizar == "C" || $queactualizar == "CP"){
			if ($varContrasena == null || $varContrasena == "")		$error_consistencia .= "- Debes ingresar tu Contrase\\u00f1a.\\n";
			if ($varContrasena == "********")						$error_consistencia .= "- Esta contrase\\u00f1a no esta permitida, por favor utiliza otra.\\n";
			if ($varContrasena != $varContrasenaDos)				$error_consistencia .= "- Tus contrase\\u00f1as no coinciden.\\n";
			}

		// if($queactualizar == "P" || $queactualizar == "CP"){
			// if (!isset($_POST['aceptacion']))						$error_consistencia .= "- Debes aceptar el nuevo contrato.\\n";
		// }

		if(!empty($error_consistencia)){
			$action = "mi_cuenta";
			$errorMessage = "Encontramos los siguientes errores en tu formulario:\\n".$error_consistencia;
		}
		else{
			// caso que la persona desea actualizar datos de contacto
			if($queactualizar==""){ 
				$sql = "UPDATE $table SET nombres = '".$varNombres."', apellidos = '".$varApellidos."', rut = '".$varRut."', direccion = '".$varDireccion."', comuna = '".$varComuna."', ciudad = '".$varCiudad."', region = '".$varRegion."', telefono = '".$varTelefono."', correo = '".$varCorreo."' WHERE id = '".$_SESSION['id']."'";
				// $query_result = mysql_query($sql);
				if(mysql_query($sql))
					$errorMessage = "Datos Actualizados Exit\u00f3samente";
				else{
					$errorMessage = "Se ha producido un error al actualizar tus datos. Int\u00e9ntalo de nuevo por favor.";
					error_log(print_r("form-processor: ".$sql." error al actualizar los datos", TRUE), 0);
				}
			}
			// actualizar contraseña
			else if($queactualizar=="C"){
				// conseguir vieja contraseña (encriptada)
				// comparar vieja contraseña con nueva, si es así actualizar nueva, sino, reclamar y devolver a micuenta.php
				if(crypt($varContrasenaAntes, $row['contrasena']) == $row['contrasena']){
					$sql = "UPDATE $table SET nombres = '".$varNombres."', apellidos = '".$varApellidos."', rut = '".$varRut."', direccion = '".$varDireccion."', comuna = '".$varComuna."', ciudad = '".$varCiudad."', region = '".$varRegion."', telefono = '".$varTelefono."', contrasena = '".encrypt($varContrasena) ."' WHERE id = '".$_SESSION['id']."'";
					if(mysql_query($sql))
						$errorMessage = "Datos y Contrase\u00f1a Actualizados Exit\u00f3samente";
					else{
						$errorMessage = "Se ha producido un error al actualizar tus datos. Int\u00e9ntalo de nuevo por favor.";
						error_log(print_r("form-processor: ".$sql." error al actualizar los datos", TRUE), 0);
					}
				}
				else{
					$errorMessage = "Tu contrase\u00f1a anterior no coincide con nuestros registros. Int\u00e9ntalo de nuevo por favor.";
				}
			}
			// nunca se debería entrar acá, pq planes sigue un curso aparte desde la pantalla planes
			// else if($queactualizar=="P"){
				// $planes_anteriores = $row['planes_anteriores'] . "/" . $row['tipo_plan'] ."->". $row['fecha_inicio_plan_actual'];
				// if($varPlan=="12000"){
					// $new_contrato = "Contrato1Y12000HCo.pdf/";
					// $varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 1 year'));
				// }  
				// if($varPlan=="20400"){
					// $new_contrato = "Contrato2Y20400HCo.pdf/";
					// $varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 2 year'));
				// }  
				// $contratos_actualizado = $new_contrato.$row['contratos'];
				// $sql = "UPDATE $table SET nombres = '".$varNombres."', apellidos = '".$varApellidos."', rut = '".$varRut."', direccion = '".$varDireccion."', comuna = '".$varComuna."', ciudad = '".$varCiudad."', region = '".$varRegion."', telefono = '".$varTelefono."', fecha_inicio_plan_actual= '".$varFecha."', fecha_fin_plan_actual = '".$varFechaFin."', tipo_plan = '".$varPlan."', planes_anteriores = '".$planes_anteriores."', contratos = '".$contratos_actualizado."', tipo_usuario = '2' WHERE id = '".$_SESSION['id']."'";
				// if(mysql_query($sql)){
					// $action = "respuesta";
					// $errorMessage = "P-Update";
					// if($varPlan=="12000" || $varPlan=="20400") $activaPago = "si";
				// }
				// else{
					// $errorMessage = "Se ha producido un error al actualizar tus datos. Int\u00e9ntalo de nuevo por favor.";
					// error_log(print_r("form-processor: ".$sql." error al actualizar los datos", TRUE), 0);
				// }
			// }
			// else if($queactualizar=="CP"){
				// $planes_anteriores = $row['planes_anteriores'] . "/" . $row['tipo_plan'] ."->". $row['fecha_inicio_plan_actual'];
				// if($varPlan=="12000"){
					// $contrato = "Contrato1Y12000HCo.pdf/";
					// $varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 1 year'));
				// }
				// if($varPlan=="20400"){
					// $contrato = "Contrato2Y20400HCo.pdf/";
					// $varFechaFin = date('Y-m-d', strtotime($varFecha. ' + 2 year'));
				// }
				// $contratos_actualizado = $new_contrato."/".$row['contratos'];
				// if(crypt($varContrasenaAntes, $row['contrasena']) == $row['contrasena']){
					// $sql = "UPDATE $table SET nombres = '".$varNombres."', apellidos = '".$varApellidos."', rut = '".$varRut."', direccion = '".$varDireccion."', comuna = '".$varComuna."', ciudad = '".$varCiudad."', region = '".$varRegion."', telefono = '".$varTelefono."', contrasena = '".encrypt($varContrasena) ."', fecha_inicio_plan_actual= '".$varFecha."', fecha_fin_plan_actual = '".$varFechaFin."', tipo_plan = '".$varPlan."', planes_anteriores = '".$planes_anteriores."', contratos = '".$contratos_actualizado."',  tipo_usuario = '2' WHERE id = '".$_SESSION['id']."'";
					// if(mysql_query($sql)){
						// $action = "respuesta";
						// $errorMessage = "CP-Update";
						// if($varPlan=="12000" || $varPlan=="20400") $activaPago = "si";
					// }
					// else{
						// $errorMessage = "Se ha producido un error al actualizar tus datos. Int\u00e9ntalo de nuevo por favor.";
						// error_log(print_r("form-processor: ".$sql." error al actualizar los datos", TRUE), 0);
					// }
				// }
				// else{
					// $errorMessage = "Tu contrase\u00f1a anterior no coincide con nuestros registros. Int\u00e9ntalo de nuevo por favor.";
				// }
			// }
			// if($queactualizar=="P" || $queactualizar=="CP"){
				// require("PHPMailer/class.phpmailer.php");

				// $mail = new PHPMailer();
				// $mail->SMTPAuth   = true;                  	// enable SMTP authentication
				// $mail->SMTPSecure = "tls";              	// sets the prefix to the servier $mail->IsSMTP(); 
															// telling the class to use SMTP
				// $mail->Host     = "smtp.gmail.com"; // SMTP server
				// $mail->SetFrom('contacto@atempus.cl', 'Equipo Atempus');
				// $mail->AddReplyTo('contacto@atempus.cl', 'Equipo Atempus');

				// $mail->AddAddress("alejandro.opazo@atempus.cl", "Alejandro Opazo");
				// $mail->AddAddress("jose.vaisman@atempus.cl", "Jose Vaisman");
				// $mail->Subject  = "Usuario intentando upgrade o renovacion de Plan (form-processor)";
				// $mail->Body     = "Usuario ".$varCorreo." ha llegado al portal de Khipu para contratar por primera vez un plan de pago o para renovar el ya existente.\n\nSus datos son:\n- Nuevo Plan: ".$varPlan.".\n- RUT: ".$varRut.".\n- Nombres: ".$varNombres.".\n- Apellidos: ".$varApellidos.".\n- Direccion: ".$varDireccion.", ".$varComuna.", ".$varCiudad.", ".$varRegion.".\n\nJose por favor confirmar el pago y subir factura via FTP.\nAle por favor revisar que nombres, apellidos y plan hayan sido actualizados mailchimp.\n\nSaludos.";
				// $mail->MsgHTML("Usuario ".$varCorreo." ha llegado al portal de Khipu para contratar por primera vez un plan de pago o para renovar el ya  existente.<br /><br />Sus datos son:<br />- Nuevo Plan: ".$varPlan.".<br />- RUT: ".$varRut.".<br />- Nombres: ".$varNombres.".<br />- Apellidos: ".$varApellidos.".<br />- Direccion: ".$varDireccion.", ".$varComuna.", ".$varCiudad.", ".$varRegion.".<br /><br />Jose por favor confirmar el pago y subir factura via FTP.<br />Ale por favor revisar que nombres, apellidos y plan hayan sido actualizados mailchimp.<br /><br />Saludos.");

				// if(!$mail->Send()) {
					// error_log(print_r("form-processor::actualizar: Correo no se pudo enviar: ".$mail->ErrorInfo, TRUE), 0);
				// } else {
					// ;
				// }
				// error_log(print_r("form-processor:: Usuario ".$varCorreo." ha mejorado su Plan Básico a ".$varPlan, TRUE), 0);
			// }
		}
		// mysql_close($db);
	}

	else if($section == "cambiarcontrasena"){ 

		$error_consistencia = "";
		if ($varContrasena == null || $varContrasena == "")		$error_consistencia .= "- Debes ingresar tu nueva contrase\\u00f1a.\\n";
		if ($varContrasena == "********")						$error_consistencia .= "- Esta contrase\\u00f1a no esta permitida, por favor utiliza otra.\\n";
		if ($varContrasena != $varContrasenaDos)				$error_consistencia .= "- Tus contrasenas no coinciden.\\n";

		if(!empty($error_consistencia)){
			$token = $_REQUEST['token'];
			$action = "cambiar_mi_contrasena?token=".$token;
			$errorMessage = "Encontramos los siguientes errores en tu formulario:\\n".$error_consistencia;
		}
		else{
			require_once("connection.php");
			$varMd5 = md5(substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8));
			$sql = "UPDATE $table SET contrasena = '".encrypt($varContrasena) ."', md52confirm = '".$varMd5."' WHERE correo = '".$varCorreo."'";
			if(mysql_query($sql)){
				$errorMessage = "recoveryDoneOK";
				$action = "respuesta";
				if($_REQUEST['nombres']==null || $_REQUEST['nombres']=="")
					$_SESSION['username'] = $_REQUEST['correo'];
				else
					$_SESSION['username'] = $_REQUEST['nombres'];
				$_SESSION['id'] = $_REQUEST['id'];
				$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
			}
			else{
				$errorMessage = "Se ha producido un error al actualizar tu contrase\u00f1a;. Int\u00e9ntalo de nuevo por favor.";
				error_log(print_r("form-processor: ".$sql." error al actualizar la constrasena", TRUE), 0);
			}
		}
	// mysql_close($db);
	}

	else if($section == "contactar"){

		$error_consistencia = "";
		if ($varCorreo==null || $varCorreo=="")											$error_consistencia .= "<li> No ingresaste tu correo.<br />";
		if (!filter_var ($varCorreo, FILTER_VALIDATE_correo) || strlen($varCorreo)<6)	$error_consistencia .= "<li> Correo invalido.<br />";
		if ($varMensaje==null || $varMensaje=="")										$error_consistencia .= "<li> No ingresaste tu mensaje.<br />";

		if(!empty($error_consistencia)){
			$action = "respuesta";
			$errorMessage = "<ul>".$error_consistencia."</ul>";
		}
		else{
			require_once("PHPMailer/class.phpmailer.php");
			$mailText = "Nombre: ".$varNombres."\nTeléfono: ".$varTelefono."\nCorreo: ".$varCorreo."\nHa escrito: ".$varMensaje;
			// sendmail
			$mail = new PHPMailer();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->Host     = "smtp.gmail.com"; // SMTP server
			$mail->SetFrom('noresponder@atempus.cl', 'Robot Atempus');
			$mail->AddReplyTo('noresponder@atempus.cl', 'Robot Atempus');
			$mail->AddAddress("contacto@atempus.cl", "");
			$mail->Subject  = "Contacto desde usuario vía web";
			$mail->Body     = $mailText;
			$mail->MsgHTML(str_replace("\n","<br />",$mail->Body));

			if(!$mail->Send()) {
				error_log(print_r("form-processor::contactar: Correo no se pudo enviar: ".$mail->ErrorInfo, TRUE), 0);
			} else {
				$errorMessage = "contactoOK";
			}
		}
	}

	else if($section == "renovar"){
		$activaPago = "si";
	}

	else{
		header('Location: inicio'); 
	}

	if($activaPago == "si" && false){
		$varCorreo = $_SESSION['correo'];
		
		if($varPlan == "12000"){
			$subject = 'Plan Premium Anual';
			$body = 'Suscripcion Plan Premium Anual a Atempus';
			$amount = '12000';
			$transaction_id = 'PlanAnual::'.$varCorreo;
			}
		if($varPlan == "20400"){
			$subject = 'Plan Premium Bianual';
			$body = 'Suscripcion Plan Premium Bianual a Atempus';
			$amount = '20400';
			$transaction_id = 'PlanBianual::'.$varCorreo;
			}

		// vp = ValidacionPlan es para que nadie pueda llamar a notificacion-khipu y autohabilitarse su plan
		$vp = substr(str_shuffle('./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') , 0 , 11);
		$sql = "UPDATE $table SET vp = '".$vp."' WHERE correo = '".$varCorreo."'";
		if(mysql_query($sql)){
			error_log(print_r("form-processor:: ".$sql." vp actualizado", TRUE), 0);
		} else{
			error_log(print_r("form-processor:: ".$sql." error al actualizar vp", TRUE), 0);
		}

		$notify_url = 'http://www.atempus.cl/notificacion-khipu.php?datos=notificacion&message=IntentoDePago;Usuario:'.$varCorreo.';Plan:'.$varPlan;
		$return_url = 'http://www.atempus.cl/notificacion-khipu.php?datos=renovado&message=pago-realizado&user='.$varCorreo.'&plan='.$varPlan.'&vp='.$vp;
		error_log(print_r("Form-Processor::ActivaPago::notifyURL: ".$notify_url.", returnURL: ".$return_url, TRUE), 0);
		$cancel_url = 'http://www.atempus.cl/respuesta?message=pago-cancelado';
		$expires_date = time() + 2*24*60*60; // dos dias a partir de ahora
		$payer_correo = $varCorreo;
		$bank_id='';
		$picture_url = '';
		$custom = '';
		$action = 'https://khipu.com/api/1.3/createPaymentPage';
		// creamos el hash
		$concatenated = "receiver_id=$receiver_id&subject=$subject&body=$body&amount=$amount&payer_correo=$payer_correo&bank_id=$bank_id&expires_date=$expires_date&transaction_id=$transaction_id&custom=$custom&notify_url=$notify_url&return_url=$return_url&cancel_url=$cancel_url&picture_url=$picture_url";
		$hash = hash_hmac('sha256', $concatenated , $secret);
		error_log(print_r("Form-Processor::ActivaPago::User:".$varCorreo.";Plan:".$amount, TRUE), 0);
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
		<!--<input type="submit" />-->
	</form>

	<script language="JavaScript">
		document.form_processor.submit();
	</script>

</body>
</html>

