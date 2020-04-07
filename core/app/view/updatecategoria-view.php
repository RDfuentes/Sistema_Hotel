<?php

if(count($_POST)>0){
	
	$nivel = CategoriaData::getById($_POST["id_categoria"]);
	$nivel->nombre = $_POST["nombre"];
	$nivel->update();

	 
print "<script>window.location='index.php?view=categoria';</script>";


}


?>