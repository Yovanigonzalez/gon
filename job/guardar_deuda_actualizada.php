<?php
include('../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCliente = $_POST['idCliente'];
    $dineroRecibido = $_POST['dineroRecibido'];

    // Establecer la zona horaria a GMT-6 sin horario de verano
    date_default_timezone_set('Etc/GMT+6');
    
    // Formatear la fecha
    $fecha = date('Y-m-d H:i:s');

    // Recupera la deuda actual del cliente
    $querySelect = "SELECT nombre_cliente, direccion, cantidad_deuda FROM deudores WHERE id = ?";
    $stmtSelect = $conn->prepare($querySelect);
    $stmtSelect->bind_param("i", $idCliente);
    $stmtSelect->execute();
    $stmtSelect->bind_result($nombreCliente, $direccion, $cantidadDeuda);
    $stmtSelect->fetch();
    $stmtSelect->close();

    if ($cantidadDeuda !== null) {
        // Calcula la nueva deuda
        $nuevaDeuda = $cantidadDeuda - $dineroRecibido;

        // Inserta en historial_deudas
        $queryInsert = "INSERT INTO historial_deudas (id_cliente, nombre_cliente, direccion, deuda_restante, fecha) VALUES (?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($queryInsert);
        $stmtInsert->bind_param("issds", $idCliente, $nombreCliente, $direccion, $dineroRecibido, $fecha);
        $stmtInsert->execute();
        $stmtInsert->close();

        // Actualiza la deuda en deudores
        $queryUpdate = "UPDATE deudores SET cantidad_deuda = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bind_param("di", $nuevaDeuda, $idCliente);
        $stmtUpdate->execute();
        $stmtUpdate->close();

        // Redirige con mensaje de éxito
        header("Location: actualizar_deuda?mensaje_exito=Deuda actualizada exitosamente.");
        exit();
    } else {
        // Redirige con mensaje de error
        header("Location: actualizar_deuda?mensaje_error=Error: No se encontró la deuda para el cliente seleccionado.");
        exit();
    }
}
?>
