<?php
require("../class/clientes.php");
require("../class/metodos_validacion.php");

class NuevoCliente extends MetodosValidacion{

			
	public function agregarCliente(){
		//CREA UN NUEVO CLIENTE
		$client = new Cliente();
		$client->add();//Y LO GUARDA EN LA BASE
		
	}		
	
	public function redirectOK(){
		$url='../php/form_ok.php';
		header('Location: '. $url);
		die();
	}
		
	public function vienePor(){
		//ve si viene por get o por post
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if($_POST['cont']==0){	//si $_POST['cont'] es 0 entonces se entra al formulario por primera vez 
				return FALSE;
			}else{//sino devuelve true
				return TRUE;
			}
		}
	}
		
	//funcion para probar las protected
	public function nuevo(){
		$nacionalidades['Argentino']='Argentino';
		$nacionalidades['Uruguayo']='Uruguayo';
		$nacionalidades['Canadiense']='Canadiense';
		$nacionalidades['Chileno']='Chileno';
		
		//se le pone si esta en 'nuevo' para que despues en el form_c
		$this->valores['cliente_estado']='nuevo';
		//si es nuevo se manda se usa esto 
	
		
		if($this->vienePor()){
			if(!isset($_POST['activo'])){
				$_POST['activo']=NULL;
			}
			$_POST['nacionalidades']=$nacionalidades;
			$ok=$this->validar();
			if($ok){
				$this->agregarCliente();
				$this->redirectOK();
			}else{
				//vuelve a mostrar el formulario con los errores y la informacion
				require ("../php/form_err_nuevo.php");
			}
		}
		else{		
			$_GET['nacionalidades']=$nacionalidades;
			require ("../php/form_nuevo.php"); 
		}
	}
}

$n_cliente = new NuevoCliente;
$n_cliente->nuevo();
