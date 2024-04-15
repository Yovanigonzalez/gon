<?php
session_start();

include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre del producto del formulario
$nombreProducto = $_POST['nombreProducto'];

// Preparar la consulta SQL para insertar el producto en la tabla correspondiente
$sql = "INSERT INTO productos (nombre) VALUES ('$nombreProducto')";

if ($conn->query($sql) === TRUE) {
    // Guardar mensaje de éxito en una variable de sesión
    $_SESSION['mensaje_exito'] = "El producto se agregó correctamente";
} else {
    // Guardar mensaje de error en una variable de sesión
    $_SESSION['mensaje_error'] = "Error al agregar el producto: " . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redireccionar de vuelta a agregar_productos.php
header("Location: agregar_productos.php");
exit();
?>
