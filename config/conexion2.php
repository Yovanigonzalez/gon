<?php
// Establecer conexión a la base de datos
$servername = "localhost";
$username = "rodrisof_2";
$password = "rodrisof_distribuidora";
$dbname = "rodrisof_2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
