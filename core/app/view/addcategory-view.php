<?php

if(count($_POST)>0){

	$categoria = new CategoriaData();
	$categoria->nombre = $_POST["nombre"];
	$categoria->add();

print "<script>window.location='index.php?view=categoria';</script>";

}

?>