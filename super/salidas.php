<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Salidas</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
      $(function() {
          $("#fechaInicio, #fechaFin").datepicker({
              dateFormat: 'yy-mm-dd'
          });
      });
  </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Salidas</h3>
              </div>
              <div class="card-body">

                <form method="post" action="generar_pdf">
                    <div class="form-group">
                        <label for="fechaInicio">Fecha Inicio:</label>
                        <input type="text" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fechaFin">Fecha Fin:</label>
                        <input type="text" class="form-control" id="fechaFin" name="fechaFin" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Descargar Informe</button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</body>
</html>


