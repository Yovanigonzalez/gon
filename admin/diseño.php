<?php
include 'menu.php'; // Incluir el menú
?>

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


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Clientes</title>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Contenido Principal. Contiene el contenido de la página -->
  <div class="content-wrapper">
    <!-- Contenido Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Detalles de Pedidos</h3>
              </div>
              <!-- Formulario para agregar clientes -->
    <table class="table">
      <thead class="thead-dark">
        <tr>
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

            </div>
            <!-- /.card -->

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->

  <!-- Bootstrap 4 JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>
</body>
</html>
<?php
// Cerrar conexión
$conn->close();
?>
