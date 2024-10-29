

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Verificador de notas</title>
    <!-- Bootstrap 4 CSS -->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --> <!-- en caso de fallar 'csss/mostrador.scss''-->
  <!-- Font Awesome CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->

  <link rel="stylesheet" href="styles.css">
  <style>
    .note-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin: 10px;
      border-radius: 5px;
      background-color: #f9f9f9;
      width: 200px;
      text-align: center;
    }
    .note-card h4 {
      font-size: 16px;
      margin-bottom: 10px;
    }
    .note-card p {
      font-size: 14px;
      margin-bottom: 15px;
    }
    .note-card button {
      margin: 5px;
      font-size: 14px;
      padding: 5px 10px;
    }
    .notes-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
    }

  </style>
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
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Verificador de notas del dia</h3>
              </div>
              <div class="card-body">
              <div id="mensaje"></div>

                <div class="notes-container">
                <?php
include '../config/conexion.php';

// Filtra las notas pendientes del día actual usando la columna 'created_at'
$sql = "SELECT notas.id, notas.cliente, notas.direccion, productos_nota.nota_id 
        FROM notas 
        JOIN productos_nota ON notas.id = productos_nota.nota_id 
        WHERE notas.estatus = 'pendiente' 
        AND DATE(CONVERT_TZ(notas.created_at, '+00:00', '-06:00')) = CURDATE()"; // Convertir a GMT-6

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="note-card">';
        echo '<h4>Cliente: ' . htmlspecialchars($row['cliente']) . '</h4>'; // htmlspecialchars para evitar inyecciones XSS
        echo '<p>Dirección: ' . htmlspecialchars($row['direccion']) . '</p>';
        echo '<p>Folio: ' . htmlspecialchars($row['nota_id']) . '</p>'; // Mostramos el folio asociado
        echo '</div>';
    }
} else {
    echo "No se encontraron  notas del dia.";
}

$conn->close();
?>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS en caso de fallar la recuperacion solo sera cambiar las llaves ya que el codigi estara en 'exception_job' -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>


</body>
</html>


