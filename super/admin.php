<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control | Super Administrador</title>
</head>
<body>
    
  <!-- Contenido Principal. Contiene el contenido de la página -->
  <div class="content-wrapper">
    <!-- Contenido Principal -->
    <section class="content">
      <div class="container-fluid">
        <div><br></div>
        <!-- Cajas pequeñas (estadísticas) -->
        <div class="row">



         
          <?php
// Configuración de la conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener la fecha actual en el formato adecuado para MySQL (YYYY-MM-DD)
$current_date = date("Y-m-d");

// Consulta SQL para contar los pedidos del día actual con el estatus 'PENDIENTE'
$sql = "SELECT COUNT(*) AS total_pedidos FROM pedidos WHERE DATE(fecha) = '$current_date' AND estatus = 'PENDIENTE'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Si hay resultados, mostrar el número de pedidos
  $row = $result->fetch_assoc();
  $total_pedidos = $row["total_pedidos"];
} else {
  $total_pedidos = 0;
}

// Cerrar conexión
$conn->close();
?>

<!-- Caja pequeña para Nuevos Pedidos -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo $total_pedidos; ?></h3>
            <p>Nuevos Pedidos</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="detalles_pedidos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>




          <!-- Caja pequeña para Ganancias -->
          <?php
// Configuración de la conexión
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Zona horaria (GMT-6)
date_default_timezone_set('America/Mexico_City');

// Obtener la fecha actual (día en curso)
$fecha_actual = date('Y-m-d');

// Consulta SQL para sumar deuda_restante solo del día actual
$sql = "SELECT SUM(deuda_restante) as total_deuda
        FROM historial_deudas
        WHERE DATE(fecha) = '$fecha_actual'";

// Ejecutar la consulta
$resultado = $conn->query($sql);

// Obtener el total de deuda
$total_deuda = 0;
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $total_deuda = $fila['total_deuda'] ?? 0;  // Si no hay resultado, será 0
}

// Cerrar la conexión
$conn->close();
?>

<!-- Mostrar el resultado en la caja de ganancias -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-secondary">
      <div class="inner">
        <h3><?php echo number_format($total_deuda, 2, '.', ','); ?> MXN</h3>
        <p>Dinero recaudado</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="recaudado" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


          <!-- Caja pequeña para Gastos -->
          <?php
// Configuración de la conexión
include '../config/conexion.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Zona horaria (GMT-6)
date_default_timezone_set('America/Mexico_City');

// Obtener la fecha actual (día en curso)
$fecha_actual = date('Y-m-d');

// Consulta SQL para sumar monto solo del día actual
$sql = "SELECT SUM(monto) as total_gastos
        FROM gastos
        WHERE DATE(fecha) = '$fecha_actual'";

// Ejecutar la consulta
$resultado = $conn->query($sql);

// Obtener el total de gastos
$total_gastos = 0;
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $total_gastos = $fila['total_gastos'] ?? 0;  // Si no hay resultado, será 0
}

// Cerrar la conexión
$conn->close();
?>

<!-- Mostrar el resultado en la caja de gastos -->
<!--<div class="col-lg-3 col-6">
  <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php echo number_format($total_gastos, 2, '.', ','); ?> MXN</h3>
        <p>Gastos</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="gastos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>-->




        </div>
      </div>
    </section>
  </div>

</div>

  <!-- Bootstrap 4 JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>
</body>
</html>
