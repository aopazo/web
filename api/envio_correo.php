<?php

require_once ("../connection.php");
require ("../functions.php");
require ("../UsuarioDAO.php");

session_start();

$usuario_session = $_SESSION['correo'];
if (isset($_POST['correo'])) {
    $usuario_post = $_POST['correo'];
    if ($usuario_post == $usuario_session) {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'validacion':
                    reenviaValidacion($usuario_session);
                    break;
                case 'suscripcion':
                    reenviaSuscripcion($usuario_session);
                    break;
            }
        }
    } else {
		// O ya se sirvió la petición, o los usuarios son distintos. En ambos casos, terminamos.
		error_log("\nEnvia correo:: session ".$usuario_session." distinto de post: ".$usuario_post, 3, "error.log");
		exit;
	}
}
else { // No hay username en el post, algo anda mal
	error_log("\nEnvia correo:: session ".$usuario_session." post vacio :/", 3, "error.log");
	exit;
}

function reenviaValidacion($correo) {
    $dao = new UsuarioDAO($correo);
    $plan = $dao->getTipoPlan();
    $md5 = $dao->getMd52confirm();
    enviaCorreoValidacion($plan, $correo, $md5);
}

function reenviaSuscripcion($correo) {
	error_log("\nEnvia correo:: Reenviando suscripcion a: " .$correo, 3, "transactions.log");
    $dao = new UsuarioDAO($correo);
    $nombres = $dao->getNombres();
    $apellidos = $dao->getApellidos();
	enviar_bienvenida_mailchimp($correo, $nombres, $apellidos);
	error_log("\nEnvia correo:: correo enviado a: " .$correo, 3, "transactions.log");
}

?>

