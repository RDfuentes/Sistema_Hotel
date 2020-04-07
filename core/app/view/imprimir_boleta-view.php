
<script type="text/javascript">
      window.onload = function() { window.print(); 

window.location='index.php?view=recepcion';

      } 
 </script>
<div class="row">

 <section class="content-header">
      <h1 >
        DETALLES DE EGRESO
        <small>Avance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Categorías</li>
      </ol>
</section>
</div>
<?php 

date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d"); 
$hora = date("H:i:s");

?>
<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">

              
              <?php $operacion = ProcesoData::getById($_GET['id']);
                if(count($operacion)>0){
                  // si hay usuarios
                  ?>
                   <tr>
                                <td style="text-align: center;"><?php echo $hoy; ?></td>
                  </tr> 
                  <div class="col-md-5 pull-right">
                        <table class="table table-bordered table-hover">
                             
                              <tr>
                                <td><b style="text-align: center;">NUMERO DE BOLETA</b></td>
                              </tr> 
         
                              <tr>
                                <td style="text-align: center;"><?php echo $operacion->num_factura; ?></td>
                              </tr> 
                             
                              
                          </table> 

                  </div>


                  <h4><td>CLIENTE:</td> <?php echo $operacion->getCliente()->nombre; ?></h4>
                  <h4>DIRECCION: <?php echo $operacion->getCliente()->direccion; ?></h4>
                  <h4>DOCUMENTO: <?php echo $operacion->getCliente()->documento; ?></h4>

                  <table class="table table-bordered table-hover">

                  <thead style="color: white; background-color: #dd4b39;">
                        <th>CANT.</th>
                        <th>DESCRIPCION</th>
                        <th>P. UNIT.</th>
                        <th>IMPORTE</th>
                  </thead>
                  

                  <?php 
                    $fecha1 = new DateTime($operacion->fecha_entrada);//fecha inicial
                      $fecha2 = new DateTime($hoy.' '.$hora);//fecha de cierre

                      $horaf = $fecha1->diff($fecha2);
                      $minutos = $fecha1->diff($fecha2);

                      $contar_dias=$horaf->format('%d');
                      $contar_hora=$horaf->format('%H');
                      $contar_minutos=$horaf->format('%i');
                      $contar_horas=$contar_hora+($contar_dias*24);
                    ?>

                    <tr>
                      <td></td>
                      <td><?php echo 'Habitación '.$operacion->getHabitacion()->nombre.' Por '.$contar_dias.' Dias y '.$contar_hora.' Horas'; ?></td>
                      <td ><b>Q  <?php echo number_format($operacion->getHabitacion()->precio,2,'.',','); ?></b></td>
                      <td><span class="badge"><b>Q  <?php echo number_format($operacion->total,2,'.',','); ?></b></span></td>
                    </tr>

                  <?php $total=0;?>
                <?php $productos = ProcesoVentaData::getByAll($_GET['id']);
                      if(count($productos)>0){ ?>
                  
                   <?php foreach($productos as $producto):?>

                    <tr>

                      <td><?php echo $producto->cantidad; ?></td>
                      <td><?php echo $producto->getProducto()->nombre; ?></td>
                      <td ><b>Q  <?php echo number_format($producto->precio,2,'.',','); ?></b></td>
                      <?php $sub_total=$producto->precio*$producto->cantidad; ?>
                      <td><span class="badge"><b>Q  <?php echo number_format($sub_total,2,'.',','); ?></b></span></td>
                    </tr>
                    <?php $total=$sub_total+$total; ?>

                    <?php endforeach; ?>
            

               <?php }else{ };?>
                  <tr>
                  <th colspan="3" style="border-right: 1px solid #a09e9e;"><p style="float: right;font-size: 18px;">Total Q </p></th>
                  <th><b>Q <?php echo number_format($total+$operacion->total,2,'.',','); ?></b></th>
                  </tr>

                   
                  </table>

               <?php }else{ 
           

                };
                ?>

           </div>
    </div>    


</section>

</div>

