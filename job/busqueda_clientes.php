<?php
// Conexión a la base de datos (debes llenar estos datos según tu configuración)

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
        $clientes[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'direccion' => $row['direccion']
        );
    }
}

// Devolver los resultados como JSON
echo json_encode($clientes);

// Cerrar conexión
$conn->close();
?>
