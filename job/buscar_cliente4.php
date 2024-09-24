<?php
include('../config/conexion.php');

if (isset($_GET['nombreCliente'])) {
    $nombreCliente = $_GET['nombreCliente'];
    
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT id, id_cliente, nombre_cliente, direccion, cantidad_deuda FROM deudores WHERE nombre_cliente LIKE ?");
    $likeNombreCliente = "%".$nombreCliente."%";
    $stmt->bind_param("s", $likeNombreCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Crear un bloque de opciones que se mostrarán como resultados de búsqueda
        while ($row = $result->fetch_assoc()) {
            echo '<div onclick="seleccionarCliente(' . $row['id'] . ', \'' . $row['nombre_cliente'] . '\', \'' . $row['direccion'] . '\', ' . $row['cantidad_deuda'] . ')">';
            echo $row['nombre_cliente'] . ' - ' . $row['direccion'];
            echo '</div>';
        }
    } else {
        echo 'No se encontraron clientes';
    }
    
    $stmt->close();
}
?>
