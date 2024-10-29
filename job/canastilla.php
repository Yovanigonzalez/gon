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

    <!-- Campos para visualizar la deuda de cajas y tapas -->
    
    <div class="form-group">
        <label for="cajasDeuda">Cajas (deuda):</label>
        <input type="number" class="form-control" id="cajasDeuda" name="cajasDeuda" readonly style="background-color: #f2f2f2;" placeholder="Cajas que debe el cliente">
    </div>
    
    <div class="form-group">
        <label for="tapasDeuda">Tapas (deuda):</label>
        <input type="number" class="form-control" id="tapasDeuda" name="tapasDeuda" readonly style="background-color: #f2f2f2;" placeholder="Tapas que debe el cliente">
    </div>
    
    <!-- Campos para ingresar nuevas cantidades -->
    
    <div class="form-group">
        <label for="cajas">Cajas (nuevas):</label>
        <input type="number" step="1" class="form-control" id="cajas" name="cajas" placeholder="Ingrese la cantidad de cajas nuevas" required>
    </div>
    
    <div class="form-group">
        <label for="tapas">Tapas (nuevas):</label>
        <input type="number" step="1" class="form-control" id="tapas" name="tapas" placeholder="Ingrese la cantidad de tapas nuevas" required>
    </div>


                <button type="submit" class="btn btn-primary" id="submitButton">Agregar Cliente</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS en caso de fallar la recuperacion solo sera cambiar las llaves ya que el codigi estara en 'exception_job' -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>
    
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

    function seleccionarCliente(id, nombre, direccion, cajasDeuda, tapasDeuda) {
  // Asignar los datos del cliente
  $('#idCliente').val(id);
  $('#nombreCliente').val(nombre);
  $('#direccion').val(direccion);
  
  // Mostrar la deuda actual en los campos de solo lectura
  $('#cajasDeuda').val(cajasDeuda);  // Mostrar la deuda de cajas
  $('#tapasDeuda').val(tapasDeuda);  // Mostrar la deuda de tapas

  // Limpiar el resultado de la búsqueda
  $('#resultadoBusqueda').empty();
}

  </script>
</body>
</html>

