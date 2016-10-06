<?php

	/*LOGIN*/
	 
	$tarea = $_POST['tarea'];
	require_once 'funciones_bd.php';
	$db = new funciones_BD();
	
	if ($tarea == 'LogIn'){
		$usuario = $_POST['usuario'];
		$passw = $_POST['password'];
		$token = $_POST['token'];
		$device_id= $_POST['device_id'];
					
		if($db->login($usuario,$passw,$token,$device_id)){
			
			$usuario=$db->getusuario($usuario,$token);
			$datos=$db->infousuario($usuario);
			$datos['logstatus']='1';
		
		}else if (strlen($usuario) == 0 && strlen($passw) == 0 && strlen($token) > 0){
		
			$datos['logstatus']='2';
			
		}else{
			
			$datos['logstatus']='0';
		
		}
		$resultado[0] = $datos;
		echo json_encode($resultado);
		
	} else if ($tarea == 'ActualizarDato'){
		$usuario = $_POST['usuario'];
		$atributo = $_POST['atributo'];
		$data = $_POST['data'];
		$datos['actualizado']=$db->saveData($usuario, $atributo, $data);
		$resultado[0] = $datos;
		echo json_encode($resultado);
		
	}

?>