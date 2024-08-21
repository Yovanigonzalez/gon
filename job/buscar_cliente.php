<?php
include '../config/conexion.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT id, nombre, direccion FROM clientes WHERE nombre LIKE ? OR direccion LIKE ?");
    $searchTerm = "%{$query}%";
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
    echo json_encode($clientes);
}
?>
