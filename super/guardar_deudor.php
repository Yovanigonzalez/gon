<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$idCliente = $_POST["idCliente"];
$nombreCliente = $_POST["nombreCliente"];
$direccion = $_POST["direccion"];
$cantidadDeuda = $_POST["cantidadDeuda"];

// Preparar la consulta SQL para insertar los datos en la tabla deudores
$sql = "INSERT INTO deudores (id_cliente, nombre_cliente, direccion, cantidad_deuda) VALUES ('$idCliente', '$nombreCliente', '$direccion', '$cantidadDeuda')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a la página principal con un mensaje de éxito
    header("Location: deudores.php?mensaje_exito=Cliente agregado a deudores correctamente");
    exit();
} else {
    // Redirigir a la página principal con un mensaje de error
    header("Location: deudores.php?mensaje_error=Error al agregar cliente a deudores: " . $conn->error);
    exit();
}

// Cerrar la conexión
$conn->close();
?>

