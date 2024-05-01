<?php
// Establecer la conexión con la base de datos (ajusta los detalles según tu configuración)
include '../config/conexion.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error a excepción para que PDO lance excepciones en lugar de emitir advertencias
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID del cliente y la dirección del cliente del parámetro GET
    $idCliente = $_GET['idCliente'];
    $direccionCliente = $_GET['direccionCliente'];

    // Preparar la consulta SQL para obtener la deuda de cajas y tapas del cliente seleccionado
    $stmt = $conn->prepare("SELECT cantidad_cajas, cantidad_tapas FROM deudores_cajas WHERE id_cliente = :idCliente AND direccion = :direccionCliente");
    $stmt->bindParam(':idCliente', $idCliente);
    $stmt->bindParam(':direccionCliente', $direccionCliente);
    $stmt->execute();

    // Obtener los resultados de la consulta
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los resultados como JSON
    echo json_encode($result);
} catch(PDOException $e) {
    // Manejar errores de conexión o consulta
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión con la base de datos
$conn = null;
?>
