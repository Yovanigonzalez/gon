<?php include 'menu.php'; ?>

<?php
// Verificar si se ha proporcionado un nombre y una dirección de cliente
if (isset($_GET['nombre'], $_GET['direccion'])) {
    $nombre_cliente = $_GET['nombre'];
    $direccion_cliente = $_GET['direccion'];

    // Incluir el archivo de conexión a la base de datos
    include '../config/conexion.php';

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener los detalles de los pedidos del cliente con estatus "PENDIENTE" del mismo día
    $sql = "SELECT pedidos.id, pedidos.cliente, pedidos.direccion, pedidos.fecha, pedidos.estatus, pedido_lista.producto, pedido_lista.cantidad
            FROM pedidos
            INNER JOIN pedido_lista ON pedidos.id = pedido_lista.pedido_id
            WHERE pedidos.cliente = ? 
            AND pedidos.direccion = ? 
            AND DATE(pedidos.fecha) = CURDATE() 
            AND pedidos.estatus = 'PENDIENTE'";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta está preparada correctamente
    if ($stmt) {
        // Vincular parámetros
        $stmt->bind_param("ss", $nombre_cliente, $direccion_cliente);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener resultados
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Pedidos para <?php echo htmlspecialchars($nombre_cliente); ?></title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
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
                                <h3 class="card-title">Pedidos para: <?php echo htmlspecialchars($nombre_cliente); ?></h3>
                            </div>
                            <div class="card-body">
                               <!-- <p>Dirección: <?php echo htmlspecialchars($direccion_cliente); ?></p>-->
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <!--<th>ID</th>-->
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        //echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . htmlspecialchars($row["producto"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["cantidad"]) . "</td>";
                                        echo "</tr>";
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
</div>
<!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS en caso de fallar la recuperacion solo sera cambiar las llaves ya que el codigi estara en 'exception_job' -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>


</body>
</html>
<?php
        } else {
            echo "No se encontraron pedidos pendientes para " . htmlspecialchars($nombre_cliente) . " con dirección " . htmlspecialchars($direccion_cliente) . " hoy.";
        }

        // Cerrar el resultado
        $result->close();
    } else {
        echo "Error al preparar la consulta.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();

} else {
    // Si no se proporciona un nombre y una dirección de cliente, mostrar un mensaje de error o redirigir a alguna otra página
    echo "Error: No se proporcionó un nombre y una dirección de cliente.";

    // Imprimir la URL actual para depuración
    echo "<br>URL: " . $_SERVER['REQUEST_URI'];
}
?>
