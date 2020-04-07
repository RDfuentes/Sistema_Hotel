<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.pumpkin{
    background:#8BC34A;
    padding: 4px 4px 4px;
    color:white;
    font-weight:bold;
    font-size:12px;
}
.silver{
    background:#bdc3c7;
    padding: 3px 4px 3px;
    border-bottom: black 1px solid;
    border-left:black 1px solid;
}
.clouds{
    background:#ecf0f1;
    padding: 3px 4px 3px;
    border-bottom: black 1px solid;
    border-left:black 1px solid;
}
.border-top{
    border-top: solid 1px #bdc3c7;
    
}
.border-left{
    border-left: solid 1px #bdc3c7;
}
.border-right{
    border-right: solid 1px #bdc3c7;
}
.border-bottom{
    border-bottom: solid 1px #bdc3c7;
}

.tr{
    style="color: black; background-color: #d2d6de;"
}
.contenido{
    width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;
}

table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}

.contenido {    
    font-size: 12px;    margin: 0px;     width: 480px; text-align: left;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

tr:hover td { background: #d0dafd; color: #339; }
-->
</style>


<?php 
     date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
                    
?>

<page backtop="15mm" backbottom="28mm" backleft="5mm" backright="5mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer" style="padding-bottom:10px;">
           <tr>

                <td style="width: 80%; text-align: left">
                </td>
                <td style="width: 20%; text-align: right; font-size:12px;" >
                  <b>Quinta Real Hotel</b><br />
                 
                </td>
                
            </tr>
        </table>
    </page_footer>
   
    <table cellspacing="0" style="width: 100%; border: solid 0px #7f8c8d; text-align: center; font-size: 10pt;padding:1mm; padding-top: 0mm !important;">
        <tr >
            
            <th  style="width: 60%"></th>
           
            <th class="pumpkin" style="width: 40%; border: black 1px solid">REPORTE DIARIO</th>
            
            
        </tr>
  
        <tr>
            
            <td  style="width: 60%; text-align: center"> <img style="width: 30%;" src="../../img/logo1.jpg" alt="Logo"><br /></td>
           
            <td  style="width: 40%; text-align: center;border:black 1px solid;"><br><b style="text-decoration:underline; font-family:Arial, Helvetica, sans-serif;" >FECHA<BR><BR> <?php echo $hoy; ?></b></td>
            
        </tr>
   
    </table>


  


<table>
<tr>
    <td>Tabla Alquiler</td>
</tr>
</table>
<table  class="contenido">

                  <tr class="tr" style="width: 100%; ">
                        <th style="width: 8%;">Nº</th> 
                        <th style="width: 20%;">Habitación</th>
                        <th style="width: 17%;">Dinero dejado</th>
                        <th style="width: 17%;">Servicio</th>
                        <th style="width: 10%;">Total</th>
                        <th style="width: 15%;">No. Personas</th>
                        <th style="width: 20%;">No. Factura</th>
                        <th style="width: 20%;">Fecha ingreso</th>
                        <th style="width: 20%;">Fecha salida </th> 
                  </tr>
 

        <?php $reportediarios = ProcesoData::getReporteDiario($hoy);
             if(count($reportediarios)>0){
                  // si hay usuarios
                  ?>
                 
                   <?php $numero=0;?>
                   <?php $subtotal2=0;?>
                   <?php $total=0; ?>
                  
                   <?php foreach($reportediarios as $reportediario):?>
              <?php $numero=$numero+1;?>
                  <tr> 
            <td><?php echo $numero; ?></td>
            <td><?php echo $reportediario->getHabitacion()->nombre; ?></td>
            <td><b>Q  <?php echo number_format($reportediario->dinero_dejado,2,'.',','); ?></b></td>
            <td ><b>Q  <?php echo number_format($reportediario->total,2,'.',','); ?></b></td>
            <?php $subtotal= $reportediario->total ?>
            <td >Q  <?php echo number_format($subtotal,2,'.',','); ?></td>
            <td><?php echo date($reportediario->cant_personas); ?></td>
            <td><?php echo date($reportediario->num_factura); ?></td>
            <td><?php echo date($reportediario->fecha_entra); ?></td>
            <td><?php echo date($reportediario->fecha_salida); ?></td>
       
            
            
        </tr>
        
<?php $total=$subtotal+$total; ?>
                <?php endforeach; ?>
               
            <tr class="tr" style="width: 100%; ">
                        <th style="width: 8%;"></th> 
                        <th style="width: 20%;"></th>
                        <th style="width: 17%;"></th>
                        <th style="width: 17%;">TOTAL</th>
                        <th style="width: 20%;float: right !important;">Q <?php echo number_format($total,2,'.',','); ?> </th>
                        <th style="width: 15%;"></th>
                        <th style="width: 20%;"> </th> 
                        <th style="width: 20%;"> </th> 
                        <th style="width: 20%;"> </th> 

            </tr>
<?php 

    };?>
    
    </table>




<table>
<tr>
    <td>Tabla servicio al cliente</td>
</tr>
</table>
<table  class="contenido">

                  <tr class="tr" style="width: 100%; ">
                        <th style="width: 5%;">Nº</th> 
                        <th style="width: 20%;">Habitación</th>
                        <th style="width: 56%;">Artículo</th>
                        <th style="width: 15%;">Cantidad</th>
                        <th style="width: 30%;">Precio unitario</th>
                        <th style="width: 20%;">Total</th>
                        <th style="width: 10%;">Hora </th> 
                  </tr>
 

        <?php $reporproducts = ProcesoVentaData::getReporteDiario($hoy);
                if(count($reporproducts)>0){
                  // si hay usuarios
                  ?>
                 
                   <?php $numero=0;?>
                   <?php $subtotal2=0;?>
                  
                   <?php foreach($reporproducts as $reporproduct):?>
                    <?php $numero=$numero+1;?>
                      
                     
                      
                  <tr> 
            <td><?php echo $numero; ?></td>
            <td><?php echo $reporproduct->getProceso()->getHabitacion()->nombre; ?></td>
            <td><?php echo $reporproduct->getProducto()->nombre; ?></td>
            <td ><?php echo   $reporproduct->cantidad; ?><br /></td>
            <td >Q <?php echo   number_format($reporproduct->precio,2,'.',','); ?><br /></td>
            <?php $subtotal1=$reporproduct->cantidad*$reporproduct->precio; ?>
            <td><b>Q  <?php echo number_format($subtotal1,2,'.',','); ?></b></td>
            <?php $fecha=date($reporproduct->fecha_creada);?>
            
            <td><?php echo date("h:j:i", strtotime($fecha)); ?></td>
            
            
        </tr>
        
<?php $subtotal2=$subtotal1+$subtotal2; ?>
                <?php endforeach; ?>
               
            <tr class="tr" style="width: 100%; ">
                        <th style="width: 5%;"></th> 
                        <th style="width: 20%;"></th>
                        <th style="width: 56%;"></th>
                        <th style="width: 15%;"></th>
                        <th style="width: 30%;float: right !important;"> TOTAL: </th>
                        <th style="width: 20%;">Q <?php echo   number_format($subtotal2,2,'.',','); ?></th>
                        <th style="width: 10%;"> </th> 
            </tr>
<?php 

    };?>
    </table>
    <br />
</page>

