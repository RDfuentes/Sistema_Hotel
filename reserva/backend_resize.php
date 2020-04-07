<?php
include "../core/autoload.php";

$json = file_get_contents('php://input');
$params = json_decode($json);

$base = new Database();
$db = $base->connect1();

$stmt = $db->prepare("UPDATE reservations SET start = :start, end = :end WHERE id = :id");
$stmt->bindParam(':start', $params->newStart);
$stmt->bindParam(':end', $params->newEnd);
$stmt->bindParam(':id', $params->id);
$stmt->execute();

class Result {}
$response = new Result();
$response->result = 'OK';
$response->message = 'Actualizado satisfactoriamente';

header('Content-Type: application/json');
echo json_encode($response);

?>
