<?php include 'menu.php'; ?>

<?php
// Establecer la conexión con la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ajustar la zona horaria a GMT-6
date_default_timezone_set('America/Mexico_City');

// Obtener la fecha actual en formato YYYY-MM-DD
$fecha_actual = date("Y-m-d");

// Consulta SQL para obtener los pedidos pendientes de hoy
$sql = "SELECT id, cliente, direccion FROM pedidos WHERE fecha = '$fecha_actual' AND estatus = 'PENDIENTE'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Pedidos Pendientes</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .alert-success {
    border-radius: 50px;
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
  }

  .alert-danger {
    border-radius: 50px;
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}
  </style>
  
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
                <h3 class="card-title">Pedidos Pendientes de Hoy</h3>
              </div>
              <div class="card-body">
                <?php
                // Verificar si hay un mensaje de éxito o error en la URL
                if (isset($_GET['mensaje_exito'])) {
                    $mensaje_exito = $_GET['mensaje_exito'];
                    echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
                } elseif (isset($_GET['mensaje_error'])) {
                    $mensaje_error = $_GET['mensaje_error'];
                    echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                }
                ?>

                <form method="post" action="actualizar_pedido.php">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row["cliente"] . "</td>";
                          echo "<td>" . $row["direccion"] . "</td>";
                          echo "<td>
                                <a href='detalles_completos_cliente.php?nombre=" . urlencode($row["cliente"]) . "&direccion=" . urlencode($row["direccion"]) . "' class='btn btn-primary btn-sm'>Detalles</a>
                                <form method='post' style='display:inline;' action='actualizar_pedido.php'>
                                  <input type='hidden' name='pedido_id' value='" . $row["id"] . "'>
                                  <button type='submit' name='atendido' class='btn btn-success btn-sm'>Atendido</button>
                                </form>
                                </td>";
                          echo "</tr>";
                        }
                      } else {
                        echo "<tr><td colspan='3'>No se encontraron pedidos pendientes para hoy</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>

