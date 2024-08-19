<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Registrar Factura</title>
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
                <h3 class="card-title">Registrar Factura</h3>
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

                <form method="post" action="guardar_factura.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="monto">Monto:</label>
                    <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                  </div>
                  <div class="form-group">
                    <label for="fecha">Fecha de la factura:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                  </div>

                  <div class="form-group">
                    <label for="documento">Subir documento de factura:</label>
                    <input type="file" class="form-control-file" id="documento" name="documento" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Obtener la fecha actual en formato YYYY-MM-DD ajustada a GMT-6
                    const hoy = new Date();
                    hoy.setHours(hoy.getHours() - 6); // Ajuste para GMT-6
                    const hoyISO = hoy.toISOString().split('T')[0];

                    // Configurar la fecha mínima del campo de fecha
                    document.getElementById('fecha').setAttribute('min', hoyISO);
                });
                </script>

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
