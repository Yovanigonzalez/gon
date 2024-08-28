<?php
include '../config/conexion.php';

$nombreCliente = $_GET['nombreCliente'] ?? '';

if ($nombreCliente) {
    $sql = "SELECT * FROM deudores_cajas WHERE nombre_cliente LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$nombreCliente%";
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="search-result" onclick="seleccionarCliente(' . $row['id_cliente'] . ', \'' . $row['nombre_cliente'] . '\', \'' . $row['direccion'] . '\', ' . $row['cantidad_cajas'] . ', ' . $row['cantidad_tapas'] . ')">';
            echo $row['nombre_cliente'];
            echo '</div>';
        }
    } else {
        echo 'No se encontraron resultados';
    }
}
?>
