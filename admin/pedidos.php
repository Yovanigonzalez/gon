<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Pedidos</title>
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
                <h3 class="card-title" id="title">Agregar Pedidos</h3>
              </div>
              <!-- Formulario para agregar pedidos -->
              <form class="card-body" action="procesar_pedido.php" method="post">
                <div class="form-group">
                  <label for="cliente">Cliente:</label>
                  <input type="text" id="cliente" name="cliente" class="form-control" oninput="buscarClientes()">
                  <div id="lista-clientes"></div>
                </div>
                <div class="form-group">
                  <label for="direccion">Dirección:</label>
                  <input type="text" id="direccion" name="direccion" class="form-control">
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha:</label>
                  <input type="date" id="fecha" name="fecha" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="producto">Producto:</label>
                  <input type="text" id="producto" name="producto" class="form-control" required>
                  <!-- Lista de productos sugeridos -->
                  <div id="lista-productos"></div>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="text" id="cantidad" name="cantidad" class="form-control" pattern="[0-9a-zA-Z]*" title="Ingrese solo números o letras">
                </div>

                <button type="submit" class="btn btn-primary">Agregar Pedido</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="../js/pedidos.js"></script>

  <!-- Script para la búsqueda en tiempo real de productos -->

</body>
</html>


