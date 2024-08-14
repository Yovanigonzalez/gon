<?php
// Conexión a la base de datos
include '../config/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $producto_id = $_POST['producto'];
    $stock = $_POST['stock'];

    // Obtener el nombre del producto basado en el ID
    $query_nombre = "SELECT nombre FROM productos WHERE id = ?";
    $stmt = $conn->prepare($query_nombre);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $producto_nombre = $row['nombre'];

        // Verificar si el producto ya tiene entradas en la tabla 'entradas'
        $query_check = "SELECT stock FROM entradas WHERE producto_id = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("i", $producto_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Si el producto ya existe, actualizar el stock sumando el nuevo valor
            $row_check = $result_check->fetch_assoc();
            $existing_stock = $row_check['stock'];
            $new_stock = $existing_stock + $stock;

            $query_update = "UPDATE entradas SET stock = ? WHERE producto_id = ?";
            $stmt_update = $conn->prepare($query_update);
            $stmt_update->bind_param("ii", $new_stock, $producto_id);

            // Insertar en la tabla 'entradas_con_fecha' también
            $query_insert_con_fecha = "INSERT INTO entradas_con_fecha (producto_id, producto_nombre, stock) VALUES (?, ?, ?)";
            $stmt_insert_con_fecha = $conn->prepare($query_insert_con_fecha);
            $stmt_insert_con_fecha->bind_param("isi", $producto_id, $producto_nombre, $stock);

            // Ejecutar ambas consultas
            if ($stmt_update->execute() && $stmt_insert_con_fecha->execute()) {
                // Redirigir con éxito
                header("Location: agregar_entradas?success=true&message=Stock actualizado y entrada registrada");
                exit();
            } else {
                // Redirigir con error
                $error_message = $conn->error;
                header("Location: agregar_entradas?success=false&error_message=" . urlencode($error_message));
                exit();
            }
        } else {
            // Si el producto no existe, insertarlo en la tabla 'entradas'
            $query_insert = "INSERT INTO entradas (producto_id, producto_nombre, stock) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("isi", $producto_id, $producto_nombre, $stock);

            // Insertar en la tabla 'entradas_con_fecha' también
            $query_insert_con_fecha = "INSERT INTO entradas_con_fecha (producto_id, producto_nombre, stock) VALUES (?, ?, ?)";
            $stmt_insert_con_fecha = $conn->prepare($query_insert_con_fecha);
            $stmt_insert_con_fecha->bind_param("isi", $producto_id, $producto_nombre, $stock);

            // Ejecutar ambas consultas
            if ($stmt_insert->execute() && $stmt_insert_con_fecha->execute()) {
                // Redirigir con éxito
                header("Location: agregar_entradas?success=true&message=Entrada registrada correctamente");
                exit();
            } else {
                // Redirigir con error
                $error_message = $conn->error;
                header("Location: agregar_entradas?success=false&error_message=" . urlencode($error_message));
                exit();
            }
        }
    } else {
        // Redirigir con error si el producto no existe
        header("Location: agregar_entradas?success=false&error_message=" . urlencode("Producto no encontrado"));
        exit();
    }
} else {
    // Redirigir si se intenta acceder directamente al script
    header("Location: agregar_entradas");
    exit();
}

// Cerrar la conexión
$conn->close();
?>
