<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nuevo_nombre = $_POST['nombre'];
    $tabla = $_POST['tabla'];

    // Actualizar el nombre del producto en la tabla correspondiente
    $sql = "UPDATE $tabla SET nombre='$nuevo_nombre' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de productos con un mensaje de éxito
        header("Location: total_productos?success=1");
        exit();
    } else {
        // Si ocurre un error, redirigir de vuelta a la página de productos con un mensaje de error
        header("Location: total_productos?error=1");
        exit();
    }
}

// Obtener el ID del producto y la tabla desde la URL
if (isset($_GET['id']) && isset($_GET['tabla'])) {
    $id_producto = $_GET['id'];
    $tabla = $_GET['tabla'];

    // Obtener los detalles del producto de la tabla correspondiente
    $sql = "SELECT nombre FROM $tabla WHERE id=$id_producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_producto = $row['nombre'];
    } else {
        // Si no se encuentra el producto, redirigir de vuelta a la página de productos con un mensaje de error
        header("Location: total_productos?error=1");
        exit();
    }
} else {
    // Si no se proporciona un ID de producto o una tabla válida, redirigir de vuelta a la página de productos con un mensaje de error
    header("Location: total_productos?error=1");
    exit();
}
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Editar Producto</title>
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
                <h3 class="card-title" id="title">Editar Producto</h3>
              </div>
              <!-- Formulario para editar productos -->
              <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $id_producto; ?>">
                        <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <!-- Utilizamos JavaScript para convertir automáticamente el texto a mayúsculas -->
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_producto; ?>" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->

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




