
  
        <meta charset="UTF-8" />
       

        <style type="text/css">
            .icon {
                font-size: 14px;
                text-align: center;
                line-height: 14px;
                vertical-align: middle;

                cursor: pointer;
            }
            .scheduler_default_rowheader
            {
                background: -webkit-gradient(linear, left top, left bottom, from(#eeeeee), to(#dddddd));
                background: -moz-linear-gradient(top, #eeeeee 0%, #dddddd);
                background: -ms-linear-gradient(top, #eeeeee 0%, #dddddd);
                background: -webkit-linear-gradient(top, #eeeeee 0%, #dddddd);
                background: linear-gradient(top, #eeeeee 0%, #dddddd);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorStr="#eeeeee", endColorStr="#dddddd");

            }
            .scheduler_default_rowheader_inner
            {
                border-right: 1px solid #ccc;
            }
            .scheduler_default_rowheadercol2
            {
                background: #ffffff;
            }
            .scheduler_default_corner{
                width: 0px !important;
            } 
            .scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
            {
                top: 2px;
                bottom: 2px;
                left: 2px;
                background-color: transparent;
                border-left: 5px solid #1a9d13; /* status: "free" (default), green color */
                border-right: 0px none;
            }
            .status_dirty.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
            {
                border-left: 5px solid #ea3624; /* status: "dirty", red color */
            }
            .status_cleanup.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
            {
                    border-left: 5px solid #f9ba25; /* status: "cleanup", orange color */
            }

        </style>

    </head>
    <body>
        <script src="reserva/js/jquery-1.11.2.min.js"></script>
        <script src="reserva/js/angular.min.js"></script>
        <script src="reserva/js/daypilot/daypilot-all.min.js"></script>

       
 
        <div class="main">

            <?php require_once 'reserva/_navigation.php'; ?>

            <div ng-app="main" ng-controller="DemoCtrl" >

                <div style="float:left; width:160px">
                    <daypilot-navigator id="navigator" daypilot-config="navigatorConfig"></daypilot-navigator>
                </div>
                <div style="margin-left: 160px">


                    <div class="space options">
                        
                        <div class="col-md-4">

                        <select ng-model="roomType" class="form-control" style="margin-left: -15px;"> 
                         <option value="0">Todos</option>  
                        <?php $categorias = CategoriaData::getAll();?>
                        <?php foreach($categorias as $categoria):?>
                          <option value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></option>
                        <?php endforeach;?>
                      </select>  

                         
                        </div>
                        
                        <br><br>
                    </div>

                    <daypilot-scheduler id="scheduler" daypilot-config="schedulerConfig" daypilot-events="events" ></daypilot-scheduler>

                    

                </div>

            </div>

            <script>
                var dp;

                var app = angular.module('main', ['daypilot']).controller('DemoCtrl', function($scope, $timeout, $http) {

                    $scope.roomType = 0;

                    $scope.$watch("roomType", function() {
                        loadResources();
                    });

                    $scope.navigatorConfig = {
                        selectMode: "month",
                        showMonths: 3,
                        skipMonths: 3, 
                        onTimeRangeSelected: function(args) {
                            if ($scope.scheduler.visibleStart().getDatePart() <= args.day && args.day < $scope.scheduler.visibleEnd()) {
                                $scope.scheduler.scrollTo(args.day, "fast");  // just scroll
                            }
                            else {
                                loadEvents(args.day);  // reload and scroll
                            }
                        }
                    };

                    $scope.schedulerConfig = {
                        visible: false, // will be displayed after loading the resources
                        scale: "Manual",
                        timeline: getTimeline(),
                        timeHeaders: [ { groupBy: "Month", format: "MMMM yyyy" }, { groupBy: "Day", format: "d" } ],
                        eventDeleteHandling: "Update",
                        allowEventOverlap: false,
                        cellWidthSpec: "Auto",
                        eventHeight: 50,
                        rowHeaderColumns: [
                            {title: "Habitación", width: 80},
                            {title: " ", width: 1},
                            {title: "Estado", width: 80}
                        ],
                        onBeforeResHeaderRender: function(args) {
                           
                            args.resource.columns[1].html = args.resource.status;
                            switch (args.resource.status) {
                                case "En limpieza":
                                    args.resource.cssClass = "status_dirty";
                                    break;
                                case "En limpieza":
                                    args.resource.cssClass = "status_cleanup";
                                    break;
                            }
                            args.resource.areas = [{
                                top:3,
                                right:4, 
                                height:14,
                                width:14,
                                action:"JavaScript",
                                js: function(r) {
                                    var modal = new DayPilot.Modal();
                                    modal.onClosed = function(args) {
                                        loadResources();
                                    };
                                    modal.showUrl("reserva/room_edit.php?id=" + r.id);
                                },
                                v:"Hover",
                                css:"icon icon-edit",
                            }];
                        },
                        onEventMoved: function (args) {
                            $http.post("reserva/backend_move.php", {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString(),
                                newResource: args.newResource
                            }).then(function(response) {
                                dp.message(response.data.message);
                            });
                        },
                        onEventResized: function (args) {
                            $http.post("reserva/backend_resize.php", {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            }).then(function() {
                                dp.message("Actualizado.");
                            });
                        },
                        onEventDeleted: function(args) {
                            $http.post("reserva/backend_delete.php", {
                                id: args.e.id()
                            }).then(function() {
                                dp.message("Eliminado.");
                            });
                        },
                        onTimeRangeSelected: function (args) {
                            var modal = new DayPilot.Modal();
                            modal.closed = function() {
                                dp.clearSelection();

                                // reload all events
                                var data = this.result;
                                if (data && data.result === "OK") {
                                    loadEvents();
                                }
                            }; 
                            modal.showUrl("reserva/new.php?start=" + args.start + "&end=" + args.end + "&resource=" + args.resource);
                        },
                        onEventClick: function(args) {
                            var modal = new DayPilot.Modal();
                            modal.closed = function() {
                                // reload all events
                                var data = this.result;
                                if (data && data.result === "OK") {
                                    loadEvents();
                                }
                            };
                            modal.showUrl("reserva/edit.php?id=" + args.e.id());
                        },
                        onBeforeEventRender: function(args) {
                            var start = new DayPilot.Date(args.data.start);
                            var end = new DayPilot.Date(args.data.end);

                            var now = new DayPilot.Date();
                            var today = new DayPilot.Date().getDatePart();
                            var status = "";

                            // customize the reservation bar color and tooltip depending on status
                            switch (args.e.status) {
                                case "Nuevo":
                                    var in2days = today.addDays(1);

                                    if (start < in2days) {
                                        args.data.barColor = 'red';
                                        status = 'Expirado (No confirmó a tiempo)';
                                    }
                                    else {
                                        args.data.barColor = 'orange';
                                        status = 'Nuevo';
                                    }
                                    break;
                                case "Confirmado":
                                    var arrivalDeadline = today.addHours(18);

                                    if (start < today || (start === today && now > arrivalDeadline)) { // must arrive before 6 pm
                                        args.data.barColor = "#f41616";  // red
                                        status = 'Confirmado';
                                    }
                                    else {
                                        args.data.barColor = "green";
                                        status = "Confirmado";
                                    }
                                    break;
                                case 'Entrada': // arrived
                                    var checkoutDeadline = today.addHours(10);

                                    if (end < today || (end === today && now > checkoutDeadline)) { // must checkout before 10 am
                                        args.data.barColor = "#f41616";  // red
                                        status = "Se paso de tiempo";
                                    }
                                    else
                                    {
                                        args.data.barColor = "#1691f4";  // blue
                                        status = "Entrada";
                                    }
                                    break;
                                case 'CheckedOut': // checked out
                                    args.data.barColor = "gray";
                                    status = "Checked out";
                                    break;
                                default:
                                    status = "";
                                    break;
                            }

                            // customize the reservation HTML: text, start and end dates
                            args.data.html = args.data.text + " (" + start.toString("M/d/yyyy") + " - " + end.toString("M/d/yyyy") + ")" + "<br /><span style='color:gray'>" + status + "</span>";

                            // reservation tooltip that appears on hover - displays the status text
                            args.e.toolTip = status;

                            // add a bar highlighting how much has been paid already (using an "active area")
                            var paid = args.e.paid;
                            var paidColor = "#aaaaaa";
                            args.data.areas = [
                                { bottom: 10, right: 4, html: "<div style='color:" + paidColor + "; font-size: 8pt;'>Pagado: " + paid + "%</div>", v: "Visible"},
                                { left: 4, bottom: 8, right: 4, height: 2, html: "<div style='background-color:" + paidColor + "; height: 100%; width:" + paid + "%'></div>" }
                            ];

                        }
                    };

                    $scope.addRoom = function() {
                        var modal = new DayPilot.Modal();
                        modal.onClosed = function(args) {
                            loadResources();
                        };
                        modal.showUrl("reserva/room_new.php");
                    };

                    $timeout(function() {
                        dp = $scope.scheduler;  // debug
                        loadEvents(DayPilot.Date.today());
                    });

                    // loads events; switches the Scheduler visible range if "day" supplied
                    function loadEvents(day) {
                        var from = $scope.scheduler.visibleStart();
                        var to = $scope.scheduler.visibleEnd();
                        if (day) {
                            from = new DayPilot.Date(day).firstDayOfMonth();
                            to = from.addMonths(1);
                        }

                        var params = {
                            start: from.toString(),
                            end: to.toString()
                        };

                        $http.post("reserva/backend_events.php", params).then(function(response) {
                            if (day) {
                                $scope.schedulerConfig.timeline = getTimeline(day);
                                $scope.schedulerConfig.scrollTo = day;
                                $scope.schedulerConfig.scrollToAnimated = "fast";
                                $scope.schedulerConfig.scrollToPosition = "left";
                            }
                            $scope.events = response.data;
                        });
                    }

                    function loadResources() {
                        var params = {
                            capacity: $scope.roomType
                        };
                        $http.post("reserva/backend_rooms.php", params).then(function(response) {
                            $scope.schedulerConfig.resources = response.data;
                            $scope.schedulerConfig.visible = true;
                        });
                    }

                    function getTimeline(date) {
                        var date = date || DayPilot.Date.today();
                        var start = new DayPilot.Date(date).firstDayOfMonth();
                        var days = start.daysInMonth();

                        var timeline = [];

                        var checkin = 12;
                        var checkout = 12;

                        for (var i = 0; i < days; i++) {
                            var day = start.addDays(i);
                            timeline.push({start: day.addHours(checkin), end: day.addDays(1).addHours(checkout) });
                        }

                        return timeline;
                    }


                });

            </script>

        </div>
        <div class="clear">
        </div>
    </body>
</html>
