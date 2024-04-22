<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda enviado por AJAX
$q = $_REQUEST["q"];

// Consulta SQL para buscar clientes que coincidan con el término de búsqueda
$sql = "SELECT * FROM clientes WHERE nombre LIKE '%$q%'";

$resultado = $conn->query($sql);

// Mostrar resultados
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        // Escapar caracteres especiales para evitar problemas de seguridad
        $nombre = htmlspecialchars($fila["nombre"]);
        $direccion = htmlspecialchars($fila["direccion"]);
        echo "<p onclick='seleccionarCliente(\"" . $fila["id"] . "\", \"" . $nombre . "\", \"" . $direccion . "\")'>" . $nombre . " - " . $direccion . "</p>";
    }
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión
$conn->close();
?>
