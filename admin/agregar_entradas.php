<?php include 'menu.php'; ?>

<?php
// Conexión a la base de datos
include '../config/conexion.php';

// Consulta para obtener todos los productos de pollo
$query = "SELECT id, nombre FROM productos";
$result = $conn->query($query);

// Consulta para obtener todos los productos de menudencia
$query_menudencia = "SELECT id, nombre FROM productos_menudencia";
$result_menudencia = $conn->query($query_menudencia);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribuidora | Entradas</title>
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
        <!-- Barra de navegación y sidebar aquí -->

        <!-- Contenido principal -->
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Cuadro para Agregar Entradas (Pollo) -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Agregar Entradas (Pollo)</h3>
                                </div>

                                <div class="card-body">
                                    <!-- Mostrar mensaje de éxito o error si existe -->
                                    <?php
                                    if (isset($_GET['pollo_success'])) {
                                        if ($_GET['pollo_success'] === 'true') {
                                            echo '<div class="alert alert-success" role="alert">Los datos se han guardado correctamente.</div>';
                                        } elseif ($_GET['pollo_success'] === 'false') {
                                            echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . htmlspecialchars($_GET['pollo_error_message']) . '</div>';
                                        }
                                    }
                                    ?>

                                    <form method="post" action="guardar_entradas.php">
                                        <!-- Seleccionar Producto -->
                                        <div class="form-group">
                                            <label class="form-label" for="producto">Producto:</label>
                                            <select class="form-control" name="producto" id="producto">
                                                <option value="" disabled selected>Selecciona un producto</option>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No hay productos disponibles</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Stock -->
                                        <div class="form-group">
                                            <label class="form-label" for="stock">Piezas:</label>
                                            <input type="number" class="form-control" name="stock" id="stock" min="0" required>
                                        </div>

                                        <!-- Kilos -->
                                        <div class="form-group">
                                            <label class="form-label" for="kilos">Kilos:</label>
                                            <input type="number" class="form-control" name="kilos" id="kilos" min="0" step="0.01" required>
                                        </div>
                                        
                                        <!-- Botón para agregar entrada -->
                                        <button type="submit" class="btn btn-primary">Agregar entrada</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Cuadro para Agregar Entradas (Menudencia) -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Agregar Entradas (Menudencia)</h3>
                                </div>

                                <div class="card-body">
                                    <!-- Mostrar mensaje de éxito o error si existe -->
                                    <?php
                                    if (isset($_GET['menudencia_success'])) {
                                        if ($_GET['menudencia_success'] === 'true') {
                                            echo '<div class="alert alert-success" role="alert">Los datos se han guardado correctamente.</div>';
                                        } elseif ($_GET['menudencia_success'] === 'false') {
                                            echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . htmlspecialchars($_GET['menudencia_error_message']) . '</div>';
                                        }
                                    }
                                    ?>

                                    <form method="post" action="guardar_entradas_menudencia.php">
                                        <!-- Seleccionar Producto -->
                                        <div class="form-group">
                                            <label class="form-label" for="producto_menudencia">Producto:</label>
                                            <select class="form-control" name="producto_menudencia" id="producto_menudencia">
                                                <option value="" disabled selected>Selecciona un producto</option>
                                                <?php
                                                if ($result_menudencia->num_rows > 0) {
                                                    while($row_menudencia = $result_menudencia->fetch_assoc()) {
                                                        echo '<option value="' . $row_menudencia['id'] . '">' . $row_menudencia['nombre'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No hay productos disponibles</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Kilos -->
                                        <div class="form-group">
                                            <label class="form-label" for="kilos_menudencia">Kilos:</label>
                                            <input type="number" class="form-control" name="kilos_menudencia" id="kilos_menudencia" min="0" step="0.01" required>
                                        </div>

                                        <!-- Botón para agregar entrada -->
                                        <button type="submit" class="btn btn-primary">Agregar entrada</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
