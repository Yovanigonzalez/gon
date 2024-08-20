<?php
session_start();

include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre del producto del formulario
$nombreProducto = $_POST['nombreProducto'];

// Verificar si ya existe un producto con el mismo nombre
$sql_verificar = "SELECT * FROM productos_menudencia WHERE nombre = '$nombreProducto'";
$result = $conn->query($sql_verificar);

if ($result->num_rows > 0) {
    // Si existe un producto con el mismo nombre, mostrar mensaje de error
    $_SESSION['mensaje_error'] = "El producto ya existe en la base de datos.";
} else {
    // Preparar la consulta SQL para insertar el producto en la tabla correspondiente
    $sql_insertar = "INSERT INTO productos_menudencia (nombre) VALUES ('$nombreProducto')";

    if ($conn->query($sql_insertar) === TRUE) {
        // Guardar mensaje de éxito en una variable de sesión
        $_SESSION['mensaje_exito'] = "El producto se agregó correctamente";
    } else {
        // Guardar mensaje de error en una variable de sesión
        $_SESSION['mensaje_error'] = "Error al agregar el producto: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();

// Redireccionar de vuelta a agregar_productos.php
header("Location: agregar_productos_menudencia");
exit();
?>
