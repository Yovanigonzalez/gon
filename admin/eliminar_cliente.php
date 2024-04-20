<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se ha proporcionado un ID de cliente válido en la URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $cliente_id = $_GET['id'];
    
    // Consulta SQL para eliminar el cliente con el ID proporcionado
    $sql = "DELETE FROM clientes WHERE id = $cliente_id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de lista de clientes con un mensaje de éxito
        header("Location: total_clientes.php?delete_success=1");
        exit();
    } else {
        // Redirigir de vuelta a la página de lista de clientes con un mensaje de error
        header("Location: total_clientes.php?delete_error=1");
        exit();
    }
} else {
    // Redirigir de vuelta a la página de lista de clientes si no se proporcionó un ID válido
    header("Location: total_clientes.php?delete_error=1");
    exit();
}
?>
