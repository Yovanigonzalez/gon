<?php
// Incluir el archivo de conexión a la base de datos
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Dinero recaudado</title>
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
                <h3 class="card-title">Dinero recaudado</h3>
              </div>
              <div class="card-body">

                <!-- Selector de Fechas (solo fechas únicas) -->
                <form id="form-fecha">
                  <label for="fecha">Seleccionar fecha:</label>
                  <select id="fecha" name="fecha" class="form-control">
                    <!-- Aquí se cargarán las fechas únicas desde la base de datos -->
                  </select>
                </form>

                <!-- Tabla de resultados -->
                <table class="table table-bordered mt-4">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Recaudado</th>
                    </tr>
                  </thead>
                  <tbody id="tabla-resultados">
                    <!-- Aquí se mostrarán los resultados -->
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
  
  <script>
    $(document).ready(function() {
      // Obtener las fechas únicas desde la base de datos y cargarlas en el selector
      $.ajax({
        url: 'obtener_fechas.php',
        method: 'GET',
        success: function(response) {
          $('#fecha').html(response);

          // Cargar los datos automáticamente para la primera fecha (el día actual)
          var fechaActual = $('#fecha').val();
          cargarDatos(fechaActual);
        }
      });

      // Cuando se cambie la fecha en el selector
      $('#fecha').change(function() {
        var fechaSeleccionada = $(this).val();
        cargarDatos(fechaSeleccionada);
      });

      // Función para cargar los datos filtrados por la fecha
      function cargarDatos(fecha) {
        $.ajax({
          url: 'obtener_datos_por_fecha.php',
          method: 'POST',
          data: { fecha: fecha },
          success: function(response) {
            $('#tabla-resultados').html(response);
          }
        });
      }
    });
  </script>

</body>
</html>
