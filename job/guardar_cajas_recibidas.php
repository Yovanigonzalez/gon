<?php
// Incluir el archivo de conexión
include '../config/conexion.php';

// Obtener los valores del formulario
$caja_recibida = $_POST['caja_recibida'];
$tapa_recibida = $_POST['tapa_recibida'];

// Actualizar la tabla canastilla
$sql_actualizar_canastilla = "UPDATE canastilla SET 
    caja = caja + ?,
    tapa = tapa + ?
    WHERE id = 1"; // Asegúrate de especificar la condición correcta para seleccionar la fila adecuada

$stmt = $conn->prepare($sql_actualizar_canastilla);
$stmt->bind_param("ii", $caja_recibida, $tapa_recibida);
$stmt->execute();

// Verificar si la actualización fue exitosa
if ($stmt->affected_rows > 0) {
    // Guardar la información en la tabla cajas_recibidas
    $sql_guardar_recibida = "INSERT INTO cajas_recibidas (caja, tapa) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_guardar_recibida);
    $stmt->bind_param("ii", $caja_recibida, $tapa_recibida);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        // Redirigir con mensaje de éxito específico para las cajas recibidas
        header("Location: canastilla_patsa?mensaje_exito_recibida=Cajas recibidas guardada correctamente");
    } else {
        // Redirigir con mensaje de error específico para las cajas recibidas
        header("Location: canastilla_patsa?mensaje_error_recibida=Error al guardar los datos de cajas recibidas");
    }
} else {
    // Redirigir con mensaje de error específico para la actualización de canastilla
    header("Location: canastilla_patsa?mensaje_error_recibida=Error al actualizar la canastilla");
}

$stmt->close();
$conn->close();
?>
