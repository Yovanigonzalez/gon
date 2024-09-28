<?php include 'menu.php'; ?>

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
      padding: 10px;
      margin-bottom: 15px;
    }

    .alert-danger {
      border-radius: 50px;
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
      padding: 10px;
      margin-bottom: 15px;
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
                <h3 class="card-title" id="title">Actualizar Deuda (Dinero)</h3>
              </div>
              <form class="card-body" method="post">
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
                    <label for="cantidadDeuda">Deuda del cliente:</label>
                    <input type="text" class="form-control" id="cantidadDeuda" name="cantidadDeuda" placeholder="Deuda del cliente" readonly style="background-color: #f2f2f2;">
                </div>
                <div class="form-group">
                    <label for="dineroRecibido">Dinero recibido:</label>
                    <input type="number" step="0.01" class="form-control" id="dineroRecibido" name="dineroRecibido" placeholder="Ingrese la cantidad de dinero recibido" required>
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
        url: 'buscar_cliente4.php',
        method: 'GET',
        data: { nombreCliente: valor },
        success: function(data) {
          $('#resultadoBusqueda').html(data);
        }
      });
    }

    function seleccionarCliente(id, nombre, direccion, cantidadDeuda) {
    $('#idCliente').val(id);
    $('#nombreCliente').val(nombre);
    $('#direccion').val(direccion);
    $('#cantidadDeuda').val(cantidadDeuda); // Nueva línea para mostrar la deuda
    $('#resultadoBusqueda').empty();

    // Captura el evento de click en el botón de enviar el formulario
    $('#submitButton').on('click', function(e) {
        e.preventDefault();
        
        const dineroRecibido = parseFloat($('#dineroRecibido').val()) || 0;
        
        // Enviar los datos a un script para guardarlos en la base de datos
        $.ajax({
            url: 'guardar_deuda_actualizada.php',
            method: 'POST',
            data: {
                idCliente: id,
                dineroRecibido: dineroRecibido, // Enviar el dinero recibido al script PHP
                fecha: new Date().toISOString().slice(0, 19).replace('T', ' ')
            },
            success: function(response) {
                window.location.href = '?mensaje_exito=Deuda actualizada exitosamente';
            },
            error: function() {
                window.location.href = '?mensaje_error=Error al actualizar la deuda';
            }
        });
    });
}

  </script>
</body>
</html>
