<?php
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si se han enviado datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menudenciaId = $_POST['menudenciaId'];
    $kilos = $_POST['kilos'];

    // Construir la consulta SQL para actualizar
    $updates = [];
    if (!empty($kilos)) {
        $updates[] = "kilos='$kilos'";
    }

    // Si hay actualizaciones
    if (count($updates) > 0) {
        $sql = "UPDATE entradas_menudencia SET " . implode(", ", $updates) . " WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $menudenciaId);

        if ($stmt->execute()) {
            header("Location: editar_inventario?mensaje_exito_editar2=Producto (Menudencia) actualizado correctamente");
        } else {
            header("Location: editar_inventario?mensaje_error_editar2=Error al actualizar el producto (Menudencia)");
        }

        $stmt->close();
    } else {
        // Si no se modificó nada
        header("Location: editar_inventario?mensaje_error_editar2=No se realizaron cambios");
    }
}

$conn->close();
?>
