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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inventario</h3>
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
      </div>
    </section>
  </div>

<!-- Modal de Edición -->
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

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
  </script>
</body>
</html>

<?php
$conn->close();
?>