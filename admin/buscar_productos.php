<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibió un término de búsqueda
if(isset($_POST['searchTerm'])) {
    // Escapar el término de búsqueda para evitar inyección SQL
    $searchTerm = $conn->real_escape_string($_POST['searchTerm']);

    // Realizar la consulta para buscar productos que coincidan con el término de búsqueda en ambas tablas
    $query = "
        SELECT id, nombre, 'productos' AS source FROM productos WHERE nombre LIKE '%$searchTerm%'
        UNION
        SELECT id, nombre, 'productos_menudencia' AS source FROM productos_menudencia WHERE nombre LIKE '%$searchTerm%'
    ";
    $result = $conn->query($query);

    // Verificar si se encontraron resultados
    if($result->num_rows > 0) {
        // Crear un array para almacenar los resultados de la consulta
        $productos = array();

        // Iterar sobre los resultados y agregar cada id y nombre de producto al array
        while($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        // Devolver los resultados como JSON al cliente
        echo json_encode($productos);
    } else {
        // Si no se encontraron resultados, devolver un array vacío como JSON al cliente
        echo json_encode(array());
    }
} else {
    // Si no se recibió un término de búsqueda, devolver un mensaje de error
    echo "No se recibió un término de búsqueda.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
