 
<style type="text/css">
  
  .hh:hover{
    background-color: white;
  }
  .small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
}
.nav-tabs-custom>.nav-tabs>li>a {
    color: white;
    border-radius: 0 !important;
}
.bg-orange {
    background-color: #343a40 !important;
}


.bg-green:hover{
  background-color: #c2c436 !important;
}
.bg-aqua:hover{
  background-color: #ffbe0f !important;
}
.bg-red:hover{
  background-color: #da685a !important;
}
.nav-tabs-custom>.nav-tabs>li>a:hover{
  background-color: white;

}

</style>
<div class="row">

 <section class="content-header">
      <h1 >
        VISTA GENERAL RECEPCIÓN 
 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a class="active">recepción</a></li>
        
      </ol>
</section>
</div> 

<hr>
<section>
<div class="row">

  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom bg-orange text-white">
            <ul class="nav nav-tabs pull-right">


            <?php $niveles = NivelData::getAll();?>

              <?php foreach($niveles as $nivel):?>
                <li <?php if($nivel->id==1){ ?> class="active" <?php }; ?>><a href="#tab_1-<?php echo $nivel->id; ?>" data-toggle="tab"><?php echo $nivel->nombre; ?></a></li>
              <?php endforeach;?>

              
              <li class="pull-left header" style="color: white;"><i class="fa fa-hotel" style="color: white;"></i> CHEK IN</li>
            </ul>
            <div class="tab-content">
            


            <?php foreach($niveles as $nivel):?>
                <div <?php if($nivel->id==1){ ?> class="tab-pane active" <?php }else{ ?> class="tab-pane" <?php }; ?>  id="<?php echo "tab_1-".$nivel->id; ?>">
           

            <div class="row">
                      
                           
            <?php $habitaciones = HabitacionData::getAllNivel($nivel->id);

                          if(count($habitaciones)>0){
                            // si hay usuarios
                            ?>
            
                 
                   <?php foreach($habitaciones as $habitacion):?>

                    <div class="col-lg-3 col-xs-6">
                      <div class="hh">
                      <!-- small box -->
                      <?php if($habitacion->estado==1){?>
                      
                      <div class="small-box bg-green">
                        
                      <?php } else if($habitacion->estado==2){?>
                      <div class="small-box bg-red">
                      <?php } else if($habitacion->estado==3){?>
                      <div class="small-box bg-aqua">
                      <?php  }; ?>

                        
                        <div class="inner">
                          <h3><?php echo $habitacion->nombre; ?></h3>

                          <p><?php echo $habitacion->getCategoria()->nombre; ?></p>
                        </div>
                        <div class="icon">
                            <?php if($habitacion->estado==1){?>
                            <i class="fa fa-imagen" style="color:#e3e3e3;"></i>
                            <?php } else if($habitacion->estado==2){?>
                            <i class="fa fa-ocupado1" style="color:#e3e3e3;"></i>
                            <?php } else if($habitacion->estado==3){?>
                            <i class="fa fa-limpieza1" style="color:#e3e3e3;"></i>
                            <?php  }; ?>
                          
                        </div> 

                        <?php if($habitacion->estado==1){?>
                      
                          <a  href="index.php?view=proceso&id_habitacion=<?php echo $habitacion->id; ?>" class="small-box-footer">Disponible <i class="fa fa-arrow-circle-right"></i></a> 
                    
                      <?php } else if($habitacion->estado==2){?>
                      <a href="#" data-toggle="modal" data-target="#myModal1<?php echo $habitacion->id.''.$nivel->id; ?>"  class="small-box-footer">Ocupado <i class="fa fa-warning"></i></a>
                      <?php } else if($habitacion->estado==3){?>
                      <a href="#"  data-toggle="modal" data-target="#myModal<?php echo $habitacion->id.''.$nivel->id; ?>" class="small-box-footer">Limpieza <i class="fa fa-spinner"></i></a>
                      <?php  }; ?>

                        
                      </div>
                    </div>
                  </div>
                 

 <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $habitacion->id.''.$nivel->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> ESTÁ A PUNTO DE TERMINAR LA LIMPIEZA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> HABITACIÓN </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> TIPO </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->getCategoria()->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> DETALLES </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->descripcion; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a href="index.php?view=limpieza&id=<?php echo $habitacion->id; ?>" class="btn btn-outline">Finalizar limpieza</a>
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>


  <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $habitacion->id.''.$nivel->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> ESTÁ A PUNTO DE TERMINAR LA LIMPIEZA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> HABITACIÓN </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> TIPO </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->getCategoria()->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> DETALLES </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->descripcion; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a href="index.php?view=limpieza&id=<?php echo $habitacion->id; ?>" class="btn btn-outline">Finalizar limpieza</a>
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>


 
      <div class="modal fade bs-example-modal-xm" id="myModal1<?php echo $habitacion->id.''.$nivel->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">

    
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-warning"></span> HABITACIÓN OCUPADA</h4>
                <br>
                <h4 class="moda">HUESPED: </h4> 
              </div>

                              
    
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <a href="index.php?view=pre_salida" class="btn btn-outline">Ir a check out</a>
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>





                    <?php endforeach; ?>
            

               <?php }else{ 
            echo"<h4 class='alert alert-success'>Necesita agregar habitaciones en CONFIGURACIÓN</h4>";

                };
                ?>


          

          </div>
              </div>

           <?php endforeach;?>



              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>


</section>

