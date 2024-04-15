<?php
// Establecer la conexión con la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los detalles de los pedidos
$sql = "SELECT pedidos.id, pedidos.cliente, pedidos.direccion, pedidos.fecha, pedido_lista.producto, pedido_lista.cantidad
        FROM pedidos
        INNER JOIN pedido_lista ON pedidos.id = pedido_lista.pedido_id";

$result = $conn->query($sql);
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles de Pedidos</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Detalles de Pedidos</h2>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>ID del Pedido</th>
          <th>Cliente</th>
          <th>Dirección</th>
          <th>Fecha</th>
          <th>Producto</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["cliente"] . "</td>";
            echo "<td>" . $row["direccion"] . "</td>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "<td>" . $row["producto"] . "</td>";
            echo "<td>" . $row["cantidad"] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No hay pedidos registrados</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
