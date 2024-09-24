<?php
include '../config/conexion.php';

$idCliente = $_POST['idCliente'] ?? '';
$cajas = $_POST['cajas'] ?? 0;
$tapas = $_POST['tapas'] ?? 0;

if ($idCliente) {
    // Obtener las cantidades actuales de cajas y tapas
    $sql = "SELECT cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Restar las cantidades de cajas y tapas
        $nuevaCantidadCajas = $row['cantidad_cajas'] - $cajas;
        $nuevaCantidadTapas = $row['cantidad_tapas'] - $tapas;

        // Actualizar las cantidades en la tabla deudores_cajas
        $sql = "UPDATE deudores_cajas SET cantidad_cajas = ?, cantidad_tapas = ? WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $nuevaCantidadCajas, $nuevaCantidadTapas, $idCliente);
        $stmt->execute();

        // Registrar el movimiento en la tabla movimientos_cajas_tapas
        $sql = "INSERT INTO movimientos_cajas_tapas (id_cliente, cajas, tapas) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $idCliente, $cajas, $tapas);
        $stmt->execute();

        // Redirigir con mensaje de éxito
        header('Location: canastilla.php?mensaje_exito=Actualización exitosa y movimiento registrado');
    } else {
        header('Location: canastilla.php?mensaje_error=Cliente no encontrado');
    }
} else {
    header('Location: canastilla.php?mensaje_error=ID de cliente no válido');
}
?>
