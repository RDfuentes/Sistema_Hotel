

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

      <div  class="col-md-4 col-md-offset-4">
          <div class="box box-success box-solid">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title">APERTURA INICIAL DE CAJA</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form method="post"  action="index.php?view=agregar_caja" id="addcaja">
              <div class="box-body" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA APERTURA:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $hoy.' '. $hora; ?></h5></td>
                  </tr>
    
                  <tr>
                      <td><h5>MONTO APERTURA:</h5></td>
                      <td><input type="text" name="monto_apertura" onchange="this.value=this.value.replace(/\.$/, '')"  onKeyUp="if (isNaN(this.value)) this.value=this.value.replace(/[^0-9.]/g,'')" required class="form-control text-red" placeholder="Ingrese monto" style="border-color: #dd4b47;"></td>

                  </tr>
                </table>
 
              </div>

              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-left">Refrescar</a>
                <input type="hidden" name="fecha_apertura" value="<?php echo $fecha_completo; ?>">
                <input type="hidden" name="hora" value="<?php echo $hora; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <?php $cajas_abiertas = CajaData::getAllAbierto(); 
                 if(count($cajas_abiertas)>0){$caja_abierta=1;}else{$caja_abierta=0;}
                ?>
                <input type="hidden" name="" value="<?php echo $caja_abierta; ?>" id="caja_abierta">
                <input type="submit" class="btn btn-sm btn-success btn-flat pull-right" value="Dar apertura" >
               
              </div>

          </form>

          </div>
          <!-- /.box -->
      </div>

</div>



<script>
  $("#addcaja").submit(function(e){
    caja = $("#caja_abierta").val();
    
    if(caja=="1"){
      alert("HAY UNA CAJA ABIERTA, NO PUEDES ABRIR OTRA CAJA, NECESITAS CERRARLA");
      e.preventDefault();
    }
  });
</script>




<?php $cajas = CajaData::getAllAbierto(); ?>
<div class="row">

      <div  class="col-md-12">
          <div class="box box-default box-solid">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title">CAJAS ABIERTAS EN FECHAS DE HOY</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <?php if(count($cajas)>0){?>
              
              <table class="table table-bordered table-hover">
                <thead style="color: #060606;background-color: #b5b9bd;">
                  <th>FECHA DE APERTURA</th>
                  <th>MONTO APERTURA</th>
                  <th>MONTO SIN CERRAR</th>

                  <th>VENTA DEL DIA</th>
                  <th>EGRESO</th>
                  <th>MONTO ACTUAL + APERTURA</th>

                  <th>USUARIO RESPONSABLE</th>
                </thead> 
              <tr>
                <td><?php echo $cajas->fecha_apertura; ?></td>
                <td>Q  <?php echo number_format($cajas->monto_apertura,2,'.',','); ?></td>

                  <?php $montos_sin_cerrar = ProcesoData::getIngresoCaja($cajas->id);
                        $total_sin_cerrar=0;
                        if(count($montos_sin_cerrar)>0){

                          foreach($montos_sin_cerrar as $monto_sin_cerrar):
                            $total_sin_cerrar=$monto_sin_cerrar->dinero_dejado+$total_sin_cerrar;
                          endforeach;

                        }
                  ?>

                  <?php 
                if($cajas->id!=0){
                $reporproducts = ProcesoVentaData::getIngresoCaja($cajas->id);
                $subtotal3=0;
                if(count($reporproducts)>0){ ?>
                   <?php foreach($reporproducts as $reporproduct):?>
                        <?php $subtotal1=$reporproduct->cantidad*$reporproduct->precio; ?>
                    <?php $subtotal3=$subtotal1+$subtotal3; ?>
                    <?php endforeach; ?>
                <?php }else{$subtotal3=0;} ?>
                <?php }else{$subtotal3=0;} ?>


                  <?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($cajas->id);
                        $total_sin_cerrar_egreso=0;
                        if(count($montos_sin_cerrar_egresos)>0){

                          foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                            $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                          endforeach;

                        }
                  ?>

                <td>Q <?php echo number_format($total_sin_cerrar+$subtotal3-$total_sin_cerrar_egreso,2,'.',','); ?></td>





                    <?php $total=$cajas->monto_apertura+$total_sin_cerrar+$subtotal3-$total_sin_cerrar_egreso; ?>






                <td>Q  <?php echo number_format($total_sin_cerrar+$subtotal3,2,'.',','); ?></td>






                <td>Q  <?php echo number_format($total_sin_cerrar_egreso,2,'.',','); ?></td>





                <td>Q  <?php echo number_format($total,2,'.',','); ?></td>







                <td><?php if($cajas->id_usuario!=null){echo $cajas->getUsuario()->name;}else{ echo "<center>----</center>"; }  ?></td>
              </tr>
      
              

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