

<div class="row">

 <section class="content-header">
      <h1 >
        <span class="fa fa-hotel"></span> MANTENIMIENTO DE HABITACIONES
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Habitaciones</li>
      </ol>
</section>
</div>
 
<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              <h3 class="box-title">
                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"> <span class="fa fa-hotel"></span> REGISTRAR NUEVA HABITACIÓN</a>
              </h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <?php $habitaciones = HabitacionData::getAll();
                if(count($habitaciones)>0){ ?>
                  <table id="example1" class="table table-bordered table-hover">

                  <thead style="color: white; background-color: #dd4b39;">
                        <th >Nº</th> 
                        <th>NOMBRE</th>
                        <th>CATEGORÍA</th>
                        <th>PRECIO</th>
                        <th>DETALLES</th>
                        <th></th> 
                  </thead>
                   <?php foreach($habitaciones as $habitacion):?>
                      <tr>
                        <td><?php echo $habitacion->id; ?></td>
                        <td><?php echo $habitacion->nombre; ?></td>
                        <td><?php echo $habitacion->getCategoria()->nombre; ?></td>
                        <td><b>Q  <?php echo number_format($habitacion->precio,2,'.',','); ?></b></td>
                        <td><?php echo $habitacion->descripcion; ?></td>
                        <td>
                          <a href=""  data-toggle="modal" data-target="#myModal<?php echo $habitacion->id; ?>"  class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                          <a href="index.php?view=delhabitacion&id=<?php echo $habitacion->id; ?>"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                        </td> 
                      </tr>  
                     
     <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $habitacion->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog"> 
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateroom" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> EDITAR HABITACIÓN</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> No. Habitacion </span>
                      <input type="number" class="form-control col-md-8" name="nombre" value="<?php echo $habitacion->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>
 
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nivel </span>
                      <select class="form-control select2" required  name="id_nivel">   
                        <?php $niveles = NivelData::getAll();?>
                        <?php foreach($niveles as $nivel):?>
                        <option value="<?php echo $nivel->id;?>" <?php if($habitacion->id_nivel!=null&& $habitacion->id_nivel==$nivel->id){ echo "selected";}?>><?php echo $nivel->nombre;?></option>
                        <?php endforeach;?>
                      </select>  
                    </div> 
                  </div>
 
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Categoria</span>
                      <select class="form-control select2" required  name="id_categoria">   
                        <?php $categorias = CategoriaData::getAll();?>
                        <?php foreach($categorias as $categoria):?>
                        <option value="<?php echo $categoria->id;?>" <?php if($habitacion->id_categoria!=null&& $habitacion->id_categoria==$categoria->id){ echo "selected";}?>><?php echo $categoria->nombre;?></option>
                        <?php endforeach;?>
                      </select>  
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Detalles</span>
                      <input type="text" class="form-control" name="descripcion" value="<?php echo $habitacion->descripcion; ?>" required placeholder="Ingrese detalles">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio $ </span>
                      <input type="number" class="form-control" name="precio" value="<?php echo $habitacion->precio; ?>" required placeholder="Ingrese Precio">
                    </div>
                  </div>


                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <input type="hidden" class="form-control" name="id_habitacion" value="<?php echo $habitacion->id; ?>" >
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
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addroom" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> INGRESAR NUEVA HABITACIÓN</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> No. Habitacion </span>
                      <input type="number" class="form-control col-md-8" name="nombre" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nivel </span>
                      <select class="form-control select2" required  name="id_nivel">   
                        <?php $niveles = NivelData::getAll();?>
                        <?php foreach($niveles as $nivel):?>
                          <option value="<?php echo $nivel->id;?>"><?php echo $nivel->nombre;?></option>
                        <?php endforeach;?>
                      </select>  
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Categoria</span>
                      <select class="form-control select2" required  name="id_categoria">   
                        <?php $categorias = CategoriaData::getAll();?>
                        <?php foreach($categorias as $categoria):?>
                          <option value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></option>
                        <?php endforeach;?>
                      </select>  
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Detalles</span>
                      <input type="text" class="form-control" name="descripcion" required placeholder="Ingrese detalles">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio S/</span>
                      <input type="number" class="form-control" name="precio" required placeholder="Ingrese Precio">
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

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
   
  });
</script>
