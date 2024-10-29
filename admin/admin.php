<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
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

// Consulta SQL para contar los clientes
$sql = "SELECT COUNT(*) AS total_clientes FROM clientes";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Si hay resultados, mostrar el número de clientes
  $row = $result->fetch_assoc();
  $total_clientes = $row["total_clientes"];
} else {
  $total_clientes = 0;
}

// Cerrar conexión
$conn->close();
?>

<!-- Caja pequeña para Clientes -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo $total_clientes; ?></h3>
            <p>Clientes</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="total_clientes" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>



<?php
// Configuración de la conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para contar los productos en ambas tablas
$sql = "
    SELECT 
        (SELECT COUNT(*) FROM productos) AS total_productos,
        (SELECT COUNT(*) FROM productos_menudencia) AS total_productos_menudencia
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Si hay resultados, obtener los totales
  $row = $result->fetch_assoc();
  $total_productos = $row["total_productos"];
  $total_productos_menudencia = $row["total_productos_menudencia"];
  // Sumar ambos totales
  $total_productos_sumados = $total_productos + $total_productos_menudencia;
} else {
  $total_productos_sumados = 0;
}

// Cerrar conexión
$conn->close();
?>

<!-- Caja pequeña para Productos Totales -->
<div class="col-lg-3 col-6">
    <div class="small-box bg-dark"> <!-- Cambiar bg-warning por el color deseado -->
        <div class="inner">
            <h3><?php echo $total_productos_sumados; ?></h3>
            <p>Total de Productos</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="total_productos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>



          <!-- Caja pequeña para Ventas -->
        <!--  <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>$32,500</h3>

                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-usd"></i>
              </div>
              <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
          

          
          <?php
// Configuración de la conexión a la base de datos
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Establecer la zona horaria a GMT-6
date_default_timezone_set('America/Mexico_City');

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
            <p>Ver Pedidos</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="detalles_pedidos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>




          <!-- Caja pequeña para Ganancias -->
          <!--<div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>$64,987</h3>

                <p>Ganancias</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->


          <!-- Caja pequeña para Gastos -->
          <!--<div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>$23,482</h3>

                <p>Gastos</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->

          <!-- Caja pequeña para Clientes a Crédito -->
          <?php
// Conexión a la base de datos
include '../config/conexion.php';
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT COUNT(*) AS total_clientes_credito FROM deudores";
$resultado = $conn->query($sql);

// Obtener el total de clientes a crédito
$total_clientes_credito = 0;
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $total_clientes_credito = $fila['total_clientes_credito'];
}

$conn->close();
?>

<div class="col-lg-3 col-6">
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3><?php echo $total_clientes_credito; ?></h3>
            <p>Clientes a Crédito</p>
        </div>
        <div class="icon">
            <i class="ion ion-card"></i>
        </div>
        <a href="clientes_credito" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


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
