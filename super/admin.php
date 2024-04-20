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
        <!-- Cajas pequeñas (estadísticas) -->
        <div class="row">



          <!-- Caja pequeña para Ventas -->
          <div class="col-lg-3 col-6">
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
          </div>
          

          
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
        <a href="detalles_pedidos.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>




          <!-- Caja pequeña para Ganancias -->
          <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
              <div class="inner">
                <h3>$64,987</h3>

                <p>Ganancias</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Caja pequeña para Gastos -->
          <div class="col-lg-3 col-6">
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
          </div>

          <!-- Caja pequeña para Clientes a Crédito -->
          <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
                  <div class="inner">
                      <h3>28</h3>
                      <p>Clientes a Crédito</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-card"></i>
                  </div>
                  <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>

          <!-- Caja pequeña para Deudas de Cajas -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-dark">
                  <div class="inner">
                      <!-- Aquí puedes mostrar el total de deudas de cajas -->
                      <h3>$XX,XXX</h3>
                      <p>Deudas de Cajas</p>
                  </div>
                  <div class="icon">
                      <!-- Puedes elegir un icono apropiado, por ejemplo: -->
                      <i class="ion ion-social-usd"></i>
                  </div>
                  <!-- Puedes enlazar a la página de detalles de las deudas de cajas -->
                  <a href="detalles_deudas_cajas.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>


        </div>
      </div>
    </section>
  </div>

</div>

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
