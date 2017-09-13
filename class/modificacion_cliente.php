<?php
require("../class/clientes.php");
require("../class/metodos_validacion.php");

class ModificarCliente extends MetodosValidacion{
	
	public function guardarModCliente(){
		//CREA UN NUEVO CLIENTE
		$client = new Cliente();
		$client->update();//Y LO GUARDA EN LA BASE
			
	}		
	
	public function redirectOK(){
		$url='../php/form_ok.php';
		header('Location: '. $url);
		die();
	}
		
	public function vienePor(){
		//ve si viene por get o por post
		//si va por post devuelve true
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if($_POST['cont']==0){	//si $_POST['cont'] es 0 entonces se entra al formulario por primera vez 
				return FALSE;
			}else{//sino devuelve true
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
		
	//funcion para probar las protected
	public function modificar(){
		$nacionalidades['Argentino']='Argentino';
		$nacionalidades['Uruguayo']='Uruguayo';
		$nacionalidades['Canadiense']='Canadiense';
		$nacionalidades['Chileno']='Chileno';
		$_POST['nacionalidades']=$nacionalidades;
		
		if($this->vienePor()){
			if(!isset($_POST['activo'])){
				$_POST['activo']=NULL;
			}
			$ok=$this->validar();
			if($ok){
				$this->guardarModCliente();
				$this->redirectOK();
			}else{
				//vuelve a mostrar el formulario con los errores y la informacion
				require ("../php/form_modificaciones.php");
			}
		}
		else{
			$obj = new Cliente();
			$cliente = $obj->clientesPorId($_POST['modificar']);
			
			$_POST['id']=$cliente[0]['id'];
			$_POST['apellido']=$cliente[0]['apellido'];
			$_POST['nombre']=$cliente[0]['nombre'];
			$_POST['fecha_nac']=$cliente[0]['fecha_nac'];
			$_POST['nacionalidad']=$cliente[0]['nacionalidad'];
			$_POST['activo']=$cliente[0]['activo'];
			
			$ok=$this->validar();
			
			require ("../php/form_modificaciones.php"); 
		}
	}
}



$modi_cliente = new ModificarCliente;	
$modi_cliente->modificar();

