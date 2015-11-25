<?php
require_once ("../functions.php");
require_once ("../DAOs/UsuarioDAO.php");
session_start();
$usuario_session = $_SESSION['correo'];
if (isset($_POST['correo'])) {
    $usuario_post = $_POST['correo'];
    if ($usuario_post == $usuario_session) {
        echo "Los usuarios son iguales";
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
    }
    // O ya se sirvió la petición, o los usuarios son distintos. En ambos casos, terminamos.
    exit;
}
else { // No hay username en el post, algo anda mal
    exit;
}

function reenviaValidacion($correo) {
    echo "Reenviando Validacion a ".$correo;
    $dao = new UsuarioDAO($correo);
    $plan = $dao->getTipoPlan();
    $md5 = $dao->getMd52confirm();
    enviaCorreoValidacion($plan, $correo, $md5);
}

function reenviaSuscripcion($correo) {
    echo "Reenviando Suscripcion a ".$correo;
}
?>

