<?php
 
class funciones_BD {
  
    private $db;
 
    // constructor

    function __construct() {
        require_once 'connectbd.php';
        // connecting to database

        $this->db = new DB_Connect();
        $this->db->connect();

    }
 
    // destructor
    function __destruct() {
 
    }
	
	public function getusuario($user,$token){
		$result = mysql_query("SELECT COUNT(*) FROM aplicacion WHERE sesion_token = '$token'");
		$count = mysql_fetch_row($result);		
		
		if ($count[0]==0){
			return $user;
		}else{
			$resultUser = mysql_query("SELECT correo FROM aplicacion WHERE sesion_token = '$token'");
			$countUser = mysql_fetch_row($resultUser);		
			return $countUser[0];
		}
	}
	
	public function login($user,$passw,$token,$device_id){
		$resultToken=mysql_query("SELECT COUNT(*) FROM aplicacion WHERE sesion_token = '$token' and id_dispositivo = '$device_id' and vencimiento_sesion > CURRENT_TIMESTAMP ");
		$countToken = mysql_fetch_row($resultToken);		
		
		if ($countToken[0]==0){				
			$result = mysql_query("SELECT COUNT(*) FROM usuarios WHERE correo='$user' ");
			$count = mysql_fetch_row($result);
			if ($count[0]==0){			
				return false;						
			}else{		
				$resultPass=mysql_query("SELECT contrasena FROM usuarios WHERE correo='$user' ");
				$arrPass = mysql_fetch_row($resultPass);
			    
				if(crypt($passw, $arrPass[0]) == $arrPass[0]){
					// crear token
					$tokenNuevo = base64_encode($user.mt_rand());
					$resultToken=mysql_query("SELECT COUNT(*) FROM aplicacion WHERE correo='$user'");
					$countToken = mysql_fetch_row($resultToken);
					
					if ($countToken[0]==0){	
						$sql_usr = "INSERT INTO aplicacion (correo,sesion_token,id_dispositivo ,vencimiento_sesion) VALUES ('$user', '$tokenNuevo', '$device_id', Date_Add(CURRENT_TIMESTAMP, INTERVAL 30 DAY))";
					}else{
						$sql_usr = "UPDATE aplicacion SET sesion_token = '$tokenNuevo', id_dispositivo  = '$device_id', vencimiento_sesion = Date_Add(CURRENT_TIMESTAMP, INTERVAL 30 DAY) Where correo = '$user'";
					}
					mysql_query($sql_usr);
					return true;
				}else{
					return false;
				}
		
			}
		}else{			
			return true;
		}
	}
		
	public function saveData($usuario, $atributo, $data){
		if ($atributo == 'gcm_token'){
			$sql_usr = "UPDATE aplicacion SET gcm_token = '$data' Where correo = '$usuario'";
			mysql_query($sql_usr);
			return true;
		} else if ($atributo == 'siSMS'){
			$sql_usr = "UPDATE aplicacion SET siSMS = $data Where correo = '$usuario'";
			mysql_query($sql_usr);
			return true;
		} else if ($atributo == 'siNotificacion'){
			$sql_usr = "UPDATE aplicacion SET siNotificacion = $data Where correo = '$usuario'";
			mysql_query($sql_usr);
			return true;
		}
		return false;
	}
	
	public function infousuario($user){

		$result=mysql_query("SELECT COUNT(*) FROM usuarios WHERE correo='$user' ");
		
		$count = mysql_fetch_row($result);
		
		if ($count[0]==0){
			return array("estado"=>"-1");
		}else{
			//tipo_usuario(1-gratis,2,3,9-expirado), correo_validado, mailchimp_suscrito(0,1,2)
			$resultInfo=mysql_fetch_row(mysql_query("SELECT Case tipo_usuario when 1 then 'Plan gratis' when 2 then 'Plan premium anual' when 3 then 'Plan premium bianual' when 9 then 'Plan expirado' else 'No tienes plan' End as 'tipo_usuario', Case correo_validado when 1 then 'Validado' else 'No validado' End as 'correo_validado', Case mailchimp_suscrito when 1 then 'Suscrito' when 2 then 'Suscrito a lista de correos' else 'No suscrito a lista de correos' End as 'mailchimp_suscrito', fecha_fin_plan_actual, nombres, apellidos, direccion, comuna, ciudad, region, telefono, correo, contratos, rut FROM usuarios WHERE correo='$user' "));
			$Recomendacion=mysql_fetch_row(mysql_query("SELECT Fecha, Recomendacion FROM recomendaciones ORDER BY Fecha DESC LIMIT 1 "));
			$Fondo=mysql_fetch_row(mysql_query("SELECT Recomendacion FROM recomendaciones WHERE Recomendacion <> 'M' ORDER BY Fecha DESC LIMIT 1 "));
			$UltimaFechaCruzada=mysql_fetch_row(mysql_query("SELECT Fecha FROM recomendaciones WHERE Recomendacion not in ('M', '" . $Fondo[0] . "') ORDER BY Fecha DESC LIMIT 1 "));
			$PrimeraFechaFondo=mysql_fetch_row(mysql_query("SELECT Fecha FROM recomendaciones WHERE Recomendacion <> 'M' and Fecha > '" . $UltimaFechaCruzada[0] . "' ORDER BY Fecha ASC LIMIT 1 "));
			$Actualizacion=mysql_fetch_row(mysql_query("SELECT CURRENT_TIMESTAMP as actualizacion "));
			$InfoApp = mysql_fetch_row(mysql_query("SELECT sesion_token, siNotificacion FROM aplicacion WHERE correo = '$user'"));
			
			$resultado['estado']=$resultInfo[0];
			$resultado['correo_validado']=$resultInfo[1];
			$resultado['mailchimp_suscrito']=$resultInfo[2];
			$resultado['fecha_fin_plan_actual']=$resultInfo[3];
			$resultado['nombres']=$resultInfo[4];
			$resultado['apellidos']=$resultInfo[5];
			$resultado['direccion']=$resultInfo[6];
			$resultado['comuna']=$resultInfo[7];
			$resultado['ciudad']=$resultInfo[8];
			$resultado['region']=$resultInfo[9];
			$resultado['telefono']=$resultInfo[10];
			$resultado['correo']=$resultInfo[11];
			$resultado['contratos']=$resultInfo[12];
			$resultado['rut']=$resultInfo[13];
			$resultado['fecha_recomendacion_actual']=$Recomendacion[0];
			$resultado['recomendacion_actual']=$Recomendacion[1];
			$resultado['fecha_fondo_actual']=$PrimeraFechaFondo[0];
			$resultado['fondo_actual']=$Fondo[0];
			$resultado['actualizacion']=$Actualizacion[0];
			$resultado['token_sesion']=$InfoApp[0];
			if ($InfoApp[1] == 0) {
				$resultado['siNotificacion']=false;
			}else{
				$resultado['siNotificacion']=true;
			}
			
			return $resultado;
			
		}
	}
  
}
 
?>