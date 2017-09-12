<?php

require("../class/FormStub.php");

abstract class MetodosValidarUsuario extends FormStub
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
		 
	

	public function proUsuario($campo, $mensaje){
		$dato=$this->getValor($campo);
		$clave=$mensaje;
		if($dato===NULL){
			$m="No se ha ingresado el ".$mensaje;
			$this->setError($clave, $m);
		}
		if(strlen($dato)<3){
			$m="El ".$mensaje." es invalido";
			$this->setError($clave, $m);
		}			
		$d=str_replace(' ','',$dato);
		if($d!=$dato){
			$m="El ".$mensaje." es invalido";
			$this->setError($clave, $m);
		}
	}

	public function proPass($campo, $mensaje){
		$dato=$this->getValor($campo);
		$clave=$mensaje;
		if($dato===NULL){
			$m="No se ha ingresado la contrasenia";
			$this->setError($clave, $m);
		}
		if(strlen($dato)<6){
			$m="La contrasenia es demasiado corta";
			$this->setError($clave, $m);
		}			
		if(strlen($dato)>16){
			$m="La contrasenia es demasiado larga";
			$this->setError($clave, $m);
		}
	}
	
	protected function rellenarCon($arreglo_datos){
		foreach($arreglo_datos as $i => $datos){
			$this->valores[$i]=$datos;
		}
		return $this; 
	}
		
	public function procesarForm($valores_form){
		$this->proUsuario($valores_form['usuario'],'usuario');
		$this->proPass($valores_form['contrasenia'],'contrasenia');
	}
		
	
		
	/**
	 * Dispara las validaciones del form.
	 * Devuelve el resultado del proceso.
	 */
	 protected function validar(){
		$this->rellenarCon($_POST);
		$this->procesarForm($this->valores);
		if($this->tieneErrores()){
			return false;	
		}
		else{
			return true;
		}
	}
}
