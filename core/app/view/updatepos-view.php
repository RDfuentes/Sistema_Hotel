<?php

if(count($_POST)>0){
	
	$nivel = PosData::getById($_POST["id_pos"]);
	$nivel->fecha = $_POST["fecha"];
	$nivel->noches = $_POST["noches"];
	$nivel->pago_efectivo = $_POST["pago_efectivo"];
	$nivel->numero_boleta = $_POST["numero_boleta"];
	$nivel->pago_pos = $_POST["pago_pos"];
	$nivel->autorizacion = $_POST["autorizacion"];
	$nivel->numero_factura = $_POST["numero_factura"];
	$nivel->update(); 

	 
print "<script>window.location='index.php?view=pos';</script>";


}


?>