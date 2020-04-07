<!DOCTYPE html>
<html style="background-image: url('img/fondo11.jpg');">  

  <head>
    <meta charset="UTF-8">
    <title>Hotel-Mezzanine</title>
     <link rel="shortcut icon" href="../admin/core/app/layouts/logo.ico">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="plugins/dist/css/admin1.min.css" rel="stylesheet" type="text/css" />
 
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/dist/css/skins/estilos.css">
          <script src="plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="plugins/morris/raphael-min.js"></script>
<script src="plugins/morris/morris.js"></script>
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/morris/example.css">
          <script src="plugins/jspdf/jspdf.min.js"></script>
          <script src="plugins/jspdf/jspdf.plugin.autotable.js"></script>
          <?php if(isset($_GET["view"]) && $_GET["view"]=="sell"):?>
<script type="text/javascript" src="plugins/jsqrcode/llqrcode.js"></script>
<script type="text/javascript" src="plugins/jsqrcode/webqr.js"></script>
          <?php endif;?>

  </head>

  <body class="<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>  skin-green  sidebar-mini sidebar-collapse <?php else:?>login-page<?php endif; ?>" >
    <div class="wrapper" style="background-image: url('img/fondo11.jpg');">
      <!-- Main Header -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
      <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          
          <!-- logo for regular state and mobile devices -->
          <img src="../hotel/core/app/layouts/logo.ico" width="25px" height="25px">
          </i></B> <B>MEZZANINE</B></span>

        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class=""><?php if(isset($_SESSION["user_id"]) ){ echo UserData::getById($_SESSION["user_id"])->name; 

                  }?> <b class="caret"></b> </span>

                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer"> 
                    <div class="pull-right">
                      <a href="./logout.php" class="btn btn-primary">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <ul class="sidebar-menu">
            <li class="header"><CENTER> ADMINISTRACION</li>

  
            <?php if(isset($_SESSION["user_id"])):?>
            <li class="<?php if($_GET['view']=='reserva'){echo "active";} ?>"><a href="./index.php?view=reserva"><i class='fa fa-calendar'></i> <span>Reserva</span></a></li>

            <li><a href="./?view=recepcion"><i class='fa fa-sign-in'></i> <span>Recepción</span></a></li>

            <li ><a href="./?view=pre_salida"><i class='fa fa-sign-out'></i> <span>Check out</span></a></li>
            

            <li class="treeview">
              <a href="./?view=pre_venta"><i class="fa fa-arrow-circle-right"></i> <span>Venta de Productos</span> <i class="fa fa-angle-left pull-right"></i></a>
            </li>
             
            <li><a href="./?view=cliente"><i class='fa fa-users'></i> <span>Clientes</span></a></li>

            <li><a href="./?view=pos"><i class='fa fa-users'></i> <span>Depositos</span></a></li>

           
            <li class="treeview">
              <a href="#"><i class='fa fa-file-text-o'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./?view=reporte_deposito">Reporte POS</a></li>
                <li><a href="./?view=reporte_diario">Reporte diario</a></li>
                <li><a href="./?view=reporte_user">Reporte Recepcionista</a></li>
                <li><a href="./?view=reporte_caja">Reporte de caja</a></li>
                <li><a href="./?view=reporte_mensual">Reporte de mensual</a></li>
              </ul>
            </li>


<?php 
$u=null;
$u = UserData::getById(Session::getUID());
?>
<?php if($u->is_admin):?>

            <li class="treeview">
              <a href="./?view=productos"><i class="fa fa-arrow-circle-right"></i> <span>Agregar Peroducto</span> <i class="fa fa-angle-left pull-right"></i></a>
            </li>


            <li class="treeview" class="active">
              <a href="#"><i class='fa fa-cube'></i> <span>Módulo caja</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./?view=apertura_caja">Apertura caja</a></li>
                <li><a href="./?view=cierre_caja">Cierre caja</a></li>
                <li><a href="./?view=reporte_caja">Resumen liquidación</a></li>
              </ul>
            </li>


            <li class="treeview">
              <a href="#"><i class='fa fa-database'></i> <span>Configuración</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./?view=habitacion">Habitaciones</a></li>
                <li><a href="./?view=categoria">Categorías</a></li>
                <li><a href="./?view=nivel">Niveles</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class='fa fa-cog'></i> <span>Administracion</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./?view=users">Usuarios</a></li>
              </ul>
            </li>
<?php endif;?>

			
			          <?php endif;?>

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
    <?php endif;?>

      <!-- Content Wrapper. Contains page content -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
      <div class="content-wrapper">
      <div class="content">
        <?php View::load("index");?>
        </div>
      </div><!-- /.content-wrapper --> 

<?php if($_GET['view']!='imprimir_gasto' and $_GET['view']!='imprimir_boleta' and  $_GET['view']!='imprimir_factura'){ ?>
        <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Hotel-Mezzanine &copy; 2019 <a href="https://www.facebook.com/Quinta-Real-Hotel-1060992517292570/photos/?ref=page_internal " target="_blank">Facebook</a></strong>
      </footer>
<?php } ?>
      <?php else:?>
<div class="login-box">
      <div class="login-logo">
         <a href="./">
          <img src="../admin/core/app/layouts/logo.ico"><br> 

          <H1 style="font-size: 15px;"><B><B>HOTEL-MEZZANINE</B></H1></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="./?action=processlogin" method="post">
         <div class="form-group has-feedback">
             <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-success btn-block btn-flat">Acceder</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->  
      <?php endif;?>


    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
<script src="plugins/datatables/jquery.dataTablesModal.min.js"></script>
    <!-- jQuery 2.1.4 -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="plugins/dist/js/app.min.js" type="text/javascript"></script>

    
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".datatable").DataTable({
          "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
        });
      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
</html>

