<?php

$_POST['cont']=0;
if(isset($_POST['nuevo'])){
	require("../class/nuevo.php");
}
if(isset($_POST['modificar'])){
	require("../class/modificacion_cliente.php");
}
if(isset($_POST['eliminar'])){
	require("../class/eliminar.php");
}
