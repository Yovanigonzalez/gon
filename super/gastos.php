<?php
// Incluir el archivo de conexión a la base de datos
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Gastos</title>
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
                <h3 class="card-title">Gastos registrados</h3>
              </div>
              <div class="card-body">

                <!-- Selector de Fechas (solo fechas únicas) -->
                <form id="form-fecha">
                  <label for="fecha">Seleccionar fecha:</label>
                  <select id="selectorGastos">
    <option value="">Seleccionar fecha</option>
    <?php include 'obtener_fechas_gastos.php'; ?>
</select>

<!-- Tabla para mostrar los gastos -->
<div class="card-body">
    <table class="table table-bordered" id="gastosTabla">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
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
  <!-- Bootstrap 4 JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>  
<script>
    $(document).ready(function() {
    $('#selectorGastos').change(function() {
        var fechaSeleccionada = $(this).val();
        if (fechaSeleccionada) {
            $.ajax({
                type: "POST",
                url: "obtener_datos_gastos.php",
                data: { fecha: fechaSeleccionada },
                success: function(data) {
                    $('#gastosTabla tbody').html(data); // Cargar los resultados en la tabla
                }
            });
        } else {
            $('#gastosTabla tbody').html(''); // Limpiar la tabla si no hay fecha seleccionada
        }
    });
});

</script>

</body>
</html>
