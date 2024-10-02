<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ajustar la zona horaria a GMT-6
date_default_timezone_set('America/Mexico_City');

// Obtener las fechas únicas en el historial_deudas
$query = "SELECT DISTINCT DATE(fecha) as fecha_unica FROM historial_deudas ORDER BY fecha_unica DESC";
$resultado = $conn->query($query);

// Crear las opciones del selector sin duplicar fechas
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<option value='" . $fila['fecha_unica'] . "'>" . $fila['fecha_unica'] . "</option>";
    }
} else {
    echo "<option>No hay fechas registradas</option>";
}

$conn->close();
?>
