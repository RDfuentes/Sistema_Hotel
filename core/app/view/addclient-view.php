<?php

if(count($_POST)>0){

	$cliente = new PersonaData();
	$cliente->tipo_documento = $_POST["tipo_documento"];
	$cliente->documento = $_POST["documento"];
	$cliente->nombre = $_POST["nombre"];
	$cliente->apellido = $_POST["apellido"];
	$cliente->telefono = $_POST["telefono"];
	$cliente->nacionalidad = $_POST["direccion"];
	$cliente->direccion = $_POST["direccion"];
	$cliente->extendido = $_POST["extendido"];
	$cliente->razon_social = $_POST["razon_social"];
	$cliente->fecha_nac = $_POST["fecha_nac"];  
	$cliente->profesion = $_POST["profesion"];



	$cliente->addCliente();

print "<script>window.location='index.php?view=cliente';</script>";


}


?>