<?php
// Incluir el archivo de conexión a la base de datos

include 'menu.php';

include '../config/conexion.php';

// Verificar si se ha proporcionado un ID de cliente válido en la URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $cliente_id = $_GET['id'];
    
    // Consulta SQL para obtener los detalles del cliente con el ID proporcionado
    $sql = "SELECT * FROM clientes WHERE id = $cliente_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // Se encontró el cliente, recuperar sus detalles
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $direccion = $row['direccion'];
        
        // Mostrar el formulario de edición con los detalles del cliente
        ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Clientes</title>
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
                <h3 class="card-title" id="title">Editar Cliente</h3>
              </div>
              <!-- Formulario para agregar clientes -->
                <!-- Formulario para agregar clientes -->
                <form class="card-body" action="actualizar_cliente.php" method="post">
                    <input type="hidden" name="cliente_id" value="<?php echo $cliente_id; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <?php
    } else {
        echo "Cliente no encontrado.";
    }
} else {
    echo "ID de cliente no proporcionado.";
}
?>
