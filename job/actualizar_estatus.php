<?php
include '../config/conexion.php';

if (isset($_POST['nota_id'])) {
    $nota_id = $_POST['nota_id'];

    // Actualizar estatus en la tabla 'notas'
    $sql = "UPDATE notas SET estatus = 'entregado' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->bind_param("i", $nota_id) && $stmt->execute()) {
        // Actualizar estatus en la tabla 'productos_nota'
        $sql = "UPDATE productos_nota SET estatus = 'entregado' WHERE nota_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt->bind_param("i", $nota_id) && $stmt->execute()) {
            // Redirigir con un mensaje de éxito
            header('Location: notas.php?mensaje_exito=Nota marcada como entregada');
            exit();
        } else {
            // Redirigir con un mensaje de error
            header('Location: notas.php?mensaje_error=Error al marcar la nota como entregada');
            exit();
        }
    } else {
        // Redirigir con un mensaje de error
        header('Location: notas.php?mensaje_error=Error al actualizar notas');
        exit();
    }
} else {
    header('Location: notas.php?mensaje_error=ID de nota no proporcionado');
    exit();
}

$conn->close();
?>
