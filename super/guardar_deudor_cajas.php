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
$cantidadCajas = $_POST["cantidadCajas"]; // Cambié el nombre del campo de "cantidadDeuda" a "cantidadCajas"
$cantidadTapas = $_POST["cantidadTapas"];

// Preparar la consulta SQL para insertar los datos en la tabla deudores_cajas
$sql = "INSERT INTO deudores_cajas (id_cliente, nombre_cliente, direccion, cantidad_cajas, cantidad_tapas) 
        VALUES ('$idCliente', '$nombreCliente', '$direccion', '$cantidadCajas', '$cantidadTapas')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a la página principal con un mensaje de éxito
    header("Location: deudores_cajas.php?mensaje_exito=Cliente agregado a deudores correctamente");
    exit();
} else {
    // Redirigir a la página principal con un mensaje de error
    header("Location: deudores_cajas.php?mensaje_error=Error al agregar cliente a deudores: " . $conn->error);
    exit();
}

// Cerrar la conexión
$conn->close();
?>
