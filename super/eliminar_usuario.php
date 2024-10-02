<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario a eliminar
if (isset($_POST['usuario_id'])) {
    $usuario_id = $_POST['usuario_id'];

    // Preparar y ejecutar la consulta para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);

    if ($stmt->execute()) {
        header("Location: usuarios?mensaje_exito_eliminar=Usuario eliminado con éxito.");    
    } else {
        header("Location: usuarios?mensaje_error_eliminar=Error al eliminar el usuario. Inténtalo de nuevo.");    }
    $stmt->close();
}

$conn->close();
?>
