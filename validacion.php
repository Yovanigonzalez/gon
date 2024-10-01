<?php
// Conectar a la base de datos
include 'config/conexion.php';

// Obtener los valores del formulario
$correo = $_POST['email'];
$contrasena = $_POST['password'];

// Consultar el usuario en la base de datos
$query = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificar si la contraseña es correcta
    if (password_verify($contrasena, $usuario['contrasena'])) {  // Asumiendo que estás usando `password_hash` para almacenar contraseñas.
        // Redirigir según el rol del usuario
        switch ($usuario['rol']) {
            case 'admin':
                header("Location: admin/admin");
                break;
            case 'empleado':
                header("Location: job/admin");
                break;
            case 'super_admin':
                header("Location: super/admin");
                break;
            default:
                header("Location: index?mensaje_error=Rol desconocido");
                break;
        }
    } else {
        // Contraseña incorrecta
        header("Location: index?mensaje_error=Contraseña incorrecta");
    }
} else {
    // Usuario no encontrado
    header("Location: index?mensaje_error=Usuario no encontrado");
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
