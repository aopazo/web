<?php
	session_start();
	require_once("connection.php");
  	require_once("functions.php");

	if ($testing == "on") 	echo($_SESSION['correo']."<br />");
	// if(0){
	if(isset($_SESSION['correo'])){
		if($_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
			echo "Oops, algo extra&ntilde;o ha sucedido, por favor, intenta recargar la p&aacute;gina o bien cierra tu sesi&oacute;n e ingresa nuevamente desde <a href=\"http://www.atempus.cl\">www.atempus.cl</a>.<br />Gracias";
			error_log(print_r("get-recomendaciones:: usuario con sesion id: ".$_SESSION['id']." pero alguna variable se perdio ".$_SESSION['REMOTE_ADDR'].", ".$_SERVER['REMOTE_ADDR'].", ".$_SESSION['HTTP_USER_AGENT'].", ".$_SERVER['HTTP_USER_AGENT'], TRUE), 0);
			exit(1);
		}
	}

   	if (!isset($_SESSION['correo'])){
		header('Location: inicio');
	}

$str = "";
// if user premium
if($_SESSION['plan'] == "12000" || $_SESSION['plan'] == "20400"){
    // echo archivo sin desfase
    $str = file_get_contents("recomendacionesSD.txt");
} else {
    $str = file_get_contents("recomendacionesCD.txt");
}
echo $str; 
// echo archivo con desfase    
    
    
?>