<?php
// Incluir el archivo de conexión a la base de datos
include 'menu.php'; // Incluir el menú

// Conectar a la base de datos
include '../config/conexion.php';

// Definir la consulta SQL inicial para obtener todos los productos de ambas tablas
$sql = "SELECT id, nombre, 'productos' AS tabla FROM productos 
        UNION 
        SELECT id, nombre, 'productos_menudencia' AS tabla FROM productos_menudencia";

// Verificar si se realiza una búsqueda
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Agregar condición WHERE para la búsqueda en ambas tablas
    $sql = "SELECT id, nombre, 'productos' AS tabla FROM productos WHERE nombre LIKE '%$search%'
            UNION 
            SELECT id, nombre, 'productos_menudencia' AS tabla FROM productos_menudencia WHERE nombre LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Productos</title>

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
                  if (isset($_GET['success'])) {
                      if ($_GET['success'] == 1) {
                          echo "<p class='alert alert-success'>¡El producto se ha actualizado correctamente!</p>";
                      } elseif ($_GET['success'] == 2) {
                          echo "<p class='alert alert-success'>¡El producto se ha eliminado correctamente!</p>";
                      }
                  }

                  // Verificar si hay un mensaje de error
                  if (isset($_GET['error'])) {
                      if ($_GET['error'] == 1) {
                          echo "<p class='alert alert-danger'>Ocurrió un error al actualizar el producto. Por favor, inténtalo de nuevo.</p>";
                      } elseif ($_GET['error'] == 2) {
                          echo "<p class='alert alert-danger'>Ocurrió un error al eliminar el producto. Por favor, inténtalo de nuevo.</p>";
                      }
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
                        echo "<td>" . $row["nombre"] . "</td>";
                        // Pasar tanto el ID como la tabla de origen en los enlaces de edición y eliminación
                        echo "<td>
                              <a href='editar_producto?id=" . $row["id"] . "&tabla=" . $row["tabla"] . "' class='btn btn-primary btn-sm'>Editar</a>
                              <button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#confirmDeleteModal' data-id='" . $row["id"] . "' data-tabla='" . $row["tabla"] . "'>Eliminar</button>
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

  <!-- Modal de confirmación -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas eliminar este producto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Capturar el ID y la tabla cuando se abre el modal
    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var tabla = button.data('tabla');

      var deleteUrl = 'eliminar_producto?id=' + id + '&tabla=' + tabla;
      var modal = $(this);
      modal.find('#confirmDeleteButton').attr('href', deleteUrl);
    });
  </script>

</body>
</html>
