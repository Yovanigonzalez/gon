<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Usuarios</title>
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
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Agregar Usuario</h3>
              </div>
              <form class="card-body" method="post" action="guardar_usuario.php">
                <?php
                // Verificar si hay un mensaje de éxito o error en la URL para agregar usuario
                if (isset($_GET['mensaje_exito_agregar'])) {
                    $mensaje_exito_agregar = $_GET['mensaje_exito_agregar'];
                    echo '<div class="alert alert-success">' . $mensaje_exito_agregar . '</div>';
                } elseif (isset($_GET['mensaje_error_agregar'])) {
                    $mensaje_error_agregar = $_GET['mensaje_error_agregar'];
                    echo '<div class="alert alert-danger">' . $mensaje_error_agregar . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese el correo electrónico" required>
                </div>

                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese la contraseña" required>
                </div>

                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="" disabled selected>Seleccione un rol</option>
                        <option value="admin">Admin</option>
                        <option value="empleado">Empleado</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" id="submitButton">Agregar Usuario</button>
              </form>
            </div>

          </div>
          <!-- Columna para Eliminar Usuario -->
          <div class="col-md-6">
            <div class="card card-white mt-4">
              <div class="card-header">
                <h3 class="card-title" id="title">Eliminar Usuario</h3>
              </div>
              <form class="card-body" method="post" action="eliminar_usuario.php">
                <?php
                // Verificar si hay un mensaje de éxito o error en la URL para eliminar usuario
                if (isset($_GET['mensaje_exito_eliminar'])) {
                    $mensaje_exito_eliminar = $_GET['mensaje_exito_eliminar'];
                    echo '<div class="alert alert-success">' . $mensaje_exito_eliminar . '</div>';
                } elseif (isset($_GET['mensaje_error_eliminar'])) {
                    $mensaje_error_eliminar = $_GET['mensaje_error_eliminar'];
                    echo '<div class="alert alert-danger">' . $mensaje_error_eliminar . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="usuario_id">Seleccionar Usuario a Eliminar:</label>
                    <select class="form-control" id="usuario_id" name="usuario_id" required>
                        <option value="" disabled selected>Seleccione un usuario</option>
                        <?php
                        // Conectar a la base de datos
                        include '../config/conexion.php';
                        
                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Obtener usuarios
                        $sql = "SELECT id, correo FROM usuarios";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Salida de cada fila
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['correo'] . '</option>';
                            }
                        } else {
                            echo '<option disabled>No hay usuarios disponibles</option>';
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger" id="deleteButton">Eliminar Usuario</button>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
