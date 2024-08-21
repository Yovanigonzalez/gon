<?php
include '../config/conexion.php';

$id_cliente = $_GET['id_cliente'];

$query = "SELECT cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE id_cliente = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode([
        'cantidad_cajas' => '0',
        'cantidad_tapas' => '0'
    ]);
}

$stmt->close();
$conn->close();
?>
