<?php
include '../config/conexion.php';

$query = $_GET['query'];
$sql = "SELECT id, nombre, direccion FROM clientes WHERE nombre LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$clientes = array();
while ($row = $result->fetch_assoc()) {
  $clientes[] = $row;
}

echo json_encode($clientes);
?>
