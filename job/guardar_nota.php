<?php
include '../config/conexion.php'; // Asegúrate de que esta ruta sea correcta

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
  echo json_encode(['success' => false, 'message' => 'No data received']);
  exit;
}

// Extrae los datos del JSON
$cliente = $data['cliente'];
$direccion = $data['direccion'];
$productos = $data['productos'];
$subtotalVendido = $data['subtotalVendido'];
$deudaPendiente = $data['deudaPendiente'];
$total = $data['total'];
$cajaDeudora = $data['cajaDeudora'];
$tapaDeudora = $data['tapaDeudora'];
$cajaEnviada = $data['cajaEnviada'];
$tapaEnviada = $data['tapaEnviada'];
$cajaPendiente = $data['cajaPendiente'];
$tapaPendiente = $data['tapaPendiente'];

// Insertar la nota en la base de datos
$sql = "INSERT INTO notas (cliente, direccion, subtotal_vendido, deuda_pendiente, total, caja_deudora, tapa_deudora, caja_enviada, tapa_enviada, caja_pendiente, tapa_pendiente)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $cliente, $direccion, $subtotalVendido, $deudaPendiente, $total, $cajaDeudora, $tapaDeudora, $cajaEnviada, $tapaEnviada, $cajaPendiente, $tapaPendiente);

if ($stmt->execute()) {
  $notaId = $stmt->insert_id;

  // Insertar los productos en la tabla de productos_nota
  $sqlProductos = "INSERT INTO productos_nota (nota_id, producto, piezas, kilos, precio, subtotal)";
  $sqlProductos .= " VALUES (?, ?, ?, ?, ?, ?)";

  $stmtProductos = $conn->prepare($sqlProductos);

  foreach ($productos as $producto) {
    $stmtProductos->bind_param("isssss", $notaId, $producto['producto'], $producto['piezas'], $producto['kilos'], $producto['precio'], $producto['subtotal']);
    $stmtProductos->execute();
  }

  // Obtener el ID del cliente
  $sqlClienteId = "SELECT id FROM deudores WHERE nombre_cliente = ? AND direccion = ?";
  $stmtClienteId = $conn->prepare($sqlClienteId);
  $stmtClienteId->bind_param("ss", $cliente, $direccion);
  $stmtClienteId->execute();
  $result = $stmtClienteId->get_result();
  $clienteData = $result->fetch_assoc();

  if ($clienteData) {
    $clienteId = $clienteData['id'];

    // Actualizar la tabla deudores con el nuevo total
    $sqlActualizarDeuda = "UPDATE deudores
                           SET cantidad_deuda = ?
                           WHERE id = ?";

    $stmtActualizarDeuda = $conn->prepare($sqlActualizarDeuda);
    $stmtActualizarDeuda->bind_param("di", $total, $clienteId);
    $stmtActualizarDeuda->execute();
  }

  // Actualizar la tabla deudores_cajas
  $sqlCajas = "SELECT id, cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE nombre_cliente = ? AND direccion = ?";
  $stmtCajas = $conn->prepare($sqlCajas);
  $stmtCajas->bind_param("ss", $cliente, $direccion);
  $stmtCajas->execute();
  $resultCajas = $stmtCajas->get_result();
  $clienteDataCajas = $resultCajas->fetch_assoc();

  if ($clienteDataCajas) {
    $clienteIdCajas = $clienteDataCajas['id'];
    $cantidadCajasActual = $clienteDataCajas['cantidad_cajas'];
    $cantidadTapasActual = $clienteDataCajas['cantidad_tapas'];

    // Sumar las nuevas cantidades a las existentes
    $cantidadCajasNueva = $cantidadCajasActual + $cajaEnviada;
    $cantidadTapasNueva = $cantidadTapasActual + $tapaEnviada;

    $sqlActualizarCajas = "UPDATE deudores_cajas
                           SET cantidad_cajas = ?, cantidad_tapas = ?
                           WHERE id = ?";

    $stmtActualizarCajas = $conn->prepare($sqlActualizarCajas);
    $stmtActualizarCajas->bind_param("iis", $cantidadCajasNueva, $cantidadTapasNueva, $clienteIdCajas);
    $stmtActualizarCajas->execute();
  }

  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
