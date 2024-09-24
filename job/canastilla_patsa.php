<?php
if (isset($_GET['generate_pdf'])) {
    require('../tcpdf/tcpdf.php');
    require('../config/conexion.php');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Crear nuevo documento PDF en formato vertical (Portrait)
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Historial de Cajas');
    $pdf->SetSubject('Historial de Cajas');
    $pdf->SetKeywords('Historial, PDF, Download');

    $pdf->AddPage();

    // Fecha y hora actual
    date_default_timezone_set('America/Mexico_City');
    $currentDateTime = date('Y-m-d h:i a', time());
    
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Fecha y Hora: ' . $currentDateTime, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Historial de Cajas', 0, 1, 'C');
    $pdf->Ln(10);

    // Sección de Cajas Recibidas
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Cajas Recibidas', 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    $query1 = "SELECT caja, tapa, fecha FROM cajas_recibidas";
    $result1 = $conn->query($query1);

    // Agregar cabeceras de la tabla para Cajas Recibidas
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(50, 10, 'Caja', 1);
    $pdf->Cell(50, 10, 'Tapa', 1);
    $pdf->Cell(50, 10, 'Fecha', 1);
    $pdf->Ln();

    $pdf->SetFont('helvetica', '', 10);
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $pdf->Cell(50, 10, $row['caja'], 1);
            $pdf->Cell(50, 10, $row['tapa'], 1);
            $pdf->Cell(50, 10, $row['fecha'], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, 'No hay cajas recibidas.', 1, 1);
    }

    $pdf->Ln(10);

    // Sección de Cajas Enviadas
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Cajas Enviadas', 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    $query2 = "SELECT caja, tapa, fecha FROM caja_enviada";
    $result2 = $conn->query($query2);

    // Agregar cabeceras de la tabla para Cajas Enviadas
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(50, 10, 'Caja', 1);
    $pdf->Cell(50, 10, 'Tapa', 1);
    $pdf->Cell(50, 10, 'Fecha', 1);
    $pdf->Ln();

    $pdf->SetFont('helvetica', '', 10);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $pdf->Cell(50, 10, $row['caja'], 1);
            $pdf->Cell(50, 10, $row['tapa'], 1);
            $pdf->Cell(50, 10, $row['fecha'], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, 'No hay cajas enviadas.', 1, 1);
    }

    $pdf->Ln(10);

    // Sección de Canastillas
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Canastillas', 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    $query3 = "SELECT caja, tapa FROM canastilla";
    $result3 = $conn->query($query3);

    // Agregar cabeceras de la tabla para Canastillas
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(50, 10, 'Caja', 1);
    $pdf->Cell(50, 10, 'Tapa', 1);
    $pdf->Ln();

    $pdf->SetFont('helvetica', '', 10);
    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $pdf->Cell(50, 10, $row['caja'], 1);
            $pdf->Cell(50, 10, $row['tapa'], 1);
            $pdf->Ln();
        }
    } else {
        $pdf->Cell(0, 10, 'No hay canastillas.', 1, 1);
    }

    // Descargar el PDF
    $pdf->Output('historial_cajas.pdf', 'D');

    // Cerrar conexión
    $conn->close();
    exit;
}
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Canastilla de patsa</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

  <!-- Contenido Principal -->
  <div class="content-wrapper">
    <!-- Contenido Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title">Registrar Canastilla de patsa</h3>
              </div>
              <div class="card-body">
                <?php
                // Verificar si hay un mensaje de éxito o error en la URL
                if (isset($_GET['mensaje_exito'])) {
                    $mensaje_exito = $_GET['mensaje_exito'];
                    echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
                } elseif (isset($_GET['mensaje_error'])) {
                    $mensaje_error = $_GET['mensaje_error'];
                    echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                }
                ?>

                <form method="post" action="guardar_datos.php">
                  <div class="form-group">
                    <label for="caja">Caja:</label>
                    <input type="text" class="form-control" id="caja" name="caja" required>
                  </div>
                  <div class="form-group">
                    <label for="tapa">Tapa:</label>
                    <input type="text" class="form-control" id="tapa" name="tapa" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

              </div>
            </div>
          </div>


          <!-- Nuevo Cuadro "Cajas Recibidas" -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Cajas Recibidas</h3>
    </div>
    <div class="card-body">
      <?php
      // Verificar si hay un mensaje de éxito o error en la URL
      if (isset($_GET['mensaje_exito_recibida'])) {
          $mensaje_exito = $_GET['mensaje_exito_recibida'];
          echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
      } elseif (isset($_GET['mensaje_error_recibida'])) {
          $mensaje_error = $_GET['mensaje_error_recibida'];
          echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
      }
      ?>

      <form method="post" action="guardar_cajas_recibidas.php">
        <div class="form-group">
          <label for="caja_recibida">Caja:</label>
          <input type="text" class="form-control" id="caja_recibida" name="caja_recibida" required>
        </div>
        <div class="form-group">
          <label for="tapa_recibida">Tapa:</label>
          <input type="text" class="form-control" id="tapa_recibida" name="tapa_recibida" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Recibida</button>
      </form>
    </div>
  </div>
</div>


<!-- Sección de Caja Enviada -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Caja Enviada</h3>
    </div>
    <div class="card-body">
      <?php
      // Verificar si hay un mensaje de éxito o error en la URL para Caja Enviada
      if (isset($_GET['mensaje_exito_enviada'])) {
          $mensaje_exito = $_GET['mensaje_exito_enviada'];
          echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
      } elseif (isset($_GET['mensaje_error_enviada'])) {
          $mensaje_error = $_GET['mensaje_error_enviada'];
          echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
      }
      ?>

      <form method="post" action="guardar_caja_enviada.php">
        <div class="form-group">
          <label for="caja_enviada">Caja:</label>
          <input type="text" class="form-control" id="caja_enviada" name="caja_enviada" required>
        </div>
        <div class="form-group">
          <label for="tapa_enviada">Tapa:</label>
          <input type="text" class="form-control" id="tapa_enviada" name="tapa_enviada" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Enviada</button>
      </form>
    </div>
  </div>
</div>

<!-- Cuadro "Canastilla Actual" -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Canastilla Actual</h3>
    </div>
    <div class="card-body">
      <?php
      // Incluir el archivo de conexión
      include '../config/conexion.php';

      // Obtener los datos actuales de la canastilla
      $sql_canastilla = "SELECT caja, tapa FROM canastilla WHERE id = 1"; // Ajusta el WHERE según tu caso
      $resultado = $conn->query($sql_canastilla);

      if ($resultado->num_rows > 0) {
          // Obtener los datos de la canastilla
          $fila = $resultado->fetch_assoc();
          $caja_actual = $fila['caja'];
          $tapa_actual = $fila['tapa'];
          echo '<p><strong>Caja Actual:</strong> ' . $caja_actual . '</p>';
          echo '<p><strong>Tapa Actual:</strong> ' . $tapa_actual . '</p>';
      } else {
          echo '<p>No se encontraron datos para la canastilla.</p>';
      }

      $conn->close();
      ?>
    </div>
  </div>
</div>


<!-- Botón para descargar historial de cajas entregadas -->
<div class="col-md-4">
  <br>
  <div class="card card-white">
    <div class="card-header">
      <h3 class="card-title">Descargar historial de cajas</h3>
    </div>
    <div class="card-body">
      <a href="<?php echo $_SERVER['PHP_SELF']; ?>?generate_pdf=1" class="btn btn-primary">Descargar Historial</a>
    </div>
  </div>
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

