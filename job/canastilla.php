<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Canastilla</title>
  <link rel="stylesheet" href="styles.css">
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
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Actualizar Canastilla</h3>
              </div>
              <form class="card-body" method="post" action="process_form.php">
                <?php
                if (isset($_GET['mensaje_exito'])) {
                    $mensaje_exito = $_GET['mensaje_exito'];
                    echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
                } elseif (isset($_GET['mensaje_error'])) {
                    $mensaje_error = $_GET['mensaje_error'];
                    echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                }
                ?>
                <div class="form-group">
                  <label for="nombreCliente">Nombre del cliente:</label>
                  <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Ingrese el nombre del cliente" oninput="buscarCliente(this.value)" required>
                  <div id="resultadoBusqueda"></div>
                  <input type="hidden" id="idCliente" name="idCliente">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección del cliente" readonly style="background-color: #f2f2f2;">
                </div>
                <div class="form-group">
                    <label for="cajas">Cajas:</label>
                    <input type="number" step="1" class="form-control" id="cajas" name="cajas" placeholder="Ingrese la cantidad de cajas" required>
                </div>
                <div class="form-group">
                    <label for="tapas">Tapas:</label>
                    <input type="number" step="1" class="form-control" id="tapas" name="tapas" placeholder="Ingrese la cantidad de tapas" required>
                </div>
                <button type="submit" class="btn btn-primary" id="submitButton">Agregar Cliente</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script>
    function buscarCliente(valor) {
      if (valor.length === 0) {
        $('#resultadoBusqueda').empty();
        return;
      }
      
      $.ajax({
        url: 'buscar_cliente3.php',
        method: 'GET',
        data: { nombreCliente: valor },
        success: function(data) {
          $('#resultadoBusqueda').html(data);
        }
      });
    }

    function seleccionarCliente(id, nombre, direccion, cajas, tapas) {
      $('#idCliente').val(id);
      $('#nombreCliente').val(nombre);
      $('#direccion').val(direccion);
      $('#resultadoBusqueda').empty();

      // Calcula las nuevas cantidades
      const cantidadCajas = parseInt($('#cajas').val()) || 0;
      const cantidadTapas = parseInt($('#tapas').val()) || 0;

      $('#cajas').val(cantidadCajas);
      $('#tapas').val(cantidadTapas);
    }
  </script>
</body>
</html>

