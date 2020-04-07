
<?php 
date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
?>
<style type="text/css">
.table > tbody > tr > td{
    padding: 0px !important;
}
.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
    width: 100%;
} 
</style>
 
<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>

<script type="text/javascript">
$(function() {
            $("#documento").autocomplete({
                source: "./?action=buscar_persona",
                minLength: 2,
                select: function(event, ui) {
          event.preventDefault();
          $('#documento').val(ui.item.documento);
          $('#nombre').val(ui.item.nombre);
          $('#direccion').val(ui.item.direccion);
          $('#id').val(ui.item.id);
           }
            });
    }); 
</script>


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
        <span class="fa fa-hotel"></span> PROCESAR HABITACIÓN

      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Recepción</a></li>
        <li class="active">Procesar</li>
      </ol>
</section>
</div>
 
<div class="row">
<section class="content">

      <?php if (isset($_GET['id_habitacion'])) { ?>
         <?php $habitacion = HabitacionData::getById($_GET['id_habitacion']);
                if(count($habitacion)>0){
                  // si hay habitacion
                  ?>
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de la habitación</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                 
                  <tbody style="padding: 0px;">
                  <tr style="padding: 0px;">
                    <td><h4 class="text-primary" style="margin-top: 0px !important;">Nombre:</h4></td>
                    <td><?php echo $habitacion->nombre; ?></td>
                    <td><h4 class="text-primary" style="margin-top: 0px !important;">Tipo:</h4></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $habitacion->getCategoria()->nombre; ?></div>
                    </td>
                  </tr>
                  <tr style="padding: 0px;">
                    <td><h4 class="text-primary" style="margin-top: 0px !important;">Detalles:</h4></td>
                    <td><?php echo $habitacion->descripcion; ?></td>
                    <td><h4 class="text-primary" style="margin-top: 0px !important;">Estado:</h4></td>
                    <td> 
                      <div class="sparkbar" data-color="#f39c12" data-height="20"><span class="label label-success">DISPONIBLE</span></div>
                    </td>
                  </tr>

                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
          <!-- /.box -->
 

<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addproceso" role="form">
        <div class="box box-default">

            <div class="box-body">
              <div class="table-responsive">

                <div class="col-md-6">
                <table class="table no-margin">
                  <tr>
                    <th colspan="4" style="text-align: center;">DATOS DEL CLIENTE</th>
                  </tr>
                  <tbody style="padding: 0px;">

                  <tr style="padding: 0px;">

                
          <td colspan="2">
       
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>Tipo de Documento:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-globe"></i>
                  </div>
                  <select class="form-control" name="tipo_documento">
                    <option value="1">DPI</option>
                    <option value="2">PASAPORTE</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
                <label>Documento:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-arrow-circle-o-right"></i>
                  </div>
                  <input type="number" class="form-control" name="documento" id="documento" required="required" placeholder="Ingrese documento para buscar">
                  <input type="hidden" id="id">
                  <div class="input-group-addon">
                      <i class="fa fa-search-plus"></i>
                    </div>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Nombres:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user-secret"></i>
                  </div>
                  <input type="text" class="form-control" name="nombre" id="nombre"  required placeholder="Ingrese nombres"  onkeypress="return validar(event)" >
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Dirección:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <input type="text" class="form-control" name="direccion" id="direccion"  required placeholder="Ingrese direccion (No es obligatorio)" data-inputmask='"mask": "(999) 999-9999"' data-mask onkeypress="return validar(event)" >
                </div>
                <!-- /.input group -->
              </div>

         

</td>
                    
                  </tr>

                  
                  

                  </tbody>
                </table>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-5">
                 <table class="table no-margin">
                 <thead>
                  <tr>
                    <th colspan="4" style="text-align: center;">DATOS DEL ALOJAMIENTO</th>
                  </tr>
                  </thead>
                  <tbody style="padding: 0px;">
                  
                                    <tr style="padding: 0px;">

                
      <td colspan="3">

              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>Fecha Entrada:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" required class="form-control" name="fecha_entra" value="<?php echo $hoy; ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask >
                  
                </div>
                <!-- /.input group -->
              </div>



              <div class="form-group">
                <label>Fecha Salida:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" required class="form-control" name="fecha_entrada" value="<?php echo $hoy; ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  
                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
                <label>Numero Personas Alojadas:</label>

                  <input type="number" class="form-control" name="cant_personas" id="inputSuccess" placeholder="Ingrese Numero de Personas">
                <!-- /.input group -->
              </div>



              <div class="form-group">
                <label>Precio:</label>
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" class="form-control" name="precio" placeholder="Ingrese precio" value="<?php echo number_format($habitacion->precio,2,'.',','); ?>" readonly>

                  <div class="input-group-addon">
                    Adelanto:
                  </div>
                  <input type="number" class="form-control" name="dinero_dejado" id="inputSuccess" style="border-color: #00a65a;color: #00a65a;" placeholder="Ingrese adelanto" class="">


                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
                <label>Numero de Factura:</label>

                  <input type="number" class="form-control" name="num_factura" id="inputSuccess" placeholder="Ingrese Numero de Factura">
                <!-- /.input group -->
              </div>



             
                 <div class="box-footer">
                <a href="index.php?view=recepcion" class="btn btn-danger">Cancelar</a>
                <input type="hidden" name="id_habitacion" value="<?php echo $habitacion->id; ?>">
                <button type="submit" class="btn btn-success pull-right">Registrar ingreso</button>
              </div>
             
</td>
                    
                  </tr>

                    

                  </tbody>
                </table>
              </div>

              </div>
              <!-- /.table-responsive -->
            </div>

          </div>

  </form>
          <!-- /.box -->

        <?php }else{ 
            echo"<h4 class='alert alert-success'>NO EXISTE ESTA HABITACIÓN</h4>";

         }; ?>



    <?php }else{ 
      echo"<h4 class='alert alert-success'>NO SE SELECCIONÓ HABITACIÓN</h4>";
    };?>

         
</section>

</div>

    
      

  <script src="plugins/select2/select2.full.min.js"></script>
<link rel="stylesheet" href="plugins/select2/select2.min.css">

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });
</script> 
         