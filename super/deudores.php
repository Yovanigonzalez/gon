<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Deudores</title>
  <!-- Agregar estilos CSS aquí -->
  <link rel="stylesheet" href="styles.css">
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
                <h3 class="card-title" id="title">Agregar Cliente a Deudas</h3>
              </div>
              <!-- Formulario para agregar clientes -->
              <form class="card-body" method="post" action="guardar_deudor.php">
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

                <div class="form-group">
                  <label for="nombreCliente">Nombre del cliente:</label>
                  <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Ingrese el nombre del cliente" oninput="buscarCliente(this.value)" required>
                  <div id="resultadoBusqueda"></div> <!-- Aquí se mostrarán los resultados de la búsqueda -->
                  <input type="hidden" id="idCliente" name="idCliente"> <!-- Campo oculto para el ID del cliente seleccionado -->
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección del cliente" readonly style="background-color: #f2f2f2;">
                </div>

                <div class="form-group">
                    <label for="cantidadDeuda">Cantidad de deuda:</label>
                    <input type="number" step="0.01" class="form-control" id="cantidadDeuda" name="cantidadDeuda" placeholder="Ingrese la cantidad de deuda" required>
                </div>

                <button type="submit" class="btn btn-primary" id="submitButton">Agregar Cliente</button>
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

  <!-- Footer -->

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Script de búsqueda en tiempo real -->
<script>
    function buscarCliente(str) {
        if (str.length == 0) {
            document.getElementById("resultadoBusqueda").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("resultadoBusqueda").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "buscar_cliente.php?q=" + str, true);
            xmlhttp.send();
        }
    }

    function seleccionarCliente(id, nombre, direccion) {
        document.getElementById("idCliente").value = id;
        document.getElementById("nombreCliente").value = nombre;
        document.getElementById("direccion").value = direccion;
        document.getElementById("resultadoBusqueda").innerHTML = ""; // Limpiar resultados
    }
</script>

</body>
</html>
