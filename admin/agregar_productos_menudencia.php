<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Productos Menudencia</title>
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
          <div class="col-md-6">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Agregar Producto (Menudencia)</h3>
              </div>
              
              <!-- Formulario para agregar productos -->
              <form class="card-body" method="post" action="guardar_productos_menudencia.php">
                              <!-- Mostrar mensaje de éxito si está disponible -->
              <?php if (isset($_SESSION['mensaje_exito'])): ?>
              <div class="alert alert-success"><?php echo $_SESSION['mensaje_exito']; ?></div>
              <?php unset($_SESSION['mensaje_exito']); ?>
              <?php endif; ?>
              
              <!-- Mostrar mensaje de error si está disponible -->
              <?php if (isset($_SESSION['mensaje_error'])): ?>
              <div class="alert alert-danger"><?php echo $_SESSION['mensaje_error']; ?></div>
              <?php unset($_SESSION['mensaje_error']); ?>
              <?php endif; ?>

              <div class="form-group">
                  <label for="nombreProducto">Nombre del producto:</label>
                  <!-- Utilizamos JavaScript para convertir automáticamente el texto a mayúsculas -->
                  <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Ingrese el nombre del producto" oninput="this.value = this.value.toUpperCase()" required>
              </div>

                <button type="submit" class="btn btn-primary" id="submitButton">Agregar Producto</button>
            </form>
            </div>
            <!-- /.card -->

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
