<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se ha proporcionado un ID de producto para eliminar
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id=$id_producto";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de productos con un mensaje de éxito
        header("Location: total_productos.php?success=2");
        exit();
    } else {
        // Si ocurre un error, redirigir de vuelta a la página de productos con un mensaje de error
        header("Location: total_productos.php?error=2");
        exit();
    }
} else {
    // Si no se proporciona un ID de producto, redirigir de vuelta a la página de productos con un mensaje de error
    header("Location: total_productos.php?error=2");
    exit();
}
?>
