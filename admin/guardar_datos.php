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

// Verificar si ya existe un registro con esos valores
$sql_verificacion = "SELECT * FROM canastilla WHERE caja = ? AND tapa = ?";
$stmt_verificacion = $conn->prepare($sql_verificacion);
$stmt_verificacion->bind_param("ii", $caja, $tapa);
$stmt_verificacion->execute();
$stmt_verificacion->store_result();

if ($stmt_verificacion->num_rows > 0) {
    // Si ya existe, redirigir con mensaje de error y detener el script
    header("Location: canastilla?mensaje_error=El registro ya existe");
    exit(); // Detener el script para evitar seguir ejecutando
} else {
    // Preparar la consulta SQL para insertar si no existe
    $sql_insertar = "INSERT INTO canastilla (caja, tapa) VALUES (?, ?)";
    $stmt_insertar = $conn->prepare($sql_insertar);
    $stmt_insertar->bind_param("ii", $caja, $tapa);

    // Ejecutar la consulta
    if ($stmt_insertar->execute()) {
        header("Location: canastilla?mensaje_exito=Datos guardados correctamente");
    } else {
        header("Location: canastilla?mensaje_error=Error al guardar los datos");
    }

    // Cerrar el statement de inserción
    $stmt_insertar->close();
}

// Cerrar el statement de verificación y la conexión
$stmt_verificacion->close();
$conn->close();

?>
