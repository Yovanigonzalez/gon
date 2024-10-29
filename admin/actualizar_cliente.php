<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se ha enviado el formulario de actualización
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $cliente_id = $_POST['cliente_id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    
    // Consulta SQL para actualizar la información del cliente
    $sql = "UPDATE clientes SET nombre='$nombre', direccion='$direccion' WHERE id=$cliente_id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de lista de clientes con un mensaje de éxito
        header("Location: total_clientes?success=1");
        exit();
    } else {
        // Redirigir de vuelta a la página de lista de clientes con un mensaje de error
        header("Location: total_clientes?error=1");
        exit();
    }
} else {
    // Redirigir de vuelta a la página de lista de clientes si no se envió el formulario correctamente
    header("Location: total_clientes?error=1");
    exit();
}
?>
