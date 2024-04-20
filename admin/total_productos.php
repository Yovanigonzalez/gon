<?php
// Incluir el archivo de conexión a la base de datos
include 'menu.php'; // Incluir el menú

// Conectar a la base de datos
include '../config/conexion.php';

// Definir la consulta SQL inicial para obtener todos los productos
$sql = "SELECT * FROM productos";

// Verificar si se realiza una búsqueda
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Agregar condición WHERE para la búsqueda
    $sql .= " WHERE nombre LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu Tienda | Productos</title>
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
                <h3 class="card-title">Productos</h3>
              </div>
              <div class="card-body">
                <!-- Formulario de búsqueda -->
                <form action="" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar productos" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered">
                  <thead>
                  <?php
                    // Verificar si hay un mensaje de éxito
                    if(isset($_GET['success']) && $_GET['success'] == 1) {
                        echo "<p class='alert alert-success'>¡El producto se ha actualizado correctamente!</p>";
                    }
                    // Verificar si hay un mensaje de error
                    if(isset($_GET['error']) && $_GET['error'] == 1) {
                        echo "<p class='alert alert-danger'>Ocurrió un error al actualizar el producto. Por favor, inténtalo de nuevo.</p>";
                    }
                    ?>

                    <tr>
                      <!--<th>ID</th>-->
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        //echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>
                              <a href='editar_producto.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Editar</a>
                              <a href='eliminar_producto.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\")'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='3'>No se encontraron productos</td></tr>";
                    }
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

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
