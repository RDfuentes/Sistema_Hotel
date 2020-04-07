<?php
include "../core/autoload.php";

$json = file_get_contents('php://input');
$params = json_decode($json);

$base = new Database();
$db = $base->connect1();

$stmt = $db->prepare("SELECT * FROM habitacion WHERE capacidad = :capacidad OR :capacidad = '0' ORDER BY nombre");
$stmt->bindParam(':capacidad', $params->capacity); 
$stmt->execute();
$rooms = $stmt->fetchAll();

class Room {}

$result = array();

foreach($rooms as $room) {
  $r = new Room();
  $r->id = $room['id'];
  $r->name = $room['nombre'];
  $r->capacity = $room['capacidad'];

  $estado="Limpio";
  if($room['estado']==1){$estado="Limpio"; }elseif ($room['estado']==2) {
  	$estado="En limpieza";
  }elseif ($room['estado']==3) {
  	$estado="En limpieza";
  }
  $r->status = $estado;
  $result[] = $r;
  
}

header('Content-Type: application/json');
echo json_encode($result);

?>
