<?php
include '../config/conexion.php';

$id_cliente = $_GET['id_cliente'];
$sql = "SELECT cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

$deuda = array('cantidad_cajas' => 0, 'cantidad_tapas' => 0);
if ($row = $result->fetch_assoc()) {
  $deuda['cantidad_cajas'] = $row['cantidad_cajas'];
  $deuda['cantidad_tapas'] = $row['cantidad_tapas'];
}

echo json_encode($deuda);
?>
