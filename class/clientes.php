<?php
require_once 'conexion.php';
class Cliente extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTAMOS TODO EL PERSONAL
    //*****************************************************************
    public function clientes(){
        $resultado = $this->mysqli->query("SELECT
            clientes.id,
            clientes.apellido,
            clientes.nombre,
            clientes.edad,
            cliente.nacionalidad,
            clientes.activo
            FROM
            clientes
            ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data; 
        } 
        
    }
    //*****************************************************************
    // AGREGAR CLIENTE
    //*****************************************************************
    public function add() {

        $consulta = sprintf(
            "INSERT INTO clientes values(null, %s, %s, %s, %s, %s);",  
            parent::comillas_inteligentes($_POST['apellido']), 
            parent::comillas_inteligentes($_POST['nombre']), 
            parent::comillas_inteligentes($_POST['edad']),
            parent::comillas_inteligentes($_POST['nacionalidad']),
            parent::comillas_inteligentes($_POST['activo'])
            );
        $this->mysqli->query($consulta);

    }
    
    //*****************************************************************
    // MODIFICAR CLIENTES
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE clientes SET
            apellido = %s,
            nombre = %s,
            edad = %s,
            nacionalidad = %s,
            activo = %s
            WHERE
            id = %s;", 
            parent::comillas_inteligentes($_POST['apellido']), 
            parent::comillas_inteligentes($_POST['nombre']),
            parent::comillas_inteligentes($_POST['edad']),
            parent::comillas_inteligentes($_POST['nacionalidad']),
            parent::comillas_inteligentes($_POST['activo']),
            parent::comillas_inteligentes($_POST['id'])
            );

        $this->mysqli->query($consulta);

        echo "<script type='text/javascript'>window.location='../index.php';</script>";
    }
    //*****************************************************************
    // ELIMINAR CLIENTE
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM clientes WHERE id = %s;", 
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header("Location: ../index.php");
    }
    //*****************************************************************
    // CLIENTES POR ID
    //*****************************************************************
    public function clientesPorId($id){
        $consulta = sprintf("SELECT
            clientes.id,
            clientes.apellido,
            clientes.nombre,
            clientes.edad,
            clientes.nacionalidad,
            clientes.activo
            FROM
            clientes
            WHERE
            clientes.id = %s", 
            parent::comillas_inteligentes($id)
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
?>
