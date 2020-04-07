<script type="text/javascript">
function validar(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron =/[A-Za-z\s]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}
</script>

<div class="row">

 <section class="content-header">  
      <h1 >
        REGISTRO DE DEPOSITOS POS 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Depositos</li>
      </ol>
</section>
</div>

<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              <h3 class="box-title">
                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"> REGISTRAR NUEVO DEPOSITO</a>
              </h3>

              <h3 class="box-title">
                <a onclick="tableToExcel('example1', 'W3C Example Table')"  data-toggle="modal"  class="btn btn-success btn-sm"> IMPRIMIR REPORTE</a>
              </h3>
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <?php $poss = PosData::getAll();
                if(count($poss)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover" summary="Code page support in different versions of MS Windows." rules="groups" frame="hsides" border="2"><caption>REPORTE DE DEPOSITOS</caption>

                  <thead style="color: white; background-color: #dd4b39;">
                        <th>No.</th> 
                        <th>FECHA</th>
                        <th>NOCHES</th>
                        <th>PAGO EFECTIVO</th>
                        <th>NUMERO DE BOLETA</th>
                        <th>PAGO POS</th>
                        <th>AUTORIZACION</th>
                        <th>NO. FACTURA</th>

                        <th></th> 
                  </thead>
                   <?php foreach($poss as $pos):?>
                      <tr>
                        <td><?php echo $pos->id; ?></td>
                        <td><?php echo $pos->fecha; ?></td>
                        <td><?php echo $pos->noches; ?></td>
                        <td><?php echo $pos->pago_efectivo; ?></td>
                        <td><?php echo $pos->numero_boleta; ?></td>
                        <td><?php echo $pos->pago_pos; ?></td>
                        <td><?php echo $pos->autorizacion; ?></td>
                        <td><?php echo $pos->numero_factura; ?></td>
                        <td>
                        <a href=""  data-toggle="modal" data-target="#myModal<?php echo $pos->id; ?>"  class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        <a href="index.php?view=deldeposito&id=<?php echo $pos->id; ?>"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                        </td>
                      </tr>  


    <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $pos->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatepos" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> EDITAR POS</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-12">

                    
                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha</span>
                      <input type="date" class="form-control" name="fecha" value="<?php echo $pos->fecha; ?>" required placeholder="Ingrese fecha" style="border-color: red">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Noches</span>
                      <input type="number" class="form-control" name="noches" value="<?php echo $pos->noches; ?>" required placeholder="Ingrese Noches" style="border-color: red">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Pago en Efectivo</span>
                      <input type="number" class="form-control" name="pago_efectivo" value="<?php echo $pos->pago_efectivo; ?>" required placeholder="Ingrese Noches" style="border-color: green">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Boleta</span>
                      <input type="text" class="form-control" name="numero_boleta" value="<?php echo $pos->numero_boleta; ?>" required placeholder="Ingrese Numero de Boleta" style="border-color: green">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Pago POS</span>
                      <input type="number" class="form-control" name="pago_pos" value="<?php echo $pos->pago_pos; ?>" required placeholder="Ingrese Numero de pago POS" style="border-color: purple">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Autorizacion</span>
                      <input type="text" class="form-control" name="autorizacion" value="<?php echo $pos->autorizacion; ?>" required placeholder="Ingrese Numero de Autorizacion" style="border-color: purple">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Factura</span>
                      <input type="text" class="form-control" name="numero_factura" value="<?php echo $pos->numero_factura; ?>" required placeholder="Ingrese Numero de Factura" style="border-color: red">
                    </div>
                  </div>

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <input type="hidden" class="form-control" name="id_pos" value="<?php echo $pos->id; ?>">
                <button type="submit" class="btn btn-outline">Actualizar Datos</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

                    <?php endforeach; ?>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>

           </div>
    </div>    


</section>

</div>

      <div class="modal fade bs-example-modal-xm" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addpos" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> INGRESAR DEPOSITO POS</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-12">

                    
                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Ingrese Fecha</span>
                      <input type="date" class="form-control" name="fecha" required placeholder="Ingrese Fecha" style="border-color: red">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Noches</span>
                      <input type="number" class="form-control" name="noches" required placeholder="Numero Noches" style="border-color: red">
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Pago en Efectivo</span>
                      <input type="number" class="form-control" name="pago_efectivo" required placeholder="Ingrese Cantidad"  style="border-color: green">
                    </div>  
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Boleta</span>
                      <input type="text" class="form-control" name="numero_boleta" required placeholder="Ingrese Numero de Boleta" style="border-color: green ">
                    </div>  
                  </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Pago POS</span>
                      <input type="number" class="form-control" name="pago_pos" required placeholder="Ingrese Cantidad" style="border-color: purple">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Autorizacion</span>
                      <input type="text" class="form-control" name="autorizacion" required placeholder="Ingrese Numero de Autorizacion" style="border-color: purple">
                    </div>  
                  </div>

                     <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon"> Numero de Factura</span>
                      <input type="text" class="form-control" name="numero_factura" required placeholder="Ingrese Numero de Factura" style="border-color: red">
                    </div> 
                  </div>

                    
                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-outline">Agregar Datos</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

      
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<!-- JavaScript de Excel  -->
<script type="text/javascript" src="plugins/datatables/TablaExcel.js"></script>


<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
   
  });
</script>
