<?php
require("../class/usuarios.php");
require("../class/validar_form_us.php");

class UsuarioValidacion extends MetodosValidarUsuario{
	
	public function iniciarSesion($usuario){
		session_start();
		$_SESSION['userid'] = $usuario[0]['id'];
		$_SESSION['usuario'] = $usuario[0]['usuario'];
	}
	
	
	public function cerrarSesion(){
		session_start();
		unset($_SESSION['userid']);
		session_destroy(); 
		header('location: ../index.php');
		die(); 
	}
	
	
	
	public function redirectOK(){
		$url='../php/mostrar.php';
		header('Location: '. $url);
		die();
	}
		
	public function vienePor(){
		//ve si viene por get o por post
		//si va por post devuelve true
		if($_SERVER['REQUEST_METHOD']=='POST'){
				return TRUE;
		}else{
			return FALSE;
		}
	}
	
		
	//funcion para probar las protected
	public function verificar(){
		
		if($this->vienePor()){
			if($_POST['login']==1){	
				$ok=$this->validar();
				if($ok){
					$us = new Usuario();
					$key = sha1($this->valores['contrasenia']); 
					$usuario = $us->buscarUsuario($this->valores['usuario'],$key);
					if(!empty($usuario)){
						$this->iniciarSesion($usuario);
						$this->redirectOK();
					}else{
						$this->setError('us_pass', 'El usuario o la contrasenia son erroneos.');
					
						require ("../php/login.php");
					}
				}else{
					//vuelve a mostrar el formulario con los errores y la informacion
					require ("../php/login.php");
				}
			}else{
				if(isset($_POST['logout'])){
				if($_POST['logout']=='logout'){
					$this->cerrarSesion();
				}}
				else{
					require ("../php/login.php"); 
				}
			}
		}
		else{
			require ("../php/login.php"); 
		}
	}
}
$usuario = new UsuarioValidacion;
$usuario->verificar();

