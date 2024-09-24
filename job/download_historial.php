<?php
// Incluir el archivo de conexión
include '../config/conexion.php';

// Establecer el nombre del archivo a descargar
$filename = "historial_cajas_entregadas_" . date("Y-m-d") . ".csv";

// Definir el encabezado para la descarga del archivo CSV
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Abrir el archivo CSV para la escritura
$output = fopen("php://output", "w");

// Escribir el encabezado de las columnas
fputcsv($output, array('Fecha', 'Caja', 'Tapa'));

// Consultar el historial de cajas entregadas
$sql_historial = "SELECT fecha, caja, tapa FROM historial_cajas_entregadas";
$resultado = $conn->query($sql_historial);

// Escribir los datos en el archivo CSV
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        fputcsv($output, $fila);
    }
}

// Cerrar el archivo CSV
fclose($output);
$conn->close();
exit;
?>
