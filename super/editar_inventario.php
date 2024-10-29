<?php 
// Establecer conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla 'entradas'
$sql = "SELECT * FROM entradas";
$result = $conn->query($sql);

// Obtener los datos de la tabla 'entradas_menudencia'
$sql_menudencia = "SELECT * FROM entradas_menudencia";
$result_menudencia = $conn->query($sql_menudencia);
?>
<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Editar inventario</title>
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
          <div class="col-md-10">
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inventario (Pollo)</h3>
              </div>
              <div class="card-body">
                <?php
                  // Verificar si hay un mensaje de éxito o error en la URL
                  if (isset($_GET['mensaje_exito_editar'])) {
                      $mensaje_exito_editar = $_GET['mensaje_exito_editar']; 
                      echo '<div class="alert alert-success">' . $mensaje_exito_editar . '</div>'; 
                  } elseif (isset($_GET['mensaje_error_editar'])) {
                      $mensaje_error_editar = $_GET['mensaje_error_editar']; 
                      echo '<div class="alert alert-danger">' . $mensaje_error_editar . '</div>'; 
                  }
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre del Producto</th>
                      <th>Stock</th>
                      <th>Kilos</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows > 0): ?>
                      <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><?php echo $row['producto_nombre']; ?></td>
                          <td><?php echo $row['stock']; ?></td>
                          <td><?php echo $row['kilos']; ?></td>
                          <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>" data-stock="<?php echo $row['stock']; ?>" data-kilos="<?php echo $row['kilos']; ?>">Editar</button>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4">No hay datos disponibles</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Nueva sección para Producto (Menudencia) -->
        <div class="col-md-10">
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Producto (Menudencia)</h3>
              </div>
              <div class="card-body">
              <?php
                  // Verificar si hay un mensaje de éxito o error en la URL
                  if (isset($_GET['mensaje_exito_editar2'])) {
                      $mensaje_exito_editar2 = $_GET['mensaje_exito_editar2']; 
                      echo '<div class="alert alert-success">' . $mensaje_exito_editar2 . '</div>'; 
                  } elseif (isset($_GET['mensaje_error_editar'])) {
                      $mensaje_error_editar2 = $_GET['mensaje_error_editar2']; 
                      echo '<div class="alert alert-danger">' . $mensaje_error_editar2 . '</div>'; 
                  }
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Kilos</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result_menudencia->num_rows > 0): ?>
                      <?php while($row_menudencia = $result_menudencia->fetch_assoc()): ?>
                        <tr>
                          <td><?php echo $row_menudencia['producto_nombre']; ?></td>
                          <td><?php echo $row_menudencia['kilos']; ?></td>
                          <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editMenudenciaModal" data-id="<?php echo $row_menudencia['id']; ?>" data-kilos="<?php echo $row_menudencia['kilos']; ?>">Editar</button>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="3">No hay datos disponibles</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Modal de Edición para Inventario -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="post" action="editar.php">
                <div class="modal-body">
                    <input type="hidden" id="productoId" name="productoId">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" step="1" placeholder="Ingrese el nuevo stock (dejar en blanco si no desea cambiar)">
                    </div>
                    <div class="form-group">
                        <label for="kilos">Kilos</label>
                        <input type="number" class="form-control" id="kilos" name="kilos" step="0.01" placeholder="Ingrese los nuevos kilos (dejar en blanco si no desea cambiar)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Modal de Edición para Menudencia -->
  <div class="modal fade" id="editMenudenciaModal" tabindex="-1" role="dialog" aria-labelledby="editMenudenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenudenciaModalLabel">Editar Producto (Menudencia)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMenudenciaForm" method="post" action="editar_menudencia.php">
                <div class="modal-body">
                    <input type="hidden" id="menudenciaId" name="menudenciaId">
                    <div class="form-group">
                        <label for="kilos">Kilos</label>
                        <input type="number" class="form-control" id="menudenciaKilos" name="kilos" step="0.01" placeholder="Ingrese los nuevos kilos (dejar en blanco si no desea cambiar)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Bootstrap 4 JS -->
  <script src="../job_js/a.js"></script>
  <script src="../job_js/a2.js"></script>
  <script>
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var stock = button.data('stock');
      var kilos = button.data('kilos');

      var modal = $(this);
      modal.find('#productoId').val(id);
      modal.find('#stock').val(stock);
      modal.find('#kilos').val(kilos);
    });

    $('#editMenudenciaModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var kilos = button.data('kilos');

      var modal = $(this);
      modal.find('#menudenciaId').val(id);
      modal.find('#menudenciaKilos').val(kilos);
    });
  </script>
</body>
</html>

<?php
$conn->close();
?>
