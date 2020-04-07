<?php

if(count($_POST)>0){

	$categoria = new PosData();
	$categoria->fecha = $_POST["fecha"];
	$categoria->noches = $_POST["noches"];
	$categoria->pago_efectivo = $_POST["pago_efectivo"];
	$categoria->numero_boleta = $_POST["numero_boleta"];
	$categoria->pago_pos = $_POST["pago_pos"];
	$categoria->autorizacion = $_POST["autorizacion"];
	$categoria->numero_factura = $_POST["numero_factura"]; 
	$categoria->add();

print "<script>window.location='index.php?view=pos';</script>";

}

?>