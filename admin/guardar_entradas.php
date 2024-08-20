<?php
// Conexión a la base de datos
include '../config/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $producto_id = $_POST['producto'];
    $stock = $_POST['stock'];
    $kilos = $_POST['kilos'];

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
        $query_check = "SELECT stock, kilos FROM entradas WHERE producto_id = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("i", $producto_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Si el producto ya existe, actualizar el stock y los kilos sumando los nuevos valores
            $row_check = $result_check->fetch_assoc();
            $existing_stock = $row_check['stock'];
            $existing_kilos = $row_check['kilos'];
            $new_stock = $existing_stock + $stock;
            $new_kilos = $existing_kilos + $kilos;

            $query_update = "UPDATE entradas SET stock = ?, kilos = ? WHERE producto_id = ?";
            $stmt_update = $conn->prepare($query_update);
            $stmt_update->bind_param("dii", $new_stock, $new_kilos, $producto_id); // Cambiado a 'dii'

            // Insertar en la tabla 'entradas_con_fecha' también
            $query_insert_con_fecha = "INSERT INTO entradas_con_fecha (producto_id, producto_nombre, stock, kilos) VALUES (?, ?, ?, ?)";
            $stmt_insert_con_fecha = $conn->prepare($query_insert_con_fecha);
            $stmt_insert_con_fecha->bind_param("isdd", $producto_id, $producto_nombre, $stock, $kilos); // Cambiado a 'isdd'

            // Ejecutar ambas consultas
            if ($stmt_update->execute() && $stmt_insert_con_fecha->execute()) {
                // Redirigir con éxito
                header("Location: agregar_entradas?pollo_success=true&message=Stock y kilos actualizados, entrada registrada");
                exit();
            } else {
                // Redirigir con error
                $error_message = $conn->error;
                header("Location: agregar_entradas?pollo_success=false&error_message=" . urlencode($error_message));
                exit();
            }
        } else {
            // Si el producto no existe, insertarlo en la tabla 'entradas'
            $query_insert = "INSERT INTO entradas (producto_id, producto_nombre, stock, kilos) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("isdd", $producto_id, $producto_nombre, $stock, $kilos); // Cambiado a 'isdd'

            // Insertar en la tabla 'entradas_con_fecha' también
            $query_insert_con_fecha = "INSERT INTO entradas_con_fecha (producto_id, producto_nombre, stock, kilos) VALUES (?, ?, ?, ?)";
            $stmt_insert_con_fecha = $conn->prepare($query_insert_con_fecha);
            $stmt_insert_con_fecha->bind_param("isdd", $producto_id, $producto_nombre, $stock, $kilos); // Cambiado a 'isdd'

            // Ejecutar ambas consultas
            if ($stmt_insert->execute() && $stmt_insert_con_fecha->execute()) {
                // Redirigir con éxito
                header("Location: agregar_entradas?pollo_success=true&message=Entrada registrada correctamente");
                exit();
            } else {
                // Redirigir con error
                $error_message = $conn->error;
                header("Location: agregar_entradas?pollo_success=false&error_message=" . urlencode($error_message));
                exit();
            }
        }
    } else {
        // Redirigir con error si el producto no existe
        header("Location: agregar_entradas?pollo_success=false&error_message=" . urlencode("Producto no encontrado"));
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
