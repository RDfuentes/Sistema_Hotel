<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
   
  });
</script>

<?php 
     date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d");

             $u=null;
                $u = UserData::getById(Session::getUID());
                $usuario = $u->is_admin;
                $id_usuario = $u->id;

   $hora = date("H:i:s");
  $fecha_completo = date("Y-m-d H:i:s");   
             
  ?>

<div class="row">
<?php $caja_abierta = CajaData::getCierreCaja(); ?>
      <div  class="col-md-4 col-md-offset-4">
          <div class="box box-warning box-solid">
            <?php if(count($caja_abierta)>0){?>
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title">CIERRE DE CAJA</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form method="post"  action="index.php?view=addcierre_caja" >
              <div class="box-body" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA CIERRE:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $hoy.' '. $hora; ?></h5></td>
                  </tr>
                    <?php $montos_sin_cerrar = ProcesoData::getIngresoCaja($caja_abierta->id);
                         $total_sin_cerrar=0;
                          if(count($montos_sin_cerrar)>0){

                            foreach($montos_sin_cerrar as $monto_sin_cerrar):
                              $total_sin_cerrar=($monto_sin_cerrar->dinero_dejado+$monto_sin_cerrar->total)+$total_sin_cerrar;
                            endforeach;

                  } ?>

                  <?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($caja_abierta->id);
                        $total_sin_cerrar_egreso=0;
                        if(count($montos_sin_cerrar_egresos)>0){

                          foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                            $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                          endforeach;

                        }
                  ?>
                  <tr>
                      <td><h5>MONTO CIERRE: $ </h5></td>
                      <td>
                        <input type="text" name="monto_apertura" required class="form-control text-red" placeholder="Ingrese monto" style="border-color: #dd4b47;" value="<?php echo number_format($total_sin_cerrar-$total_sin_cerrar_egreso,2,'.',','); ?>">
                      </td>
                  </tr>
                </table>
 
              </div> 

              <!-- /.box-body -->
              <div class="box-footer clearfix">
               
                <input type="hidden" name="fecha_apertura" value="<?php echo $caja_abierta->fecha_apertura; ?>">
                <input type="hidden" name="fecha_cierre" value="<?php echo $fecha_completo; ?>">
                <input type="hidden" name="monto_apertura" value="<?php echo $caja_abierta->monto_apertura; ?>">
                <input type="hidden" name="monto_cierre" value="<?php echo $total_sin_cerrar-$total_sin_cerrar_egreso; ?>">
                <input type="hidden" name="id_caja" value="<?php echo $caja_abierta->id; ?>">
                <?php if($_SESSION['user_id']==$caja_abierta->id_usuario){ ?>
                <input type="submit" class="btn btn-sm btn-warning btn-flat pull-right" value="Cerrar caja" >
                <?php }else{ echo "<h2>No tienes acceso a cerra la caja</h2>";} ?>
               
              </div>

          </form>
          <?php }else{ ?>
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title">NO HAY NINGÚN CAJA QUE CERRAR</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
          
              <div class="box-body" style="text-align: left;">

                
 
              </div> 
          <?php }; ?>
          </div>
          <!-- /.box -->
      </div>

</div>




                


<?php $cajas = CajaData::getAll(); ?>
<div class="row">

      <div  class="col-md-12">
          <div class="box box-default box-solid">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title">LISTA DE CAJAS (ABIERTAS Y CERRADAS)</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if(count($cajas)>0){?>
              <table class="table table-bordered table-hover" id="example1">
                <thead style="color: #ffffff;background-color: #343a40;">
                  <th>USUARIO APERTURA</th>
                  <th>FECHA APERTURA</th>
                  <th>MONTO APERTURA</th>
                  <th>FECHA CIERRE</th>
                  <th>VENTA DEL DÍA</th>
                  <th>EGRESOS</th> 
                  <th>MONTO CIERRE</th>
                  <th>ESTADO CAJA</th>
                  <th>VOLVER A IMPRIMIR</th>
                </thead> 
                
               <?php foreach($cajas as $caja):?>
              <tr>


                <?php 
                if($caja->id!=0){
                $reporproducts = ProcesoVentaData::getIngresoCaja($caja->id);
                $subtotal3=0;
                if(count($reporproducts)>0){ ?>
                   <?php foreach($reporproducts as $reporproduct):?>
                        <?php $subtotal1=$reporproduct->cantidad*$reporproduct->precio; ?>
                    <?php $subtotal3=$subtotal1+$subtotal3; ?>
                    <?php endforeach; ?>
                <?php }else{$subtotal3=0;} ?>
                <?php }else{$subtotal3=0;} ?>

   
    
                <?php 
                if($caja->id!=0){
                $reportediarios = ProcesoData::getIngresoCaja($caja->id);
                $subtotal4=0;
                if(count($reportediarios)>0){ ?>
                   <?php foreach($reportediarios as $reportediario):?>
                        <?php $subtotal= $reportediario->total+$reportediario->dinero_dejado; ?>
                    <?php $subtotal4=$subtotal+$subtotal4; ?>
                    <?php endforeach; ?>
                <?php }else{$subtotal4=0;;} ?>
                <?php }else{$subtotal4=0;} ?>

                


                <?php
                if($caja->id!=0){
                $gastos = GastoData::getEgresoCaja($caja->id);  
                $subtotal5=0;
                if(count($gastos)>0){ ?>
                   <?php foreach($gastos as $gasto):?>
                    <?php $subtotal5=$gasto->precio+$subtotal5; ?>
                    <?php endforeach; ?>
                <?php }else{$subtotal5=0;} ?>
                <?php }else{$subtotal5=0;} ?>

                <td><?php if($caja->id_usuario!=null){echo $caja->getUsuario()->name;}else{ echo "<center>----</center>"; }  ?></td>
                <td><?php echo $caja->fecha_apertura; ?></td>
                <td>Q<?php echo number_format($caja->monto_apertura,2,'.',','); ?></td>
                <td><?php echo $caja->fecha_cierre; ?></td>
                <td>Q<?php echo number_format($subtotal4+$subtotal3,2,'.',','); ?></td>
                <td>Q<?php echo number_format($subtotal5,2,'.',','); ?></td>

                <td>Q <?php echo number_format($caja->monto_apertura+$subtotal4+$subtotal3-$subtotal5,2,'.',','); ?></td>

                <td><?php if($caja->estado==1){ echo "<label class='text-danger'>ABIERTO</label>"; }
                else {echo "<label class='text-success'>CERRADO</label>";} ?></td>
                <?php if($caja->estado==1){ ?>
                <td><label class="form-label text-danger">[RE-IMPRIMIR]</label></td>
                <?php } else{?>
                <td><a href="reporte/pdf/documentos/reporte_caja.php?id=<?php echo $caja->id; ?>" target="_blank"><label class="form-label text-success">[RE-IMPRIMIR]</label></a></td>
                <?php }; ?>
              </tr>
      
               <?php endforeach;?>

           </table>

           <?php }else{ ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> No hay ningún apertura de caja!</h4>
                
              </div>
           <?php }; ?>

            </div>

            <!-- /.box-body -->
           
          </div>
          <!-- /.box -->
      </div>

</div>



<script src="plugins/select2/select2.full.min.js"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });
</script>