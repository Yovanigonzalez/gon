<?php
// Conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda del parámetro GET
$searchTerm = $_GET['term'];

// Consulta SQL para buscar productos que coincidan con el término de búsqueda
$sql = "SELECT id, nombre FROM productos WHERE nombre LIKE '%" . $searchTerm . "%'";
$result = $conn->query($sql);

// Array para almacenar los resultados
$productos = array();

// Verificar si hay resultados y agregarlos al array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $producto = array(
            'id' => $row['id'],
            'nombre' => $row['nombre']
        );
        $productos[] = $producto;
    }
}

// Codificar los resultados en formato JSON y devolverlos
echo json_encode($productos);

// Cerrar la conexión a la base de datos
$conn->close();
?>
