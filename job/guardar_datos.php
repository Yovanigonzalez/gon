<?php
// Datos de la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$caja = $_POST['caja'];
$tapa = $_POST['tapa'];

// Preparar la consulta SQL
$sql = "INSERT INTO canastilla (caja, tapa) VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $caja, $tapa);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: canastilla_patsa?mensaje_exito=Datos guardados correctamente");
} else {
    header("Location: canastilla_patsa?mensaje_error=Error al guardar los datos");
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
