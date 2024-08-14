<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos (asegúrate de incluir tu archivo de conexión)
    include '../config/conexion.php'; // Reemplaza 'conexion.php' con el archivo que contiene tu conexión a la base de datos

    // Recuperar los datos del formulario
    $cliente = $_POST['cliente'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];

    // Insertar los datos en la base de datos
    for ($i = 0; $i < count($productos); $i++) {
        $producto = $productos[$i];
        $cantidad = $cantidades[$i];
        $sqlPedido = "INSERT INTO pedidos (cliente, fecha, hora, producto, cantidad) VALUES ('$cliente', '$fecha', '$hora', '$producto', '$cantidad')";
        if (!mysqli_query($conexion, $sqlPedido)) {
            // Si falla la inserción de algún registro, mostrar mensaje de error y salir del bucle
            $mensaje_error = "Error al guardar el pedido.";
            header("Location: pedidos?mensaje_error=" . urlencode($mensaje_error));
            exit();
        }
    }

    // Redirigir con un mensaje de éxito
    $mensaje_exito = "Pedidos guardados correctamente.";
    header("Location: pedidos?mensaje_exito=" . urlencode($mensaje_exito));
    exit();

} else {
    // Redirigir si se intenta acceder directamente a este script sin enviar datos desde el formulario
    header("Location: pedidos");
    exit();
}
?>
