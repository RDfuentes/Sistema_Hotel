<?php

if(count($_POST)>0){

	$cajas = CajaData::getAllAbierto(); 
 	if(count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}

	$clientes = PersonaData::getLikeDni($_POST["documento"]);
	if(count($clientes)>0){
	  $id_cliente=$clientes->id;	
	}else{
	  $cliente = new PersonaData();
	  $cliente->tipo_documento = $_POST["tipo_documento"];
	  $cliente->documento = $_POST["documento"];
	  $cliente->nombre = $_POST["nombre"];

	  $direccion="NULL";
  		if($_POST["direccion"]!=""){ $direccion=$_POST["direccion"];}
	  $cliente->direccion = $direccion;
	  $s = $cliente->add();
	  $id_cliente=$s[1];
	}

	$habitacion = HabitacionData::getById($_POST["id_habitacion"]);
	$habitacion->estado = 2;
	$habitacion->updateEstado();
 

	$proceso = new ProcesoData();
	$proceso->id_habitacion = $_POST["id_habitacion"];
	$proceso->id_cliente = $id_cliente;
	$proceso->dinero_dejado = $_POST["dinero_dejado"];
	$proceso->fecha_entrada = $_POST["fecha_entrada"];
	$proceso->cant_personas = $_POST["cant_personas"];
	$proceso->num_factura = $_POST["num_factura"];
	$proceso->fecha_entra = $_POST["fecha_entra"];
	$proceso->id_usuario = $_SESSION["user_id"];
	$proceso->id_caja = $id_caja;
	$proceso->addIngreso();


print "<script>window.location='index.php?view=recepcion';</script>";

}

?>