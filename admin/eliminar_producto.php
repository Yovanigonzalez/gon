<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se ha proporcionado un ID de producto y una tabla para eliminar
if (isset($_GET['id']) && isset($_GET['tabla'])) {
    $id_producto = $_GET['id'];
    $tabla = $_GET['tabla'];

    // Eliminar el producto de la tabla correspondiente
    $sql = "DELETE FROM $tabla WHERE id=$id_producto";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de productos con un mensaje de éxito
        header("Location: total_productos?success=2");
        exit();
    } else {
        // Si ocurre un error, redirigir de vuelta a la página de productos con un mensaje de error
        header("Location: total_productos?error=2");
        exit();
    }
} else {
    // Si no se proporciona un ID de producto o una tabla, redirigir de vuelta a la página de productos con un mensaje de error
    header("Location: total_productos?error=2");
    exit();
}
?>
