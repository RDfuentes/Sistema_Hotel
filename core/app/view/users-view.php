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
        <span class="fa fa-user"></span> REGISTRO DE USUARIOS
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Administración</a></li>
        <li class="active">Usuarios</li>
      </ol>
</section>
</div>

<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              <h3 class="box-title">
                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"> <span class="fa fa-user"></span> REGISTRAR NUEVO USUARIO</a>
              </h3>
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">


              <?php $users = UserData::getAll();
					if(count($users)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover">

                  <thead style="color: white; background-color: #dd4b39;">
                        <th>Nº</th> 
                        <th>Nombre completo</th>
						<th>Nombre de usuario</th>
						<th>Email</th>
						<th>Activo</th>
						<th>Admin</th>
						<th></th>
                  </thead>
                   <?php foreach($users as $user):?>
                      <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->name." ".$user->lastname; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><b><?php echo $user->email; ?></b></td>
                        <td>
		                    <?php if($user->is_active):?>
								<i class="glyphicon glyphicon-ok"></i>
							<?php endif; ?>
						</td>
						<td>
							<?php if($user->is_admin):?>
								<i class="glyphicon glyphicon-ok"></i>
							<?php endif; ?>
						</td>
                        <td>
                        <a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Editar</a>
                        </td>
                      </tr> 
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
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=adduser" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-user"></span> INGRESAR NUEVO USUARIO</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombre </span>
                      <input type="text" class="form-control col-md-8" onkeypress="return validar(event)" name="name" required placeholder="Ingrese nombre" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Apellido </span>
                      <input type="text" class="form-control col-md-8" name="lastname" required placeholder="Ingrese Apellido" onkeypress="return validar(event)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Alias Usuario </span>
                      <input type="text" class="form-control col-md-8" name="username" required placeholder="Ingrese Nombre de usuario">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Correo </span>
                      <input type="text" class="form-control col-md-8" name="email" required placeholder="Ingrese Nombre de Usuario con el que Iniciara Sesion">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Contrase&ntilde;a </span>
                      <input type="password" class="form-control col-md-8" name="password" required placeholder="Ingrese Contraseña para Ingresar">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Es Admin </span>
                      <input type="checkbox"  name="is_admin"  >
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
          </div>
        </div>
      </div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
   
  });
</script>


