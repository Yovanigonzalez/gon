<?php
include '../config/conexion.php';

$idCliente = $_POST['idCliente'] ?? '';
$cajas = $_POST['cajas'] ?? 0;
$tapas = $_POST['tapas'] ?? 0;

if ($idCliente) {
    // Obtener las cantidades actuales
    $sql = "SELECT cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $nuevaCantidadCajas = $row['cantidad_cajas'] - $cajas;
        $nuevaCantidadTapas = $row['cantidad_tapas'] - $tapas;

        // Actualizar las cantidades en la base de datos
        $sql = "UPDATE deudores_cajas SET cantidad_cajas = ?, cantidad_tapas = ? WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $nuevaCantidadCajas, $nuevaCantidadTapas, $idCliente);
        $stmt->execute();

        // Redirigir o mostrar mensaje de éxito
        header('Location: canastilla?mensaje_exito=Actualización exitosa');
    } else {
        header('Location: canastilla?mensaje_error=Cliente no encontrado');
    }
} else {
    header('Location: canastilla?mensaje_error=ID de cliente no válido');
}
?>
