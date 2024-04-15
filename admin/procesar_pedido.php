<?php
// Establecer la conexión con la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar datos del formulario
$cliente = $_POST['cliente'];
$direccion = $_POST['direccion'];
$fecha = $_POST['fecha'];
$productos = $_POST['productos'];
$cantidades = $_POST['cantidades'];

// Insertar datos del pedido en la tabla de pedidos
$sql_pedido = "INSERT INTO pedidos (cliente, direccion, fecha) VALUES ('$cliente', '$direccion', '$fecha')";

if ($conn->query($sql_pedido) === TRUE) {
  // Obtener el ID del pedido insertado
  $pedido_id = $conn->insert_id;

  // Insertar productos del pedido en la tabla de productos
  foreach ($productos as $index => $producto) {
    $cantidad = $cantidades[$index];
    $sql_producto = "INSERT INTO pedido_lista (pedido_id, producto, cantidad) VALUES ('$pedido_id', '$producto', '$cantidad')";
    $conn->query($sql_producto);
  }

  echo "Pedido agregado correctamente";
} else {
  echo "Error: " . $sql_pedido . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
