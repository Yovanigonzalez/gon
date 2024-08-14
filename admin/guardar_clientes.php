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

    // Verificar si ya existe un cliente con el mismo nombre y dirección
    $sql_verificar = "SELECT * FROM clientes WHERE nombre = ? AND direccion = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("ss", $nombreCliente, $direccion);
    $stmt_verificar->execute();
    $stmt_verificar->store_result();

    if ($stmt_verificar->num_rows > 0) {
        // Si ya existe un cliente con el mismo nombre y dirección, mostrar mensaje de error
        $mensaje_error = "El cliente con ese nombre y dirección ya existe.";
    } else {
        // Preparar la consulta SQL para insertar los datos en la base de datos
        $sql_insertar = "INSERT INTO clientes (nombre, direccion) VALUES (?, ?)";
        $stmt_insertar = $conn->prepare($sql_insertar);

        // Vincular los parámetros con los valores recibidos del formulario
        $stmt_insertar->bind_param("ss", $nombreCliente, $direccion);

        // Ejecutar la consulta
        if ($stmt_insertar->execute()) {
            // Configurar un mensaje de éxito
            $mensaje_exito = "Cliente agregado exitosamente.";
        } else {
            // Configurar un mensaje de error en caso de fallo
            $mensaje_error = "Error al agregar el cliente: " . $conn->error;
        }

        // Cerrar la declaración de inserción
        $stmt_insertar->close();
    }

    // Cerrar la declaración de verificación
    $stmt_verificar->close();
}

// Cerrar la conexión a la base de datos
$conn->close();

// Redirigir a agregar_clientes.php con mensaje de éxito o error como parámetro de URL
if (isset($mensaje_exito)) {
    header("Location: agregar_cliente?mensaje_exito=" . urlencode($mensaje_exito));
} else {
    header("Location: agregar_cliente?mensaje_error=" . urlencode($mensaje_error));
}
exit();
?>
