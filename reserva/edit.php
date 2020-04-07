<?php 
include "../core/autoload.php";
include "../core/app/model/ProductoData.php";
?>

        <link type="text/css" rel="stylesheet" href="media/layout.css" />    
        <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="js/angular.min.js" type="text/javascript"></script>
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>

        <link href="../plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../plugins/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css" />


  <link rel="stylesheet" href="../plugins/dist/css/skins/_all-skins.css">


<?php
            // check the input
            is_numeric($_GET['id']) or die("invalid URL");
            
            $base = new Database();
            $db = $base->connect1();
            
            $stmt = $db->prepare('SELECT * FROM reservations WHERE id = :id');
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            $reservation = $stmt->fetch();
            
            $rooms = $db->query('SELECT * FROM habitacion');
        ?>



        
        <div  ng-app="main" ng-controller="EditReservationController" style="padding:0px">
            
            
              <div class="modal-dialog modal-warning" style="margin: 0px;">
          <div class="modal-dialog" style="margin: 0px;" >
            <div class="modal-content">
                
              <div class="modal-header" style="height: 60px;">
                
                <h4 class="pull-left"><span class="fa fa-spinner"></span> EDITAR RESERVA</h4>
                <a href="" ng-click="registro()"  class="btn btn-outline pull-right">Registrar ingreso</a>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha inicio </span>
                      <input type="text" class="form-control col-md-8" id="start" name="start" ng-model="reservation.start" date-format="d/M/yyyy" placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha final </span>
                      <input type="text" class="form-control col-md-8" id="end" name="end" ng-model="reservation.end" date-format="d/M/yyyy">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Habitación </span>
                       <select id="room" name="room" ng-model="reservation.room" class="form-control">
                            <?php 
                                foreach ($rooms as $room) {
                                    $id = $room['id'];
                                    $name = $room['nombre'];
                                    print "<option value='$id'>$name</option>";
                                }
                            ?>
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombre y A. </span>
                      <input type="text" class="form-control col-md-8" id="name" name="name" ng-model="reservation.name" placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Estado </span>
                        <select id="status" name="status" ng-model="reservation.status" class="form-control">
                            <?php 
                                $options = array("Nuevo", "Confirmado", "Entrada", "Salió");
                                foreach ($options as $option) {
                                    $id = $option;
                                    $name = $option;
                                    print "<option value='$id'>$name</option>";
                                }
                            ?>
                         </select>  
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Pagado </span>
                         <select id="paid" name="paid" ng-model="reservation.paid" class="form-control">
                            <?php 
                                $options = array(0, 50, 100);
                                foreach ($options as $option) {
                                    $id = $option;
                                    $name = $option."%";
                                    print "<option value='$id'>$name</option>";
                                }
                            ?>
                        </select>
                    </div>
                  </div>



          

                  

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <a href="" id="cancel" ng-click="cancel()" class="btn btn-outline pull-left">Cancelar</a>
                
                <input type="submit" value="Actualizar reserva" ng-click="save()" class="btn btn-outline" />
               
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

            
        </div>
        
       <script type="text/javascript">
        var app = angular.module('main', ['daypilot']).controller('EditReservationController', function($scope, $timeout, $http) {
            $scope.reservation = {
                id: <?php print $reservation['id'] ?>,
                name: '<?php print $reservation['name'] ?>',
                start: '<?php print $reservation['start'] ?>',  // use ISO format for the model
                end: '<?php print $reservation['end'] ?>',      // use ISO format for the model
                room: <?php print $reservation['room_id'] ?>,
                status: '<?php print $reservation['status'] ?>',
                paid: <?php print $reservation['paid'] ?>
            };
            $scope.save = function() {
                $http.post("backend_update.php", $scope.reservation).success(function(data) {
                    DayPilot.Modal.close(data);
                });
            };
            $scope.registro = function() {
           
                    DayPilot.Modal.close(data);
               $http.post("../core/app/index.php?view=recepcion")
            };
            $scope.cancel = function() {
                DayPilot.Modal.close();
            };
            
            $("#name").focus();
        });
        
        
        app.directive('dateFormat', function() {
            return { restrict: 'A',
              require: 'ngModel',
              link: function(scope, element, attrs, ngModel) {
                if(ngModel) {
                    // parse the input value using the format string, pass the normalized ISO8601 value to the model
                    // unparseable value returns null
                    ngModel.$parsers.push(function (value) {
                        var d = DayPilot.Date.parse(value, attrs.dateFormat); 
                        return d && d.toString();
                    });
                    // display the date in the specified format
                    // null value will be returned as null
                    ngModel.$formatters.push(function (value) {
                        return value && new DayPilot.Date(value).toString(attrs.dateFormat);
                    });
                }
              }
            };
        });
    
        </script>





