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

// Obtener la fecha y hora actual en la zona horaria de Puebla, México (GMT-6)
date_default_timezone_set('America/Mexico_City');
$fecha_actual = date('Y-m-d H:i:s');

// Consulta SQL para obtener los detalles de los pedidos con estatus "Pendiente" del mismo día en la zona horaria de Puebla, México (GMT-6)
$sql = "SELECT pedidos.id, pedidos.cliente, pedidos.direccion, pedidos.fecha, pedidos.estatus, pedido_lista.producto, pedido_lista.cantidad
        FROM pedidos
        INNER JOIN pedido_lista ON pedidos.id = pedido_lista.pedido_id
        WHERE pedidos.estatus = 'PENDIENTE'
        AND DATE(pedidos.fecha) = CURDATE()";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Detalles de pedidos</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" id="title">Detalles de Pedidos</h3>
              </div>
              <!-- Tabla de Pedidos -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Cambio</th>
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
                          echo "<td>" . $row["estatus"] . "</td>";
                          echo "<td>" . $row["producto"] . "</td>";
                          echo "<td>" . $row["cantidad"] . "</td>";
                          echo "<td>";
                          // Formulario para cambiar el estatus
                          echo "<form action='cambiar_estatus.php' method='post'>";
                          echo "<input type='hidden' name='pedido_id' value='" . $row['id'] . "'>";
                          echo "<select name='estatus' class='form-control'>";
                          echo "<option value='PENDIENTE'>PENDIENTE</option>";
                          echo "<option value='ATENDIDO'>ATENDIDO</option>";
                          echo "</select>";
                          echo "<button type='submit' class='btn btn-primary mt-2'>Cambiar</button>";
                          echo "</form>";
                          echo "</td>";
                          echo "</tr>";
                        }
                      } else {
                        echo "<tr><td colspan='7'>No hay pedidos pendientes registrados para hoy</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Cerrar conexión
$conn->close();
?>

