
<?php 
     date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
                    
?>
 
<style type="text/css">
  table.dataTable thead .sorting:after {
    opacity: 0.0;
    content: "\e150";
}

table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
    opacity: 0.0;
}
</style>
<div class="row">

 <section class="content-header">
      <h1 >
        <span class="fa fa-file-text-o"></span> REPORTE POS
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Reportes</a></li>
        <li class="active">Reporte POS</li>
      </ol>
</section>
</div>




<style type="text/css">
  
  .hh:hover{
    background-color: white;
  }
  .small-box-footer {
    position: relative;
    text-align: center;
    padding: 0px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
}
.nav-tabs-custom>.nav-tabs>li>a {
    color: #3c8dbc;
    font-weight: bold;
    border-radius: 0 !important;
}
.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #00a65a;
}
.h5, h5 {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>



<br>
<div class="row">

      <div  class="col-md-4">
          <div class="box box-success box-solid">
            
            <!-- /.box-header -->
            <form method="post"  action="index.php?view=agregar_caja" id="addcaja">
              <div class="box-body" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $hoy; ?></h5></td>
                  </tr>
    
                </table>
 
              </div>

             

          </form>

          </div>
          <!-- /.box -->
      </div>

</div>

<section>
<div class="row">

  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" style="background-color: #d2d6de;">
              <li class="active"><a href="#tab_1" data-toggle="tab">Tabla Depositos</a></li>
              <li class="pull-right text-red"><a  onclick="tableToExcel('example1', 'W3C Example Table')" target="_blank" class="text-muted"><i class="fa fa-print"></i> IMPRIMIR</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <?php $reportediarios = PosData::getReporte($hoy);
                if(count($reportediarios)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover" summary="Code page support in different versions of MS Windows." rules="groups" frame="hsides" border="2"><caption>REPORTE DE DEPOSITOS</caption>


                  <thead style="color: black; background-color: #d2d6de;">
                        <th>Nº</th> 
                        <th>FECHA</th>
                        <th>NOCHES</th>
                        <th>PAGO EFECTIVO</th>
                        <th>NUMERO DE BOLETA</th>
                        <th>PAGO POS</th>
                        <th>AUTORIZACION</th>
                        <th>NO. FACTURA</th> 
                  </thead> 

                   <?php foreach($reportediarios as $reportediario):?>

                      <tr>
                        <td><?php echo $reportediario->id; ?></td>
                        <td><?php echo $reportediario->fecha; ?></td>
                        <td><?php echo $reportediario->noches; ?></td>
                        <td><?php echo $reportediario->pago_efectivo; ?></td>
                        <td><?php echo $reportediario->numero_boleta; ?></td>
                        <td><?php echo $reportediario->pago_pos; ?></td>
                        <td><?php echo $reportediario->autorizacion; ?></td>
                        <td><?php echo $reportediario->numero_factura; ?></td>
                      </tr> 

                    <?php endforeach; ?>

                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    </div>
</div>

</section>





     
      
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

