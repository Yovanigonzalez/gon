<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se recibió el ID del cliente
if(isset($_GET['idCliente'])) {
    // Obtener el ID del cliente desde la solicitud
    $idCliente = $_GET['idCliente'];

    // Consulta SQL para obtener la cantidad de deuda del cliente
    $sql = "SELECT cantidad_deuda FROM deudores WHERE id_cliente = $idCliente";

    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener la cantidad de deuda
        $row = $result->fetch_assoc();
        $cantidadDeuda = $row['cantidad_deuda'];

        // Crear un array para almacenar la cantidad de deuda
        $response = array(
            'cantidad_deuda' => $cantidadDeuda
        );

        // Devolver la cantidad de deuda como JSON
        echo json_encode($response);
    } else {
        // Si no hay deuda registrada para este cliente, devolver cero
        $response = array(
            'cantidad_deuda' => 0
        );

        // Devolver cero como JSON
        echo json_encode($response);
    }
} else {
    // Si no se recibió el ID del cliente, devolver un error
    $response = array(
        'error' => 'No se recibió el ID del cliente'
    );

    // Devolver el error como JSON
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
