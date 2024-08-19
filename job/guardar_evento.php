<?php
// Configuración de la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO eventos (fecha, descripcion) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $fecha, $descripcion);
    
    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: eventos?mensaje_exito=Agendado exitosamente");
    } else {
        // Redirigir con un mensaje de error
        header("Location: eventos?mensaje_error=Error al agendar");
    }
    $stmt->close();
} else {
    // Redirigir con un mensaje de error si la preparación de la consulta falla
    header("Location: eventos?mensaje_error=Error al preparar la consulta");
}

// Cerrar la conexión
$conn->close();
?>
