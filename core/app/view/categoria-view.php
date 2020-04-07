

<div class="row">

 <section class="content-header">
      <h1 >
        REGISTRO DE CATEGORÍAS
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Categorías</li>
      </ol>
</section>
</div>

<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              <h3 class="box-title">
                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"> <span class="fa fa-sitemap"></span> REGISTRAR NUEVA CATEGORÍA</a>
              </h3>
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">


              <?php $categorias = CategoriaData::getAll();
                if(count($categorias)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover">

                  <thead style="color: white; background-color: #dd4b39;">
                        <th>Nº</th> 
                        <th>NOMBRE</th>
                        <th></th> 
                  </thead>
                   <?php foreach($categorias as $categoria):?>
                      <tr>
                        <td><?php echo $categoria->id; ?></td>
                        <td><?php echo $categoria->nombre; ?></td>
                        <td>
                        <a href=""  data-toggle="modal" data-target="#myModal<?php echo $categoria->id; ?>"  class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </td>
                      </tr>  


    <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $categoria->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatecategoria" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> EDITAR CATEGORÍA O TIPO</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-12">

                    <div class="input-group">
                      <span class="input-group-addon"> Nombre</span>
                      <input type="text" class="form-control" name="nombre" value="<?php echo $categoria->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>

                    
                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <input type="hidden" class="form-control" name="id_categoria" value="<?php echo $categoria->id; ?>">
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
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addcategory" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> INGRESAR NUEVA CATEGORÍA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-12">

                    <div class="input-group">
                      <span class="input-group-addon"> Nombre</span>
                      <input type="text" class="form-control" name="nombre" required placeholder="Ingrese nombre">
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
