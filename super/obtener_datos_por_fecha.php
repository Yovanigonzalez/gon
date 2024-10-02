<?php
// Establecer conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "distribuidora";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ajustar la zona horaria a GMT-6
date_default_timezone_set('America/Mexico_City');

$fechaSeleccionada = $_POST['fecha'];

// Obtener los datos filtrados por la fecha seleccionada
$query = "SELECT nombre_cliente, direccion, deuda_restante FROM historial_deudas WHERE DATE(fecha) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $fechaSeleccionada);
$stmt->execute();
$resultado = $stmt->get_result();

// Generar las filas de la tabla
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . $fila['nombre_cliente'] . "</td>
                <td>" . $fila['direccion'] . "</td>
                <td>" . number_format($fila['deuda_restante'], 2) . " MXN</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No se encontraron resultados para esta fecha</td></tr>";
}

$conn->close();
?>
