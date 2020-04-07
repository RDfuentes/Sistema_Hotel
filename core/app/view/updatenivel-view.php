<?php

if(count($_POST)>0){
	
	$nivel = NivelData::getById($_POST["id_nivel"]);
	$nivel->nombre = $_POST["nombre"];
	$nivel->update();

	
print "<script>window.location='index.php?view=nivel';</script>";


}


?>