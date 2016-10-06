<?php

require_once("connection.php");

/*
 * DAO = Data Access Object
 */

/**
 * Clase para acceder más limpiamente a los usuarios en la base de datos
 *
 * @author Gino
 */
class UsuarioDAO {
    // Valores en base de datos
    var $_id;
    var $_nombres;
    var $_apellidos;
    var $_rut;
    var $_direccion;
    var $_comuna;
    var $_ciudad;
    var $_region;
    var $_telefono;
    var $_correo;
    var $_contrasena;
    var $_md52confirm;
    var $_fecha_incorporacion;
    var $_fecha_inicio_plan_actual;
    var $_fecha_fin_servicio;
    var $_tipo_plan;
    var $_planes_anteriores;
    var $_contratos;
    var $_tipo_usuario;
    var $_correo_validado;
    var $_mailchimp_suscrito;
    var $_boleta_enviada;
    var $_nnttuu;
    var $_comentarios;
    var $_vp;
    
    // Flags internos
    var $existe = false;
    
    function UsuarioDAO ($correo = "") {
        global $table;
        if ($correo == "") {
			error_log("\n".date("Y/m/d H:i:s")." UsuarioDAO:: Should not use empty constructor at UsuarioDAO", 3, "error.log");
			header('Location: inicio');
        }
		$sql_query = "SELECT * FROM $table WHERE correo ='".$correo."'";
		// echo $_SESSION['correo_validado'].$_SESSION['mailchimp_suscrito'].$_SESSION['plan'];
		error_log("\n".date("Y/m/d H:i:s")." UsuarioDAO: sqlquery ".$sql_query, 3, "debug.log");
        $result = mysql_query("SELECT * FROM $table WHERE correo ='".$correo."'");
        if (mysql_num_rows($result) == 0) {
            // Usuario no existe. Queremos este caso?
            $this->existe = false;
            exit("No se encontró usuario $correo");
        }
        else {
			$_SESSION['correo'] = $correo;
            // Usuario encontrado, poblamos los campos:
            $userdata = mysql_fetch_array($result);

            $this->_id = $userdata['id'];
            $this->_nombres = $userdata['nombres'];
            $this->_apellidos = $userdata['apellidos'];
            $this->_rut = $userdata['rut'];
            $this->_direccion = $userdata['direccion'];
            $this->_comuna = $userdata['comuna'];
            $this->_ciudad = $userdata['ciudad'];
            $this->_region = $userdata['region'];
            $this->_telefono = $userdata['telefono'];
            $this->_correo = $userdata['correo'];
            $this->_contrasena = $userdata['contrasena'];
            $this->_md52confirm = $userdata['md52confirm'];
            $this->_fecha_incorporacion = $userdata['fecha_incorporacion'];
            $this->_fecha_inicio_plan_actual = $userdata['$fecha_inicio_plan_actual'];
            $this->_fecha_fin_servicio = $userdata['fecha_fin_servicio'];
            $this->_tipo_plan = $userdata['tipo_plan'];
            $this->_planes_anteriores = $userdata['planes_anteriores'];
            $this->_contratos = $userdata['contratos'];
            $this->_tipo_usuario = $userdata['tipo_usuario'];
            $this->_correo_validado = $userdata['correo_validado'];
            $this->_mailchimp_suscrito = $userdata['mailchimp_suscrito'];
            $this->_boleta_enviada = $userdata['boleta_enviada'];
            $this->_nnttuu = $userdata['nnttuu'];
            $this->_comentarios = $userdata['comentarios'];
            $this->_vp = $userdata['vp'];
            $this->existe = true;

			$this->triggerSessionUpdate($correo);
        }
    }
    
    // Update de la tabla
    function triggerUpdate() {
        global $table;
        $query = "UPDATE $table SET ";
        
        $query .= "id='".$this->_id."',";
        $query .= "nombres='".$this->_nombres."',";
        $query .= "apellidos='".$this->_apellidos."',";
        $query .= "rut='".$this->_rut."',";
        $query .= "direccion='".$this->_direccion."',";
        $query .= "comuna='".$this->_comuna."',";
        $query .= "ciudad='".$this->_ciudad."',";
        $query .= "region='".$this->_region."',";
        $query .= "telefono='".$this->_telefono."',";
        $query .= "contrasena='".$this->_contrasena."',";
        $query .= "md52confirm='".$this->_md52confirm."',";
        $query .= "fecha_incorporacion='".$this->_fecha_incorporacion."',";
        $query .= "fecha_inicio_plan_actual='".$this->_fecha_inicio_plan_actual."',";
        $query .= "fecha_fin_servicio='".$this->_fecha_fin_servicio."',";
        $query .= "tipo_plan='".$this->_tipo_plan."',";
        $query .= "planes_anteriores='".$this->_planes_anteriores."',";
        $query .= "contratos='".$this->_contratos."',";
        $query .= "tipo_usuario='".$this->_tipo_usuario."',";
        $query .= "correo_validado='".$this->_correo_validado."',";
        $query .= "mailchimp_suscrito='".$this->_mailchimp_suscrito."',";
        $query .= "boleta_enviada='".$this->_boleta_enviada."',";
        $query .= "nnttuu='".$this->_nnttuu."',";
        $query .= "comentarios='".$this->_comentarios."',";
        $query .= "vp='".$this->_vp."' ";
        
        $query .= "WHERE correo = '".$this->_correo."'";
			error_log("\n".date("Y-m-d H:i:s")." UsuarioDAO: query ".$query, 3, "debug.log");
		
        if(mysql_query($query)){
            // Exitoso
			error_log("\n".date("Y-m-d H:i:s")." UsuarioDAO: query ejecutada: ".$query, 3, "transactions.log");
            return;
        } else{
			error_log("\n".date("Y-m-d H:i:s")." UsuarioDAO: query ".$query, 3, "error.log");
		}
    }

    function triggerSessionUpdate($correo) {
        // global $table;
		if($this->_nombres==null || $this->_nombres==""){
            $_SESSION['username'] = $this->_correo;
        } else {
            $_SESSION['username'] = $this->_nombres;
        }
		$_SESSION['id'] = $this->_id;
		$_SESSION['rut'] = $this->_rut;
		if ($this->_tipo_plan == "") { unset($_SESSION['plan']); }
			else { $_SESSION['plan'] = $this->_tipo_plan; }

		$_SESSION['vp'] = $this->_vp;

		if($this->_correo_validado == 1) {  $_SESSION['correo_validado'] = 1;
								   } else { $_SESSION['correo_validado'] = 0; }
		if($this->_mailchimp_suscrito == 1) {   $_SESSION['mailchimp_suscrito']= 1;
									   } else { $_SESSION['mailchimp_suscrito'] = 0; }
		if($this->_tipo_usuario == 9)  { $_SESSION['expirado'] = 1;
								} else { $_SESSION['expirado'] = 0; }

	}

    // GETTERS 
    function getMd52confirm() {
        if (!$this->existe) {
            exit("Trying to read a value on an unexisting user: _md52confirm");
        }
        return $this->_md52confirm;
    }
    
    function getTipoPlan() {
        if (!$this->existe) {
            exit("Trying to read a value on an unexisting user: _tipo_plan");
        }
        return $this->_tipo_plan;
    }
    
    function getNombres() {
        if (!$this->existe) {
            exit("Trying to read a value on an unexisting user: _nombres");
        }
        return (is_null($this->_nombres))?"":$this->_nombres;
    }
    
    function getApellidos() {
        if (!$this->existe) {
            exit("Trying to read a value on an unexisting user: _apellidos");
        }
        return (is_null($this->_apellidos))?"":$this->_apellidos;
    }
    
    
    // SETTERS
    function setMailchimpSuscrito($suscrito) {
        if (!$this->existe) {
			error_log("\n".date("Y-m-d H:i:s")." UsuarioDAO: thisexiste", 3, "debug.log");
            exit("Trying to set a value on an unexisting user: _mailchimp_suscrito");
        }
		$this->_mailchimp_suscrito = $suscrito;
		$this->_correo_validado = $suscrito; // si se suscribio a mailchimp es porque recibio el correo
		error_log("\n".date("Y-m-d H:i:s")." UsuarioDAO: antes", 3, "debug.log");
        $this->triggerUpdate();
    }

    function setTipoPlan($tipoPlan) {
            $this->_tipo_plan = $tipoPlan;
			
	}
    function setNewPlan($plan) {
		$current_date = date('Y-m-d'); //"$getFecha[year]-$getFecha[mon]-$getFecha[mday]";
		$this->_tipo_plan = $plan;
		if ($plan=="Gratis") {
			$plan_nombre = "Gratis";
			$vigente = "Vigente";
			$contrato = "Contrato3MGratisHCo.pdf/";
			$varFechaFin = date('Y-m-d', strtotime($current_date. ' + 3 months'));
		}
		$this->_fecha_inicio_plan_actual = $current_date;
		$this->_fecha_fin_servicio = $varFechaFin;
		$this->_planes_anteriores = $plan_nombre."/".$current_date."/".$current_date."/".$varFechaFin."/".$vigente."/".$contrato."/";
		enviar_bienvenida_mailchimp($_SESSION['correo'], "", "");
        $this->triggerUpdate();
	}

}

?>