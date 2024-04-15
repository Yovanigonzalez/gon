<?php
// Archivo: guardar_clientes.php
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreCliente = $_POST['nombreCliente'];
    $direccion = $_POST['direccion'];

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO clientes (nombre, direccion) VALUES (?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros con los valores recibidos del formulario
    $stmt->bind_param("ss", $nombreCliente, $direccion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Configurar un mensaje de éxito
        $mensaje_exito = "Cliente agregado exitosamente.";
    } else {
        // Configurar un mensaje de error en caso de fallo
        $mensaje_error = "Error al agregar el cliente: " . $conn->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();

// Redirigir a agregar_clientes.php con mensaje de éxito o error como parámetro de URL
if (isset($mensaje_exito)) {
    header("Location: agregar_cliente.php?mensaje_exito=" . urlencode($mensaje_exito));
} else {
    header("Location: agregar_cliente.php?mensaje_error=" . urlencode($mensaje_error));
}
exit();
?>
