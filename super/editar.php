<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si se han enviado datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productoId = $_POST['productoId'];
    $stock = $_POST['stock'];
    $kilos = $_POST['kilos'];

    // Construir la consulta SQL para actualizar
    $updates = [];
    if (!empty($stock)) {
        $updates[] = "stock='$stock'";
    }
    if (!empty($kilos)) {
        $updates[] = "kilos='$kilos'";
    }

    // Si hay actualizaciones
    if (count($updates) > 0) {
        $sql = "UPDATE entradas SET " . implode(", ", $updates) . " WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productoId);

        if ($stmt->execute()) {
            header("Location: editar_inventario?mensaje_exito_editar=Producto actualizado correctamente");
        } else {
            header("Location: editar_inventario?mensaje_error_editar=Error al actualizar el producto");
        }

        $stmt->close();
    } else {
        // Si no se modificó nada
        header("Location: index.php?mensaje_error_editar=No se realizaron cambios");
    }
}

$conn->close();
?>
