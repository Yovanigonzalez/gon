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
$total = floatval($data['total']); // Asegúrate de que esto es un número

// Obtén el id_cliente correspondiente al cliente
$id_cliente = obtenerIdCliente($cliente, $conn);

if ($id_cliente === null) {
    echo json_encode(['success' => false, 'error' => 'Cliente no encontrado']);
    exit();
}

// Verifica si ya existe un registro en la tabla deudores con el mismo id_cliente
$sql_check = "SELECT id FROM deudores WHERE id_cliente = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $id_cliente);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    // Si ya existe un registro, actualiza la deuda con el nuevo valor
    $sql_update = "UPDATE deudores SET nombre_cliente = ?, direccion = ?, cantidad_deuda = ? WHERE id_cliente = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssdi", $cliente, $direccion, $total, $id_cliente);

    if ($stmt_update->execute()) {
        echo json_encode(['success' => true, 'action' => 'updated']);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt_update->error]);
    }

    $stmt_update->close();
} else {
    // Si no existe un registro, inserta uno nuevo
    $sql_insert = "INSERT INTO deudores (id_cliente, nombre_cliente, direccion, cantidad_deuda) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("issd", $id_cliente, $cliente, $direccion, $total);

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
