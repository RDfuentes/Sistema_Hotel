<?php


$habitacion = HabitacionData::getById($_GET["id"]);
$habitacion->del();

Core::redir("./index.php?view=habitacion");
?>