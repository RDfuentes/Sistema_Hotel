<?php


$habitacion = PosData::getById($_GET["id"]);
$habitacion->del();

Core::redir("./index.php?view=pos");
?>