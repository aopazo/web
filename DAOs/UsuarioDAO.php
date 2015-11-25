<?php
require_once("../connection.php");

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
    var $_fecha_incorporacion;
    var $_md52confirm;
    var $_fecha_fin_plan_actual;
    var $_tipo_plan;
    var $_planes_anteriores;
    var $_contratos;
    var $_tipo_usuario;
    var $_correo_validado;
    var $_mailchimp_suscrito;
    var $_nnttuu;
    var $_comentarios;
    var $_vp;
    
    // Flags internos
    var $existe = false;
    
    function UsuarioDAO ($correo = "") {
        global $table;
        if ($correo == "") {
            exit('Should not use empty constructor at UsuarioDAO');
        }
        $sql_query = "Select * from $table where correo ='$correo'";
        $result = mysql_query($sql_query);
        if (mysql_num_rows($result) == 0) {
            // Usuario no existe. Queremos este caso?
            $this->existe = false;
            exit("No se encontró usuario $correo");
        }
        else {
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
            $this->_fecha_incorporacion = $userdata['fecha_incorporacion'];
            $this->_md52confirm = $userdata['md52confirm'];
            $this->_fecha_fin_plan_actual = $userdata['fecha_fin_plan_actual'];
            $this->_tipo_plan = $userdata['tipo_plan'];
            $this->_planes_anteriores = $userdata['planes_anteriores'];
            $this->_contratos = $userdata['contratos'];
            $this->_tipo_usuario = $userdata['tipo_usuario'];
            $this->_correo_validado = $userdata['correo_validado'];
            $this->_mailchimp_suscrito = $userdata['mailchimp_suscrito'];
            $this->_nnttuu = $userdata['nnttuu'];
            $this->_comentarios = $userdata['comentarios'];
            $this->_vp = $userdata['vp'];
            $this->existe = true;
        }
    }
    
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
}
