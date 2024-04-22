<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda enviado por AJAX
$term = $_GET['term'];

// Consulta SQL para buscar clientes que coincidan con el término de búsqueda
$sql = "SELECT id, nombre, direccion FROM clientes WHERE nombre LIKE '%$term%'";

$result = $conn->query($sql);

// Crear un array para almacenar los resultados de la consulta
$clientes = array();

// Iterar sobre los resultados y añadirlos al array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtener el ID del cliente
        $idCliente = $row['id'];

        // Consultar si el cliente tiene una deuda pendiente
        $deudaSql = "SELECT cantidad_deuda FROM deudores WHERE id_cliente = $idCliente";
        $deudaResult = $conn->query($deudaSql);
        $cantidadDeuda = 0; // Inicializar la cantidad de deuda en cero

        // Si hay resultados, obtener la cantidad de deuda
        if ($deudaResult->num_rows > 0) {
            $deudaRow = $deudaResult->fetch_assoc();
            $cantidadDeuda = $deudaRow['cantidad_deuda'];
        }

        // Agregar el cliente al array con la cantidad de deuda
        $clientes[] = array(
            'id' => $idCliente,
            'nombre' => $row['nombre'],
            'direccion' => $row['direccion'],
            'cantidad_deuda' => $cantidadDeuda
        );
    }
}

// Devolver los resultados como JSON
echo json_encode($clientes);

// Cerrar conexión
$conn->close();
?>
