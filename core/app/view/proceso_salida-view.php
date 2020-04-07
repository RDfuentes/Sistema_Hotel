<script type="text/javascript" language="javascript" src="js/ajax.js"></script>  
<?php 
$clientes = PersonaData::getAll();

date_default_timezone_set('America/Guatemala');
$hoy = date("Y-m-d"); 
$hora = date("H:i:s");

?>

  <link rel="stylesheet" href="plugins/select2/select2.min.css">


<style type="text/css">
  
  .list-group-item {
    position: relative;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
    background-color: #ecf0f5;
    border: 1px solid #ddd;
}
 
</style>
<body onload="document.getElementById('numero2').focus();">
<div class="row">

 <section class="content-header">
      <h1 >
       <i class='fa fa-sign-out'></i> PROCESO CHECK OUT 

      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Check out</a></li>
        <li class="active">Proceso check out</li>
      </ol>
</section>
</div>

<?php 
if(isset($_GET['id'])){
$habitacion = ProcesoData::getById($_GET['id']);
if(count($habitacion)>0){ ?>
<div class="row">


  <input type="hidden" name="id_operacion" value="<?php echo $habitacion->id; ?>">
  <section>
    <div class="row">
    <div class="col-md-4">
      <br>

            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="border-top: 2px solid black;">
                  <b>Nombre habitación</b> <a class="pull-right"><?php echo $habitacion->getHabitacion()->nombre; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Tipo habitación</b> <a class="pull-right"><?php echo $habitacion->getHabitacion()->getCategoria()->nombre; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Costo por dia</b> <a class="pull-right"><b>Q  <?php echo number_format($habitacion->getHabitacion()->precio,2,'.',','); ?></b></a>
                </li>
                
              </ul>
            </div>
            <!-- /.box-body -->
   
         </div>
         <div class="col-md-4">
    <br>

            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="border-top: 2px solid black;">
                  <b>Nombre cliente</b> <a class="pull-right"><?php echo $habitacion->getCliente()->nombre; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Documento cliente</b> <a class="pull-right"><?php echo $habitacion->getCliente()->documento; ?></a>
                </li>
               
              </ul>
            </div>
            <!-- /.box-body -->
  
         </div>

         <div class="col-md-4">
    <br>
<?php 
$fecha1 = new DateTime($habitacion->fecha_entrada);//fecha inicial
  $fecha2 = new DateTime($hoy.' '.$hora);//fecha de cierre

  $horaf = $fecha1->diff($fecha2);
  $minutos = $fecha1->diff($fecha2);

  $contar_dias=$horaf->format('%d');
  $contar_hora=$horaf->format('%H');
  $contar_minutos=$horaf->format('%i');
  $contar_horas=$contar_hora+($contar_dias*24);
?>

            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="border-top: 2px solid black;">
                  <b>Fecha de entrada</b> <b><a class="pull-right" style="color: #343a40;"><?php echo $habitacion->fecha_entra; ?></a></b>
                </li>
                <li class="list-group-item">
                  <b>Fecha de salida</b> <b><a class="pull-right" style="color: #dd4b39;"><?php echo $hoy; ?></a></b>
                </li>
                <li class="list-group-item">
                  <b>Calcular tiempo</b> <a class="pull-right"><b><?php echo $contar_dias.' Dias y '.$contar_hora.' Horas'; ?></b></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
  
         </div>


        </div>


<?php 

      $total_alojamiento=0; 
      if($contar_dias==0 ){

        $total_alojamiento=$habitacion->getHabitacion()->precio * 1;


      }else if($contar_dias!=0){

        $total_alojamiento=$habitacion->getHabitacion()->precio * ($contar_dias + 1);

      };
  

  ?>




      <div class="col-md-12">
          <div class="box box-default" >
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="4" style="border-right:1px solid #a09e9e;">Costo del alojamiento</th>
                  <th style="width: 100px"></th>
                </tr>
                <tr>
                  <th style="width: 10px;border-right: 1px solid #a09e9e;">#</th>
                  
                  <th>Costo calculado </th>
                  <th>Dinero dejado</th>
                  <th style="border-right:1px solid #a09e9e;" colspan="2">Saldo</th>
                  <th style="border-right:1px solid #a09e9e;" colspan="3">Anticipo</th>
                  
                  <th style="width: 40px"></th>
                </tr>
             <form action="index.php?view=addsalida" method="post" name="sumar">
                <tr>
                  <td style="border-right: 1px solid #a09e9e;">1.</td>
            
                  <td >Q<?php echo number_format($total_alojamiento,2,'.',','); ?></td>
                  <td ><b>Q <?php echo number_format($habitacion->dinero_dejado,2,'.',','); ?></b></td>
                  <script>
                  function fncSumar(){ 
                  caja=document.forms["sumar"].elements;
                  var numero = Number(caja["numero"].value);
                  var numero1 = Number(caja["numero1"].value);
                  var numero2 = Number(caja["numero2"].value);
                  var subtotal = Number(caja["subtotal"].value);
                  resultado=(numero1)+numero2;
                  total=resultado+subtotal;
                  if(!isNaN(resultado)){
                  caja["resultado"].value=(numero1)+numero2;
                  }
                  if(!isNaN(total)){
                  caja["total"].value=resultado+subtotal;
                  }
                  }
                  </script>

                 
                  <input type="hidden" name="numero" size="2" value="<?php echo $total_alojamiento; ?>" onKeyUp="fncSumar()">
                  
                  <input type="hidden" name="numero1" size="2" value="<?php echo $habitacion->dinero_dejado; ?>" onKeyUp="fncSumar()">

                  <td style="border-right: 1px solid #a09e9e;" colspan="2"><input type="number" id="numero2" name="numero2" size="2" onKeyUp="fncSumar()"></td>

                  <td><input type="text" value="<?php echo $habitacion->dinero_dejado; ?>" style="border-color: red;" readonly="readonly" name="resultado"/></td>
                
                </tr>

                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="4" style="border-right: 1px solid #a09e9e;">Servicio al cuarto</th>
                  <th style="width: 100px"></th>
                </tr>

                 <tr>
                  <th style="width: 10px;border-right: 1px solid #a09e9e;">#</th>
                  <th>Descripción</th>
                  <th>Precio unitario</th>
                  <th style="border-right:1px solid #a09e9e;">Cantidad</th>
                  <th style="border-right:1px solid #a09e9e;">Estado</th>
                  <th style="width: 40px"></th>
                </tr>

                <?php $total=0;?>
                <?php $productos = ProcesoVentaData::getByAll($_GET['id']);
                      if(count($productos)>0){ ?>
                  
                   <?php foreach($productos as $producto):?>

                    <tr>
                      <td style="border-right: 1px solid #a09e9e;">1.</td>

                      <td><?php echo $producto->getProducto()->nombre; ?></td>
                      <td><b>Q <?php echo number_format($producto->precio,2,'.',','); ?></b></td>
                      <td ><?php echo $producto->cantidad; ?></td>
                      <?php if($producto->fecha_creada!=NULL){ ?>
                      <td style="border-right: 1px solid #a09e9e;"><p class="text-green">Pagado</p></td>
                      <?php }else{ ?>
                      <td style="border-right: 1px solid #a09e9e;"><p class="text-red">Falta Pagar</p></td>
                      <?php }; ?>

                      <?php if($producto->fecha_creada!=NULL){ ?>
                      <?php $sub_total=0; ?>
                      <?php }else{ ?>
                      <?php $sub_total=$producto->precio*$producto->cantidad; ?>
                      <?php }; ?>
                      <td><span class="badge"><b>Q  <?php echo number_format($sub_total,2,'.',','); ?></b></span></td>
                    </tr>
                  <?php $total=$sub_total+$total; ?>
                    <?php endforeach; ?>
            

               <?php }else{ 
           

                };
                ?>


                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="4" style="border-right: 1px solid #a09e9e;"><p style="float: right;font-size: 18px;">Total Q </p></th>
                  <input type="hidden" name="subtotal" value="<?php echo $total; ?>" onKeyUp="fncSumar()">
                  <th style="width: 100px;"><b><input type="text" style="border-color: green;" readonly name="total" value="<?php echo ($habitacion->dinero_dejado)+$total; ?>"></b></th>
                </tr>


                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="4" style="border-right: 1px solid #a09e9e;"><p style="float: right;font-size: 14px;">Tipo de pago</p></th>
                 
                  <th style="width: 100px;"><b><select class="form-control" name="id_tipo_pago">
                    <option value="1">Efectivo</option>
                    <option value="2">Depósito / Tarjeta</option>
                  </select></b></th>
                </tr>


               


                
              </table>
            </div>
           
             <div class="box-footer clearfix">
              
                 <a href="index.php?view=pre_salida" class="btn btn-danger"><i class='fa fa-sign-out'></i> Cancelar</a>
              
                  <input type="hidden" name="id_operacion" value="<?php echo $habitacion->id; ?>">
                  <input type="hidden" name="fecha_salida" value="<?php echo $hoy.' '.$hora; ?>">
                  <input type="hidden" name="id_habitacion" value="<?php echo $habitacion->getHabitacion()->id; ?>">
                 
                  <button type="submit" name="boleta" class="btn btn-success pull-right"><i class='fa fa-print'></i> Imprimir Boleta</button>
                  <button type="submit" name="factura" class="btn btn-warning pull-right" style="margin-right: 10px;"><i class='fa fa-print'></i> Imprimir Factura</button>
              
        
            </div>
        </form>
           
          </div>
         </div>

        

  </section>

</div>
<?php }else{
  echo "<h4 class='alert alert-success'>NECESITA SELECCIONAR UNA HABITACIÓN CON HUESPED</h4>";
}; ?>

<?php }; ?>
   


    <!-- Carga los datos ajax -->
  
      <!-- Modal -->
      <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
           
      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">ACEPTAR</span></button>
          <h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
          </div>
           <div class="modal-body">
            
             
          <div id="loader" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado -->
          <div class="outer_div" ></div><!-- Datos ajax Final -->
                    
                   </div>
      
        
        </div>
        </div>
      </div>
            
            


  
    
  
    
  

<script src="plugins/select2/select2.full.min.js"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });
</script>





