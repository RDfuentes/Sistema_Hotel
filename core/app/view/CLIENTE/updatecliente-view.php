<?php

if(count($_POST)>0){

	$cliente = PersonaData::getById($_POST["id_cliente"]);
	$cliente->tipo_documento = $_POST["tipo_documento"];
	$cliente->documento = $_POST["documento"];
	$cliente->nombre = $_POST["nombre"];
	$cliente->apellido = $_POST["apellido"];
	$cliente->nacionalidad = $_POST["nacionalidad"];
	$cliente->razon_social = $_POST["razon_social"];
	$cliente->direccion = $_POST["direccion"];
	$cliente->fecha_nac = $_POST["fecha_nac"];


	$cliente->updatecliente(); 

print "<script>window.location='index.php?view=cliente';</script>";


}


?>