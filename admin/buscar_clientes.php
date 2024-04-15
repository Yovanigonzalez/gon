<?php
// Conexión a la base de datos
include '../config/conexion.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda
$q = $_GET["q"];

// Consulta SQL para buscar clientes
$sql = "SELECT id, nombre, direccion FROM clientes WHERE nombre LIKE '%$q%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar resultados de la búsqueda
    while($row = $result->fetch_assoc()) {
        echo "<div onclick='seleccionarCliente(" . $row["id"] . ", \"" . $row["nombre"] . "\", \"" . $row["direccion"] . "\")'>ID: " . $row["id"] . " - Nombre: " . $row["nombre"] . " - Dirección: " . $row["direccion"] . "</div>";
    }
} else {
    echo "No se encontraron resultados";
}
$conn->close();
?>
