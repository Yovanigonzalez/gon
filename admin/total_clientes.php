<?php
// Incluir el archivo de conexión a la base de datos
include 'menu.php'; // Incluir el menú

// Conectar a la base de datos
include '../config/conexion.php';

// Consulta SQL para obtener todos los clientes
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Clientes</title>
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
                  <?php
                    // Verificar si hay un mensaje de éxito
                    if(isset($_GET['success']) && $_GET['success'] == 1) {
                        echo "<p class='alert alert-success'>¡El cliente se ha actualizado correctamente!</p>";
                    }
                    // Verificar si hay un mensaje de error
                    if(isset($_GET['error']) && $_GET['error'] == 1) {
                        echo "<p class='alert alert-danger'>Ocurrió un error al actualizar el cliente. Por favor, inténtalo de nuevo.</p>";
                    }
                    ?>

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
                              <a href='editar_cliente.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Editar</a>
                              <a href='eliminar_cliente.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este cliente?\")'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='4'>No se encontraron clientes</td></tr>";
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
  <!-- Bootstrap 4 JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>
</body>
</html>


