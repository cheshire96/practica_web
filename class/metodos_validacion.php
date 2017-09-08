<?php

require("../class/FormStub.php");

class MetodosValidacion extends FormStub
{
    
    protected $errores = [];
	protected $valores = [];
		
	/**
	 * Devuelve si se ha ingresado un valor en $campo.
	 */
	public function tieneValor($campo){
		return !empty($campo);
	}
		
	/**
	 * Obtiene el valor del $campo, o null si no tiene.
	 */
	public function getValor($campo){
		 if($this->tieneValor($campo)==true){
			$n_campo=$campo;
		 }else{
			 $n_campo=NULL;
		 }
		 return $n_campo;		 
	}	
		
	/**
	 * Devuelve si las validaciones han generado algún error.
	 */
	public function tieneErrores(){
		return !empty($this->errores);
	}

	/**
	 * Devuelve si se ha generado un error de validación para el $campo.
	 */
	public function tieneError($campo){
		return !empty($this->errores[$campo]);
	}
		
	/**
	 * Obtiene el error del $campo, o null si no tiene.
	 */
	public function getError($campo){
		if($this->tieneError($campo)==true){
			return $this->errores[$campo];
		 }else{
			 return NULL;
		 }
	}
		
	/**
	 * Asocia un $mensaje de error a un $campo.
	 */
	public function setError($campo, $mensaje){
		$this->errores[$campo]=$mensaje;
	}
		
	/**
	 * Si el $campo tiene un valor booleano true, devuelve el string "checked".
	 * Útil para rellenar checkboxes.
	 */
	public function getChecked($campo) {
		$c=$this->valores[$campo];
		$valor=$this->getValor($c);
		if ($valor==1){
			return "checked";
		}else{
			return NULL;
		}
	}
		
	/**
	 * Si el valor del $campo coincide con $valor_ref, devuelve el string "selected".
	 * Útil para rellenar selects.
	 */
		 
	public function getSelected($campo, $valor_ref) {
		return $this->getValor($campo) == $valor_ref ? "selected" : "";
	}
        
        
    /**
	 * Rellena el form con $arreglo_datos.
     * Se puede usar con $_GET, $_POST o un arreglo propio.
     * Devuelve $this para una API fluida.   
	 */
		 
	protected function rellenarCon($arreglo_datos){
		foreach($arreglo_datos as $i => $datos){
			$this->valores[$i]=$datos;
		}
		return $this; 
	}
		
	//Procesa los campos de tipo texto
	public function proText($campo, $mensaje){
		$dato=$this->getValor($campo);
		$clave=$mensaje;
		if($dato===NULL){
			$m="No se ha ingresado el ".$mensaje;
			$this->setError($clave, $m);
		}else{
			//solo caracteres
			if(preg_match('/[^a-zA-Z]/',$dato)){	
				$this->setError($clave, "Solo se permiten caracteres");
				return NULL;
			}
		}
			
	}
		
	//Procesa la fecha para ver si es valida
	public function proDate($campo, $mensaje){
		$valor=$this->getValor($campo);
		if($valor===NULL){
			$m="No se ha ingresado una ".$mensaje;
			$this->setError($mensaje, $m);
		}else{
			$hoy = getdate();
			$a_min=$hoy["year"]-110;
			$dia=$hoy["mday"];
			$mes=$hoy["mon"];
			if($dia<10){
				$dia="0".$dia;
			}
			if($mes<10){
				$mes="0".$mes;
			}
			$min=$a_min."-01-01";
			$max=$hoy["year"]."-".$mes."-".$dia;
				
			if ($valor<$min){//si la fecha de nacimiento es menor a la fecha min
				$m="La fecha ingresada no es valida";
				$this->setError($mensaje, $m);
			}
			if ($valor>$max){//si la fecha de nacimiento es mayor a la fecha actual
				$m="La fecha ingresada no es valida";
				$this->setError($mensaje, $m);
			}
				
		}
	}
		
	public function proCheck($campo, $mensaje){
		if(($campo!= 1)&&($campo!= NULL)){
			$m="Valor invalido en ".$mensaje;
				$this->setError($mensaje, $m);
		}
	}
		
	public function proSelected($campo, $mensaje){
		if($campo == NULL){
			$m="Valor invalido en ".$mensaje;
			$this->setError($mensaje, $m);
		}
		else{
			foreach($_POST['nacionalidades'] as $k =>$nacionalidad){
				if($nacionalidad==$campo){
					return "";
				}	
			}
			$m="El valor ingresado no es valido";
			$this->setError($mensaje, $m);			
		}
	}

	public function procesarForm($valores_form){
		$this->proText($valores_form['apellido'], 'apellido');
		$this->proText($valores_form['nombre'],'nombre');
		$this->proDate($valores_form['fecha_nac'],'fecha de nacimiento');
		$this->proCheck($valores_form['activo'],'activo');
		$this->proSelected($valores_form['nacionalidad'],'nacionalidad');
	}
		
	public function redirectOK(){
		$url='../php/form_ok.php';
		header('Location: '. $url);
		die();
	}
		
	/**
	 * Dispara las validaciones del form.
	 * Devuelve el resultado del proceso.
	 */
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

