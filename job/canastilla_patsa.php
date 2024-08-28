<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Canastilla de patsa</title>
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

  <!-- Contenido Principal -->
  <div class="content-wrapper">
    <!-- Contenido Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title">Registrar Canastilla de patsa</h3>
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

                <form method="post" action="guardar_datos.php">
                  <div class="form-group">
                    <label for="caja">Caja:</label>
                    <input type="text" class="form-control" id="caja" name="caja" required>
                  </div>
                  <div class="form-group">
                    <label for="tapa">Tapa:</label>
                    <input type="text" class="form-control" id="tapa" name="tapa" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

              </div>
            </div>
          </div>


          <!-- Nuevo Cuadro "Cajas Recibidas" -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Cajas Recibidas</h3>
    </div>
    <div class="card-body">
      <?php
      // Verificar si hay un mensaje de éxito o error en la URL
      if (isset($_GET['mensaje_exito_recibida'])) {
          $mensaje_exito = $_GET['mensaje_exito_recibida'];
          echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
      } elseif (isset($_GET['mensaje_error_recibida'])) {
          $mensaje_error = $_GET['mensaje_error_recibida'];
          echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
      }
      ?>

      <form method="post" action="guardar_cajas_recibidas.php">
        <div class="form-group">
          <label for="caja_recibida">Caja:</label>
          <input type="text" class="form-control" id="caja_recibida" name="caja_recibida" required>
        </div>
        <div class="form-group">
          <label for="tapa_recibida">Tapa:</label>
          <input type="text" class="form-control" id="tapa_recibida" name="tapa_recibida" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Recibida</button>
      </form>
    </div>
  </div>
</div>


<!-- Sección de Caja Enviada -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Caja Enviada</h3>
    </div>
    <div class="card-body">
      <?php
      // Verificar si hay un mensaje de éxito o error en la URL para Caja Enviada
      if (isset($_GET['mensaje_exito_enviada'])) {
          $mensaje_exito = $_GET['mensaje_exito_enviada'];
          echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
      } elseif (isset($_GET['mensaje_error_enviada'])) {
          $mensaje_error = $_GET['mensaje_error_enviada'];
          echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
      }
      ?>

      <form method="post" action="guardar_caja_enviada.php">
        <div class="form-group">
          <label for="caja_enviada">Caja:</label>
          <input type="text" class="form-control" id="caja_enviada" name="caja_enviada" required>
        </div>
        <div class="form-group">
          <label for="tapa_enviada">Tapa:</label>
          <input type="text" class="form-control" id="tapa_enviada" name="tapa_enviada" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Enviada</button>
      </form>
    </div>
  </div>
</div>

<!-- Cuadro "Canastilla Actual" -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Canastilla Actual</h3>
    </div>
    <div class="card-body">
      <?php
      // Incluir el archivo de conexión
      include '../config/conexion.php';

      // Obtener los datos actuales de la canastilla
      $sql_canastilla = "SELECT caja, tapa FROM canastilla WHERE id = 1"; // Ajusta el WHERE según tu caso
      $resultado = $conn->query($sql_canastilla);

      if ($resultado->num_rows > 0) {
          // Obtener los datos de la canastilla
          $fila = $resultado->fetch_assoc();
          $caja_actual = $fila['caja'];
          $tapa_actual = $fila['tapa'];
          echo '<p><strong>Caja Actual:</strong> ' . $caja_actual . '</p>';
          echo '<p><strong>Tapa Actual:</strong> ' . $tapa_actual . '</p>';
      } else {
          echo '<p>No se encontraron datos para la canastilla.</p>';
      }

      $conn->close();
      ?>
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

