<?php
// Incluir el archivo de conexión
include '../config/conexion.php';

// Obtener los valores del formulario
$caja_enviada = $_POST['caja_enviada'];
$tapa_enviada = $_POST['tapa_enviada'];

// Actualizar la tabla canastilla
$sql_actualizar_canastilla = "UPDATE canastilla SET 
    caja = caja - ?,
    tapa = tapa - ?
    WHERE id = 1"; // Asegúrate de especificar la condición correcta para seleccionar la fila adecuada

$stmt = $conn->prepare($sql_actualizar_canastilla);
$stmt->bind_param("ii", $caja_enviada, $tapa_enviada);
$stmt->execute();

// Verificar si la actualización fue exitosa
if ($stmt->affected_rows > 0) {
    // Guardar la información en la tabla caja_enviada
    $sql_guardar_enviada = "INSERT INTO caja_enviada (caja, tapa) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_guardar_enviada);
    $stmt->bind_param("ii", $caja_enviada, $tapa_enviada);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        // Redirigir con mensaje de éxito específico para la caja enviada
        header("Location: canastilla_patsa?mensaje_exito_enviada=Caja enviada guardada correctamente");
    } else {
        // Redirigir con mensaje de error específico para la caja enviada
        header("Location: canastilla_patsa?mensaje_error_enviada=Error al guardar los datos de caja enviada");
    }
} else {
    // Redirigir con mensaje de error específico para la actualización de canastilla
    header("Location: canastilla_patsa?mensaje_error_caja=Error al actualizar la canastilla");
}

$stmt->close();
$conn->close();
?>
