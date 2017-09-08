<?php
//se va a encargar de direccionar entre el boton de agregar nuevo
//si viene por get lo manda al formulario(de crear)
require("../class/clientes.php");
require("../class/metodos_validacion.php");

class NuevoCliente extends MetodosValidacion{
	protected function validar(){
		$this->rellenarCon($_POST);
		$this->procesarForm($this->valores);
		if($this->tieneErrores()){
			//vuelve a mostrar el formulario con los errores y la informacion
			require ("../php/form_e.php");
		}else{
			
			
			/*	
			 * 
			 * //CREA UN NUEVO CLIENTE
			 * $client = new Cliente();
				$client->add();//Y LO GUARDA EN LA BASE
			* */
			
			//redirecciona a la pagina de ok
			$this->redirectOK();
		}
	}
		
	public function vienePor(){
		//ve si viene por get o por post
		//si va por post devuelve true
		if($_SERVER['REQUEST_METHOD']=='POST'){
			return TRUE;
		}
		//si va por get devuelve false
		else{
			return FALSE;
		}
	}
		
	//funcion para probar las protected
	public function hola(){
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
			$this->validar();
		}
		else{
					
			$_GET['nacionalidades']=$nacionalidades;
			require ("../php/formulario.php"); 
		}
	}
}
