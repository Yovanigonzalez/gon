<?php
// Establecer la conexión con la base de datos
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los nombres y direcciones de los clientes
$sql = "SELECT nombre, direccion FROM clientes";
$result = $conn->query($sql);
?>

<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Clientes</title>
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
          <div class="col-md-6">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title">Clientes</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["direccion"] . "</td>";
                        echo "<td>
                              <a href='detalles_completos_cliente.php?nombre=" . $row["nombre"] . "&direccion=" . $row["direccion"] . "' class='btn btn-primary btn-sm'>Más detalles</a>
                              </td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='3'>No se encontraron clientes</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
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

