<?php

if(count($_POST)>0){
  
	$cajas = CajaData::getAllAbierto(); 
 	if(count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}


	$tmps = TmpData::getAll();
	foreach($tmps as $p): 
		
		$procesoventa = new ProcesoVentaData();
		$procesoventa->id_producto=$p->id_producto;
		$procesoventa->id_operacion=$_POST['id_operacion'];
		$procesoventa->cantidad=$p->cantidad_tmp;
		$procesoventa->precio=$p->precio_tmp; 
		$procesoventa->id_usuario = $_SESSION["user_id"];
		$procesoventa->id_caja = $id_caja;
		if($_POST['pagado']==2){
		$procesoventa->fecha_creada="NULL"; 
		}  
		$procesoventa->add();
	endforeach;
	
	$dels = TmpData::getAll();
	foreach($dels as $del):
		$eliminar = TmpData::getById($del->id_tmp);
		$eliminar->del();
	endforeach;

?>
<script type="text/javascript">
	alert("La venta de productos se ha procesado satisfactoriamente");
</script>
<?php 
print "<script>window.location='index.php?view=pre_salida';</script>";

}

?>