<?php

session_start();
require_once("functions.php");
require_once("connection.php");
$timestamp = new DateTime();
$action = "inicio";
$correo = "";
$message = "";

$token = safe(filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING));
if(isset($token)) {
	$result = mysql_query("SELECT * FROM $table WHERE md52confirm = '".$token."'");
	if(mysql_num_rows($result) == 1) {
            $row = mysql_fetch_array($result);
            $correo = $row['correo'];
            // si el token coincidio y el usuario llego a la pagina entonces valido el correo
            if($row['correo_validado'] == 0){
                $sql = "UPDATE $table SET correo_validado = 1 WHERE correo = '". $correo ."'";
                // TODO: otro uso de test, en este caso, ni si quiera esta inicializado aca. Al menos esta en connection.php
                if ($test=="on") {
                    error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: sql: ".$sql, 3, "debug.log");
                }
                if(mysql_query($sql)){
                    error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: correo ".$correo." dado de alta en BD", 3, "transactions.log");
                    // iniciamos sesion
                    iniciarSesion($row);
                    $action = "usuario";
                    $message = "correoValidado";

                    // si correo fue actualizado en BD entonces mando bienvenida para MC
                    if($row['mailchimp_suscrito'] == 0) {
                        enviar_bienvenida_mailchimp($row['correo'], $row['nombres'], $row['apellidos']);
                    }

                } else {
                    error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: problemas al dar de alta el correo ".$correo." en BD", 3, "error.log");
                }

            }
            else{
                    iniciarSesion($row);
                    $action = "usuario";
                    $message = "correoValidadoAnteriormente";
            }
	}
	else {
            $action = "inicio";
            $message = "tokenInvalido";
            error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo: token invalido para correo: ".$correo.", token: ".$token, 3, "error.log");
	}
}
else {
		$action = "inicio";
		$message = "tokenNoEncontrado";
		error_log("\n".$timestamp->format('Y-m-d H:i:s')." confirmatucorreo:: token no encontrado en URL para correo: ".$correo, 3, "error.log");
}
?>

<body>
<html>
	<form name="confirma_form" action="<?php echo $action; ?>" method="post">
		<input type="hidden" value="<?php echo $message; ?>" name="errorMessage" />
	</form>
	<script language="JavaScript">
		document.confirma_form.submit();
	</script>
</body>
</html>