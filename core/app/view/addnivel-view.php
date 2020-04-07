<?php

if(count($_POST)>0){

	$nivel = new NivelData();
	$nivel->nombre = $_POST["nombre"];
	$nivel->add();

print "<script>window.location='index.php?view=nivel';</script>";


}


?>