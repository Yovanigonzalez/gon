<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

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
$totalDeuda = 0; // Inicializar la variable para la suma
$output = ''; // Inicializar la variable para el HTML de la tabla

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $output .= "<tr>
                      <td>" . $fila['nombre_cliente'] . "</td>
                      <td>" . $fila['direccion'] . "</td>
                      <td>" . number_format($fila['deuda_restante'], 2) . " MXN</td>
                    </tr>";
        $totalDeuda += $fila['deuda_restante']; // Sumar la deuda restante
    }
} else {
    $output .= "<tr><td colspan='3'>No se encontraron resultados para esta fecha</td></tr>";
}

// Mostrar la tabla y la suma total
echo $output;
echo "<tr>
        <td colspan='2'><strong>Total:</strong></td>
        <td><strong>" . number_format($totalDeuda, 2) . " MXN</strong></td>
      </tr>";

$conn->close();
?>
