
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
        <span class="fa fa-hotel"></span> REGISTRO DE CLIENTES
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="#">Clientes</a></li>
        
      </ol>
</section>
</div>

<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              <h3 class="box-title">
                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"> <span class="fa fa-hotel"></span> REGISTRAR NUEVO CLIENTE</a>
              </h3>
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">


              <?php $clientes = PersonaData::getAll();
                if(count($clientes)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover" style="font-size: 10px;">

                  <thead style="color: white; background-color: #343a40;">
                        <th>Nº</th> 
                        <th>TIPO DOCUMENTO</th>
                        <th>No.DOCUMENTO</th>
                        <th>NOMBRES COMPLETOS</th>
                        <th>APELLIDOS COMPLETOS</th>
                        <th>TELEFONO</th>
                        <th>NACIONALIDAD</th>
                        <th>PROCEDENCIA</th>
                        <th>EXTENDIDO</th>
                        <th>RAZÓN SOCIAL</th>
                        <th>FECHA DE NAC.</th>
                        <th>PROFESION</th>

                        <th></th>
                  </thead>
                   <?php foreach($clientes as $cliente):?>
                      <tr>
                        <td><?php echo $cliente->id; ?></td>
                        <td><b><?php echo $cliente->getTipoDocumento()->nombre; ?></b></td>
                        <td><?php echo $cliente->documento; ?></td>
                        <td><?php echo $cliente->nombre; ?></td>
                        <td><?php echo $cliente->apellido; ?></td>
                        <td><?php echo $cliente->telefono; ?></td>
                        <td><?php echo $cliente->nacionalidad; ?></td>
                        <td><?php echo $cliente->direccion; ?></td>
                        <td><?php echo $cliente->extendido; ?></td>
                        <td><?php echo $cliente->razon_social; ?></td>
                        <td><?php echo $cliente->fecha_nac; ?></td>
                        <td><?php echo $cliente->profesion; ?></td>
                        
                        <td>
                        <a href=""  data-toggle="modal" data-target="#myModal<?php echo $cliente->id; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </td>
                      </tr> 



    <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $cliente->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatecliente" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-users"></span> EDITAR  CLIENTE</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
 
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo de documento </span>
                      <?php $tipo_documentos = TipoDocumentoData::getAll();?>
                      <select name="tipo_documento" required class="form-control">
                      <?php foreach($tipo_documentos as $tipo_documento):?>
                        <option value="<?php echo $tipo_documento->id;?>" <?php if($cliente->tipo_documento!=null&& $cliente->tipo_documento==$tipo_documento->id){ echo "selected";}?>><?php echo $tipo_documento->nombre;?></option>
                      <?php endforeach;?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Documento </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->documento; ?>" name="documento" required placeholder="Ingrese documento">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombres Completos </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->nombre; ?>" name="nombre" required placeholder="Ingrese nombres"  onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Apellidos Completos </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->apellido; ?>" name="apellido" required placeholder="Ingrese Apellidos" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Telefono </span>
                      <input type="number" class="form-control col-md-8" value="<?php echo $cliente->telefono; ?>" name="telefono" required placeholder="Telefono">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nacionalidad </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->nacionalidad; ?>" name="nacionalidad" required placeholder="Nacionalidad" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Direccion </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->direccion; ?>" name="direccion" required placeholder="Direccion" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Extendido </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->extendido; ?>" name="extendido" required placeholder="Extendido" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Razón social </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->razon_social; ?>" name="razon_social"  placeholder="Ingrese Razón social (OPCIONAL)" onkeypress="return validar(event)">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha nac </span>
                       <input type="date" name="fecha_nac" class="form-control"   value="<?php echo $cliente->fecha_nac; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Profesion </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->profesion; ?>" name="profesion" required placeholder="Profesion" onkeypress="return validar(event)">
                    </div>
                  </div>

                 
                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <input type="hidden" name="id_cliente" value="<?php echo $cliente->id; ?>">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
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
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addclient" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-users"></span> INGRESAR NUEVO CLIENTE</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
 
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo de documento </span>
                      <select class="form-control" required name="tipo_documento">
                        <option value="1">DPI</option>
                        <option value="2">PASAPORTE</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Numero de Documento </span>
                      <input type="text" class="form-control col-md-8" name="documento" required placeholder="Ingrese documento">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombres Completos </span>
                      <input type="text" class="form-control col-md-8" name="nombre" required placeholder="Ingrese nombres" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Apellidos Completos</span>
                      <input type="text" class="form-control col-md-8" name="apellido" required placeholder="Ingrese Apellidos" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Telefono </span>
                      <input type="number" class="form-control col-md-8" name="telefono" required placeholder="Telefono">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nacionalidad </span>
                      <input type="text" class="form-control col-md-8" name="nacionalidad" required placeholder="Nacionalidad" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Direccion </span>
                      <input type="text" class="form-control col-md-8" name="direccion" required placeholder="Direccion" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Extendido </span>
                      <input type="text" class="form-control col-md-8" name="extendido" required placeholder="Extendido" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Razón social </span>
                      <input type="text" class="form-control col-md-8" name="razon_social"  required placeholder="Ingrese Razon Social" onkeypress="return validar(event)">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha nac </span>
                       <input type="date" name="fecha_nac" class="form-control" value="<?php echo $hoy; ?>" >
                    </div>
                  </div>

                 <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Profesion </span>
                      <input type="text" class="form-control col-md-8" name="profesion" required placeholder="Profesion" onkeypress="return validar(event)">
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
