<?php
// Establecer la conexión con la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el ID del pedido y la acción
if (isset($_POST['atendido']) && isset($_POST['pedido_id'])) {
    $pedido_id = intval($_POST['pedido_id']);

    // Actualizar el estatus del pedido
    $sql = "UPDATE pedidos SET estatus = 'ATENDIDO' WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    
    if ($stmt->execute()) {
        // Redirigir con mensaje de éxito
        header("Location: detalles_pedidos?mensaje_exito=Pedido actualizado a Atendido");
    } else {
        // Redirigir con mensaje de error
        header("Location: detalles_pedidos?mensaje_error=Error al actualizar el pedido");
    }

    $stmt->close();
} else {
    // Redirigir con mensaje de error si no se proporciona el ID
    header("Location: detalles_pedidos?mensaje_error=No se proporcionó el ID del pedido");
}

// Cerrar conexión
$conn->close();
?>
