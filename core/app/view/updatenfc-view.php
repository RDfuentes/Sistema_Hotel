<?php

if(count($_POST)>0){
 
	$empresa = NcfData::getById($_POST["id_ncf"]);
	$tipo="NULL";
	if($_POST["tipo"]!=""){ $tipo=$_POST["tipo"];}
	$empresa->tipo = $tipo;

	$secuencia="NULL";
	if($_POST["secuencia"]!=""){ $secuencia=$_POST["secuencia"];}
	$empresa->secuencia = $secuencia;

	$cantidad='NULL';
	if($_POST["cantidad"]!=""){ $cantidad=$_POST["cantidad"];}
	$empresa->cantidad = $cantidad;

	$empresa->update();

print "<script>window.location='index.php?view=configuracion';</script>";


}

?>