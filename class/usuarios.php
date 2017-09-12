<?php
require_once 'conexion.php';
class Usuario extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // BUSCAR USUARIO
    //*****************************************************************
    
    public function buscarUsuario($usuario, $pass){
        $consulta = sprintf("SELECT
            id,
            usuario,
            contrasenia
            FROM
            usuarios
            WHERE
            usuario = %s AND contrasenia = %s", 
            parent::comillas_inteligentes($usuario),
            parent::comillas_inteligentes($pass)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data; 
        }
    }
    

}
