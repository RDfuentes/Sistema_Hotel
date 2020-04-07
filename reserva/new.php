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
            is_numeric($_GET['resource']) or die("invalid URL");
            

            $base = new Database();
            $db = $base->connect1(); 
            
            $rooms = $db->query('SELECT * FROM habitacion');
            
            $resource = $_GET['resource'];
            $start = (new DateTime($_GET['start']))->format("Y-m-d\\TH:i:s");
            $end = (new DateTime($_GET['end']))->format("Y-m-d\\TH:i:s");
        ?>



      


        
        <div ng-app="main" ng-controller="NewReservationController" style="padding:0px">
            
            
              <div class="modal-dialog modal-info" style="margin: 0px;">
          <div class="modal-dialog" style="margin: 0px;" >
            <div class="modal-content">
                
              <div class="modal-header">
                
                <h4 class="modal-title"><span class="fa fa-spinner"></span> NUEVA RESERVA DE HABITACIÓN</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> DOCUMENTO </span>
                      <input type="text" class="form-control col-md-8" id="documento" name="documento" ng-model="reservation.documento" placeholder="Ingrese Documento">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> NOMBRE Y A. </span>
                      <input type="text" class="form-control col-md-8" id="name" name="name" ng-model="reservation.name" placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> FECHA INICIO </span>
                      <input type="text" class="form-control col-md-8" id="start" name="start" ng-model="reservation.start" date-format="d/M/yyyy">
                      <span ng-show="!reservation.start">Fecha inválida</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> FECHA FINAL </span>
                      <input type="text" class="form-control col-md-8" id="end" name="end" ng-model="reservation.end" date-format="d/M/yyyy">
                      <span ng-show="!reservation.end">Fecha inválida</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> HABITACIÓN </span>
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

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <a href="" id="cancel" ng-click="cancel()" class="btn btn-outline pull-left">Cancelar</a>
                
                <input type="submit" value="Finalizar reserva" ng-click="save()" class="btn btn-outline" />
               
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

            
        </div>
        
        <script type="text/javascript">
            
        var app = angular.module('main', ['daypilot']).controller('NewReservationController', function($scope, $timeout, $http) {
            $scope.reservation = {
                name: '',
                start: '<?php print $start ?>',  // use ISO format for the model
                end: '<?php print $end ?>',      // use ISO format for the model
                room: <?php print $resource ?>
            };
            $scope.delete = function() {
                $http.post("backend_delete.php", $scope.reservation).success(function(data) {
                    DayPilot.Modal.close(data);
                });   
            };
            $scope.save = function() {
                $http.post("backend_create.php", $scope.reservation).success(function(data) {
                    DayPilot.Modal.close(data);
                });
            };
            $scope.cancel = function() {
                DayPilot.Modal.close();
            };
            
            $("#documento").focus();
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
