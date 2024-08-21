<?php
include '../config/conexion.php';

if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    // Consultar la tabla deudores
    $stmt = $conn->prepare("SELECT cantidad_deuda FROM deudores WHERE id_cliente = ?");
    $stmt->bind_param('i', $id_cliente);
    $stmt->execute();
    $stmt->bind_result($cantidad_deuda);
    
    if ($stmt->fetch()) {
        echo json_encode(['cantidad_deuda' => $cantidad_deuda]);
    } else {
        echo json_encode(['cantidad_deuda' => 'No hay deuda pendiente']);
    }
    
    $stmt->close();
}
?>
