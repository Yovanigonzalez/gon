<?php
include '../config/conexion.php';

$query = "
    SELECT id, nombre FROM productos
    UNION
    SELECT id, nombre FROM productos_menudencia
";

$result = mysqli_query($conn, $query);

$productos = array();

while($row = mysqli_fetch_assoc($result)) {
    $productos[] = $row;
}

echo json_encode($productos);
?>
