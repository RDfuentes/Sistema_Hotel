<?php
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$stmt = $db->prepare("UPDATE habitacion SET nombre = :nombre, capacidad = :capacidad, estado = :estado WHERE id = :id");
$stmt->bindParam(':id', $params->id);
$stmt->bindParam(':nombre', $params->name);
$stmt->bindParam(':capacidad', $params->capacity);
$stmt->bindParam(':estado', $params->status);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);

?>
