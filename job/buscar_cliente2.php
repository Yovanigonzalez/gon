<?php
include '../config/conexion.php';

if(isset($_POST['query'])){
    $query = $_POST['query'];
    $stmt = $conexion->prepare("SELECT nombre, direccion FROM clientes WHERE nombre LIKE ?");
    $stmt->bind_param("s", $query_like);
    $query_like = "%".$query."%";
    $stmt->execute();
    $result = $stmt->get_result();

    $clientes = array();
    while($row = $result->fetch_assoc()){
        $clientes[] = $row;
    }
    echo json_encode($clientes);
}
?>
