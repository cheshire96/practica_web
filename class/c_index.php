<?php
		
$_POST['cont']=0;

if(isset($_POST['login'])){
	$_POST['titulo']='Login';
	require("../class/c_ingresar.php");
}
