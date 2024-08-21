<?php
include '../config/conexion.php';

$query = "
    SELECT CONCAT('prod_', id) as id, nombre FROM productos
    UNION
    SELECT CONCAT('men_', id) as id, nombre FROM productos_menudencia
";

$result = mysqli_query($conn, $query);

$productos = array();

while($row = mysqli_fetch_assoc($result)) {
    $productos[] = $row;
}

echo json_encode($productos);
?>
