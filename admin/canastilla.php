<?php
if (isset($_GET['generate_pdf'])) {
    require('../TCPDF/tcpdf.php');
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

// Consultas para obtener la suma de las columnas caja y tapa de ambas tablas
$query_recibidas = "SELECT SUM(caja) AS suma_caja_recibida, SUM(tapa) AS suma_tapa_recibida FROM cajas_recibidas";
$result_recibidas = $conn->query($query_recibidas);
$row_recibidas = $result_recibidas->fetch_assoc();
$suma_caja_recibida = $row_recibidas['suma_caja_recibida'];
$suma_tapa_recibida = $row_recibidas['suma_tapa_recibida'];

$query_enviadas = "SELECT SUM(caja) AS suma_caja_enviada, SUM(tapa) AS suma_tapa_enviada FROM caja_enviada";
$result_enviadas = $conn->query($query_enviadas);
$row_enviadas = $result_enviadas->fetch_assoc();
$suma_caja_enviada = $row_enviadas['suma_caja_enviada'];
$suma_tapa_enviada = $row_enviadas['suma_tapa_enviada'];

// Calcular la diferencia entre recibidas y enviadas
$diferencia_caja = $suma_caja_recibida - $suma_caja_enviada;
$diferencia_tapa = $suma_tapa_recibida - $suma_tapa_enviada;

// Agregar cabeceras de la tabla para el PDF
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(50, 10, 'Concepto', 1);
$pdf->Cell(50, 10, 'Caja', 1);
$pdf->Cell(50, 10, 'Tapa', 1);
$pdf->Ln();

$pdf->SetFont('helvetica', '', 10);

// Mostrar las sumas de recibidas
$pdf->Cell(50, 10, 'Total Recibidas', 1);
$pdf->Cell(50, 10, $suma_caja_recibida, 1);
$pdf->Cell(50, 10, $suma_tapa_recibida, 1);
$pdf->Ln();

// Mostrar las sumas de enviadas
$pdf->Cell(50, 10, 'Total Enviadas', 1);
$pdf->Cell(50, 10, $suma_caja_enviada, 1);
$pdf->Cell(50, 10, $suma_tapa_enviada, 1);
$pdf->Ln();

// Mostrar la diferencia entre recibidas y enviadas
$pdf->Cell(50, 10, 'Diferencia', 1);
$pdf->Cell(50, 10, $diferencia_caja, 1);
$pdf->Cell(50, 10, $diferencia_tapa, 1);
$pdf->Ln();


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
                <h3 class="card-title">Registrar Canastilla Actual</h3>
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



<!-- Cuadro "Canastilla Actual" -->
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

      // Sumar caja y tapa de la tabla `cajas_recibidas`
      $sql_recibidas = "SELECT SUM(caja) as suma_caja_recibida, SUM(tapa) as suma_tapa_recibida FROM cajas_recibidas";
      $resultado_recibidas = $conn->query($sql_recibidas);

      if ($resultado_recibidas->num_rows > 0) {
          $fila_recibidas = $resultado_recibidas->fetch_assoc();
          $suma_caja_recibida = $fila_recibidas['suma_caja_recibida'];
          $suma_tapa_recibida = $fila_recibidas['suma_tapa_recibida'];
      } else {
          $suma_caja_recibida = 0;
          $suma_tapa_recibida = 0;
      }

      // Sumar caja y tapa de la tabla `caja_enviada`
      $sql_enviadas = "SELECT SUM(caja) as suma_caja_enviada, SUM(tapa) as suma_tapa_enviada FROM caja_enviada";
      $resultado_enviadas = $conn->query($sql_enviadas);

      if ($resultado_enviadas->num_rows > 0) {
          $fila_enviadas = $resultado_enviadas->fetch_assoc();
          $suma_caja_enviada = $fila_enviadas['suma_caja_enviada'];
          $suma_tapa_enviada = $fila_enviadas['suma_tapa_enviada'];
      } else {
          $suma_caja_enviada = 0;
          $suma_tapa_enviada = 0;
      }

      // Calcular la diferencia entre recibidas y enviadas
      $diferencia_caja = $suma_caja_recibida - $suma_caja_enviada;
      $diferencia_tapa = $suma_tapa_recibida - $suma_tapa_enviada;

      // Mostrar resultados
      echo '<p><strong>Diferencia Caja:</strong> ' . $diferencia_caja . '</p>';
      echo '<p><strong>Diferencia Tapa:</strong> ' . $diferencia_tapa . '</p>';

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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>
</body>
</html>

