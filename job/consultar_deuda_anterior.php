<?php
include '../config/conexion.php'; // Asegúrate de que tienes conexión a la base de datos

$id_cliente = $_GET['id_cliente'];

$sql = "SELECT cantidad_deuda FROM deudores WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $deuda = $result->fetch_assoc();
    echo json_encode($deuda);
} else {
    echo json_encode(['cantidad_deuda' => 0]); // Si no hay deuda, retorna 0
}

$stmt->close();
$conn->close();
?>
