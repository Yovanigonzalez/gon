<?php
// Conexión a la base de datos
include '../config/conexion.php';

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibe los datos del POST
$data = json_decode(file_get_contents("php://input"), true);

$cliente = $data['cliente'];
$direccion = $data['direccion'];
$cantidad_cajas = floatval($data['cajaPendiente']); // Cantidad de cajas pendientes
$cantidad_tapas = floatval($data['tapaPendiente']); // Cantidad de tapas pendientes

// Obtén el id_cliente correspondiente al cliente
$id_cliente = obtenerIdCliente($cliente, $conn);

if ($id_cliente === null) {
    echo json_encode(['success' => false, 'error' => 'Cliente no encontrado']);
    exit();
}

// Verifica si ya existe un registro en la tabla deudores_cajas con el id_cliente
$sql_check = "SELECT direccion, cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE id_cliente = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $id_cliente);
$stmt_check->execute();
$stmt_check->store_result();

// Si existe el cliente, verifica si los datos han cambiado
if ($stmt_check->num_rows > 0) {
    $stmt_check->bind_result($direccion_actual, $cajas_actuales, $tapas_actuales);
    $stmt_check->fetch();

    // Solo actualiza si hay cambios en los datos
    if ($direccion_actual != $direccion || $cajas_actuales != $cantidad_cajas || $tapas_actuales != $cantidad_tapas) {
        // Actualiza los datos
        $sql_update = "UPDATE deudores_cajas SET nombre_cliente = ?, direccion = ?, cantidad_cajas = ?, cantidad_tapas = ? WHERE id_cliente = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssiii", $cliente, $direccion, $cantidad_cajas, $cantidad_tapas, $id_cliente);

        if ($stmt_update->execute()) {
            echo json_encode(['success' => true, 'action' => 'updated']);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt_update->error]);
        }

        $stmt_update->close();
    } else {
        // No hay cambios, no hace falta actualizar
        echo json_encode(['success' => true, 'action' => 'no_changes']);
    }
} else {
    // Si no existe un registro, inserta uno nuevo
    $sql_insert = "INSERT INTO deudores_cajas (id_cliente, nombre_cliente, direccion, cantidad_cajas, cantidad_tapas) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("issii", $id_cliente, $cliente, $direccion, $cantidad_cajas, $cantidad_tapas);

    if ($stmt_insert->execute()) {
        echo json_encode(['success' => true, 'action' => 'inserted']);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt_insert->error]);
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conn->close();

// Función para obtener el id_cliente
function obtenerIdCliente($nombre_cliente, $conn) {
    $sql = "SELECT id FROM clientes WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_cliente);
    $stmt->execute();
    $stmt->bind_result($id_cliente);
    $stmt->fetch();
    $stmt->close();
    
    return $id_cliente ? $id_cliente : null; // Devuelve el ID o null si no se encuentra
}
?>
