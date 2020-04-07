

<div class="row">

 <section class="content-header">
      <h1 >
        <span class="fa fa-hotel"></span> MANTENIMIENTO DE PRODUCTOS  DE VENTA
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Punto de venta</a></li>
        <li class="active">Productos</li>
      </ol>
</section>
</div>

<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              <h3 class="box-title">
                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"> <span class="fa fa-cutlery"></span> REGISTRAR NUEVO PRODUCTO</a>
              </h3>
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">


              <?php $productos = ProductoData::getAll();
                if(count($productos)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover">

                  <thead style="color: white; background-color:  #343a40;">
                        <th>CÓDIGO</th> 
                        <th>NOMBRE</th>
                        <th>MARCA</th>
                        <th>DETALLES</th>
                        <th>PRECIO COMPRA</th>
                        <th>PRECIO VENTA</th>
                        <th></th>  
                  </thead>
                   <?php foreach($productos as $producto):?>
                      <tr>
                        <td><?php echo $producto->codigo; ?></td>
                        <td><?php echo $producto->nombre; ?></td>
                        <td><?php if($producto->marca!="NULL"){ echo $producto->marca;}else{ echo "------"; } ?></td>
                        <td><?php if($producto->descripcion!="NULL"){ echo $producto->descripcion; }else{ echo "------";} ?></td>
                        <td><b><?php if($producto->precio_compra!="NULL"){ echo 'Q  '.number_format($producto->precio_compra,2,'.',','); }else{ echo "------";} ?></b></td>
                        <td><b>Q  <?php echo number_format($producto->precio_venta,2,'.',','); ?></b></td>

                        
                        <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal<?php echo $producto->id; ?>"  class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </td>
                      </tr> 
                    



     <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $producto->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateproduct" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-cutlery"></span> EDITAR PRODUCTO</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Código </span>
                      <input type="text" class="form-control col-md-8" name="codigo" value="<?php echo $producto->codigo; ?>" required placeholder="Ingrese Código">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombre</span>
                      <input type="text" class="form-control" name="nombre" value="<?php echo $producto->nombre; ?>" required placeholder="Ingrese Nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Marca</span>
                      <input type="text" class="form-control" name="marca" value="<?php if($producto->marca!='NULL'){echo $producto->marca; }else{ echo "";}?>" placeholder="Ingrese Marca (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Detalles</span>
                      <input type="text" class="form-control" name="descripcion" value="<?php if($producto->descripcion!='NULL'){echo $producto->descripcion; }else{ echo "";}?>" placeholder="Ingrese detalles (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio Compra Q</span>
                      <input type="number" class="form-control" name="precio_compra" value="<?php if($producto->precio_compra!='NULL'){echo $producto->precio_compra; }else{ echo "";}?>" placeholder="Ingrese Precio (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio Venta Q </span>
                      <input type="number" style="border-color: red;" class="form-control" value="<?php echo $producto->precio_venta; ?>" name="precio_venta" required placeholder="Ingrese Precio">
                    </div>
                  </div>

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" class="form-control" value="<?php echo $producto->id; ?>" name="id_producto" >
                <button type="submit" class="btn btn-outline">Actualizar producto</button>
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
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addproduct" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-cutlery"></span> INGRESAR NUEVO PRODUCTO</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Código </span>
                      <input type="text" class="form-control col-md-8" name="codigo" required placeholder="Ingrese Código">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombre</span>
                      <input type="text" class="form-control" name="nombre" required placeholder="Ingrese Nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Marca</span>
                      <input type="text" class="form-control" name="marca" placeholder="Ingrese Marca (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Detalles</span>
                      <input type="text" class="form-control" name="descripcion" placeholder="Ingrese detalles (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio Compra</span>
                      <input type="number" class="form-control" name="precio_compra" placeholder="Ingrese Precio (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio Venta</span>
                      <input type="number" style="border-color: red;" class="form-control" name="precio_venta" required placeholder="Ingrese Precio">
                    </div>
                  </div>



                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline">Registrar producto</button>
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

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
   
  });
</script>
