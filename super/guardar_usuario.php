<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar si los datos fueron enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    
    // Encriptar la contraseña
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    // Consulta para insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (correo, contrasena, rol) VALUES (?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("sss", $correo, $contrasena, $rol);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir con mensaje de éxito
        header("Location: usuarios?mensaje_exito_agregar=Usuario agregado exitosamente");
        exit();
    } else {
        // Redirigir con mensaje de error
        header("Location: usuarios?mensaje_error_agregar=Error al agregar el usuario: " . $stmt->error);
        exit();
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    header("Location: usuarios?mensaje_error_agregar=Solicitud inválida.");
    exit();
}

// Cerrar la conexión
$conn->close();
?>
