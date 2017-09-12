<?php

$_POST['cont']=0;
if(isset($_POST['nuevo'])){
	$_POST['titulo']='Nuevo Cliente';
	require("../class/nuevo.php");
}
if(isset($_POST['modificar'])){
	$_POST['titulo']='Modificar Cliente';
	require("../class/modificacion_cliente.php");
}
if(isset($_POST['eliminar'])){
	require("../class/eliminar.php");
}

