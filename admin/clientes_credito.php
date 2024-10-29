<?php
// Incluir el archivo de conexión a la base de datos
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Clientes crédito</title>
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
                <h3 class="card-title">Cliente a credito</h3>
              </div>
              <div class="card-body">
                <!-- Formulario de búsqueda -->
                <form action="" method="GET" class="mb-3">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar cliente a credito" name="search">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                  </div>
                </form>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Direccion</th>
                      <th>Total de deuda</th>
                    </tr>
                  </thead>
                  <tbody id="clientes-deuda">
                    <?php
                    // Conexión a la base de datos
                    include '../config/conexion.php';
                    // Verificar la conexión
                    if ($conn->connect_error) {
                      die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Verificar si hay un término de búsqueda
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Consulta SQL
                    $sql = "SELECT nombre_cliente, direccion, cantidad_deuda FROM deudores WHERE nombre_cliente LIKE '%$search%'";
                    $result = $conn->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                      // Mostrar resultados
                      while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_cliente'] . "</td>";
                        echo "<td>" . $row['direccion'] . "</td>";
                        echo "<td class='cantidad-deuda'>" . $row['cantidad_deuda'] . "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='3'>No se encontraron clientes</td></tr>";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
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

  <!-- Script para formatear los números -->
  <script>
    // Seleccionar todas las celdas que contienen deudas
    const deudas = document.querySelectorAll('.cantidad-deuda');

    deudas.forEach(function(deuda) {
      // Obtener el valor actual y convertirlo a número
      const valorDeuda = parseFloat(deuda.textContent);
      
      // Formatear el número con separadores de miles (coma) y punto para decimales
      deuda.textContent = valorDeuda.toLocaleString('en-US', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    });
  </script>

  <!-- Bootstrap 4 JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>

</body>
</html>
