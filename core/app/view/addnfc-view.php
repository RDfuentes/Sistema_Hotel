<?php

if(count($_POST)>0){

	$empresa = new NcfData();
	
	$tipo="NULL";
	if($_POST["tipo"]!=""){ $tipo=$_POST["tipo"];}
	$empresa->tipo = $tipo;

	$secuencia="NULL";
	if($_POST["secuencia"]!=""){ $secuencia=$_POST["secuencia"];}
	$empresa->secuencia = $secuencia;

	$cantidad='NULL';
	if($_POST["cantidad"]!=""){ $cantidad=$_POST["cantidad"];}
	$empresa->cantidad = $cantidad;

	
	  
	$empresa->add();

print "<script>window.location='index.php?view=configuracion';</script>";


}


?>