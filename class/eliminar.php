<?php


	require("../class/clientes.php");

	$cliente = new Cliente();
	$cliente->delete($_POST['eliminar']);


