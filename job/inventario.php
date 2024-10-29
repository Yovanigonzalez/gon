<?php
include 'menu.php'; // Incluir el menú
?>
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
          <div class="col-md-6">
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
                      <th>Piezas</th>
                      <th>Kilos</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows > 0): ?>
                      <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><?php echo $row['producto_nombre']; ?></td>
                          <td><?php echo $row['stock']; ?></td>
                          <td><?php echo $row['kilos']; ?></td>
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

          <!-- Nueva sección para Producto (Menudencia) -->
          <div class="col-md-6">
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
                  } elseif (isset($_GET['mensaje_error_editar2'])) {
                      $mensaje_error_editar2 = $_GET['mensaje_error_editar2']; 
                      echo '<div class="alert alert-danger">' . $mensaje_error_editar2 . '</div>'; 
                  }
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Kilos</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result_menudencia->num_rows > 0): ?>
                      <?php while($row_menudencia = $result_menudencia->fetch_assoc()): ?>
                        <tr>
                          <td><?php echo $row_menudencia['producto_nombre']; ?></td>
                          <td><?php echo $row_menudencia['kilos']; ?></td>
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
        </div> <!-- Cierre de la fila 'row' -->
      </div>
    </section>
  </div>

  <!-- Bootstrap 4 JS -->
  <script src="../job_js/a.js"></script>
  <script src="../job_js/a2.js"></script>
</body>
</html>

<?php
$conn->close();
?>
