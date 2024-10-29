<?php

if (isset($_GET['nota_id'])) {
    require('../TCPDF/tcpdf.php');
    require('../config/conexion.php');

    $nota_id = $_GET['nota_id'];

    // Consulta para obtener los datos de la nota
    $queryNota = "SELECT * FROM notas WHERE id = ?";
    $stmt = $conn->prepare($queryNota);
    $stmt->bind_param("i", $nota_id);
    $stmt->execute();
    $resultNota = $stmt->get_result();
    $nota = $resultNota->fetch_assoc();

    
    // Consulta para obtener los productos asociados a la nota
    $queryProductos = "SELECT * FROM productos_nota WHERE nota_id = ?";
    $stmtProd = $conn->prepare($queryProductos);
    $stmtProd->bind_param("i", $nota_id);
    $stmtProd->execute();
    $resultProductos = $stmtProd->get_result();

    // Crear nuevo PDF con orientación vertical ('P' para Portrait)
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('Distribuidora González');
    $pdf->SetAuthor('Distribuidora González');
    $pdf->SetTitle('Nota de remisión');
    $pdf->SetSubject('Nota de remisión');
    $pdf->SetKeywords('Nota, Venta, PDF, Distribuidora González');

    
    // Agregar la primera página
    $pdf->AddPage();

    // Título del documento
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Nota de remisión original', 0, 1, 'C');

    // Mostrar el número de la nota
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 8, 'Folio: ' . $nota['id'], 0, 1, 'L'); // Aquí se agrega el número de la nota

    //Esta funcion es para ver los folios, clientes, direccion, fecha:
    // Información del cliente alineada a la izquierda
    //$pdf->SetFont('helvetica', '', 12);
    //$pdf->Cell(0, 8, 'Cliente: ' . $nota['cliente'], 0, 1, 'L');
    //$pdf->Cell(0, 8, 'Dirección: ' . $nota['direccion'], 0, 1, 'L');
    //$pdf->Cell(0, 8, 'Fecha: ' . $nota['created_at'], 0, 1, 'L');
    //$pdf->Ln(3);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 8, 'Cliente: ' . $nota['cliente'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Dirección: ' . $nota['direccion'], 0, 1, 'L');

    // Formatear la fecha para que solo muestre la fecha sin la hora
    $fecha_formateada = date('d/m/Y', strtotime($nota['created_at']));
    $pdf->Cell(0, 8, 'Fecha: ' . $fecha_formateada, 0, 1, 'L');
    $pdf->Ln(3);

    // Agregar la imagen (Icono) alineada a la derecha
    $pdf->Image('../font/number.png', 150, 13, 40); // Coordenadas ajustadas para colocar la imagen a la derecha

    // Encabezado de la tabla de productos
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetFillColor(0, 0, 0); // Fondo negro
    $pdf->SetTextColor(255, 255, 255); // Texto blanco
    $header = array('Producto', 'Pz', 'Kg', 'P/U', 'Importe');
    $cellWidths = array(80, 20, 20, 30, 40); // Ancho personalizado para cada columna

    foreach ($header as $i => $col) {
        $pdf->Cell($cellWidths[$i], 10, $col, 1, 0, 'C', 1); // Asignar ancho de celda personalizado
    }
    $pdf->Ln();

    // Restablecer color de texto para las celdas de datos
    $pdf->SetTextColor(0, 0, 0); // Texto negro para los datos

    // Datos de los productos
    $pdf->SetFont('helvetica', '', 12);
    while ($producto = $resultProductos->fetch_assoc()) {
        $pdf->Cell($cellWidths[0], 10, $producto['producto'], 1);
        $pdf->Cell($cellWidths[1], 10, number_format($producto['piezas'], 0, '.', ','), 1);
        $pdf->Cell($cellWidths[2], 10, number_format($producto['kilos'], 2, '.', ','), 1);
        $pdf->Cell($cellWidths[3], 10, number_format($producto['precio'], 2, '.', ','), 1);
        $pdf->Cell($cellWidths[4], 10, number_format($producto['subtotal'], 2, '.', ','), 1);
        $pdf->Ln();
    }

      // Totales
      $pdf->Ln(3);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->Cell(0, 8, 'Subtotal Vendido: $' . number_format($nota['subtotal_vendido'], 2, '.', ','), 0, 1, 'R');
      $pdf->Cell(0, 8, 'Deuda Pendiente: $' . number_format($nota['deuda_pendiente'], 2, '.', ','), 0, 1, 'R');
      $pdf->Cell(0, 8, 'Total: $' . number_format($nota['total'], 2, '.', ','), 0, 1, 'R');

    // Dinero recibido y Deuda actual en una misma fila
    $pdf->Ln(3);
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->Cell(0, 10, 'Dinero recibido: __________________ ', 0, 1);

        // Mostrar los campos adicionales en una sola fila
        $pdf->Ln(3);
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 8, 'Caja Deudora: ' . number_format($nota['caja_deudora'], 0, '.', ',') . '   ' .
        'Tapa Deudora: ' . number_format($nota['tapa_deudora'], 0, '.', ',') . '   ' .
        'Caja Enviada: ' . number_format($nota['caja_enviada'], 0, '.', ',') . '   ' .
        'Tapa Enviada: ' . number_format($nota['tapa_enviada'], 0, '.', ',') , 0, 1);
    
        // Campos vacíos para Caja Entregada y Tapa Entregada
        $pdf->Ln(3);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(0, 8, 'Caja Entregada: __________________   Tapa Entregada: __________________', 0, 1);

        
    // Texto de pagaré
    $pdf->Ln(3);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->MultiCell(0, 11, 
                    "Por este pagaré, me obligo incondicionalmente a pagar a la orden de Francisco González Flores la cantidad de " .
                    '$' . number_format($nota['total'], 2, '.', ',') . " (con letras: " . strtoupper(numToWords($nota['total'])) . "), " .
                    "que se me ha entregado en mercancía a mi entera satisfacción.\n\n" .
                    "Y será exigible desde la fecha de vencimiento de este documento hasta el día de su liquidación, causará intereses moratorios al tipo de ______% mensual, pagaderos con el principal. En caso de incumplimiento de este pagaré el beneficiario podrá demandar a su elección el cumplimiento del mismo en las ciudades Tecamachalco y/o Tehuacán.\n\n", 0, 'L', 0, 1);

                                            // Dinero recibido y Deuda actual en una misma fila (duplicado)
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->Cell(0, 6, 'Firma del cliente: __________________   Chofer: __________________', 0, 1);

    // Marca de agua en la segunda página
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->SetXY(110, 268);
    $pdf->Cell(0, 0, 'Original', 0, 1, 'C');

    // Establecer la opacidad (transparencia) de la imagen
    $pdf->SetAlpha(0.3); // Valor entre 0 (transparente) y 1 (opaco)

    // Agregar la imagen (Icono) alineada a la derecha
    $pdf->Image('../pdf/icono.png', 20, 40, 180); // Coordenadas ajustadas para colocar la imagen a la derecha

    // Restablecer la opacidad a 1 para el resto del contenido
    $pdf->SetAlpha(1);


    // Agregar una segunda página para duplicar el contenido
    $pdf->AddPage();
        
    // Título del documento (duplicado)
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Nota de remisión copia', 0, 1, 'C');

    // Mostrar el número de la nota (duplicado)
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 8, 'Folio: ' . $nota['id'], 0, 1, 'L');

    //Esta funcion es para ver los folios, clientes, direccion, fecha:
    // Información del cliente alineada a la izquierda
    //$pdf->SetFont('helvetica', '', 12);
    //$pdf->Cell(0, 8, 'Cliente: ' . $nota['cliente'], 0, 1, 'L');
    //$pdf->Cell(0, 8, 'Dirección: ' . $nota['direccion'], 0, 1, 'L');
    //$pdf->Cell(0, 8, 'Fecha: ' . $nota['created_at'], 0, 1, 'L');
    //$pdf->Ln(3);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 8, 'Cliente: ' . $nota['cliente'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Dirección: ' . $nota['direccion'], 0, 1, 'L');

    // Formatear la fecha para que solo muestre la fecha sin la hora
    $fecha_formateada = date('d/m/Y', strtotime($nota['created_at']));
    $pdf->Cell(0, 8, 'Fecha: ' . $fecha_formateada, 0, 1, 'L');
    $pdf->Ln(3);

    // Agregar la imagen (Icono) alineada a la derecha (duplicado)
    $pdf->Image('../imgs/1n.png', 150, 13, 40); // Coordenadas ajustadas para colocar la imagen a la derecha

    // Encabezado de la tabla de productos (duplicado)
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetTextColor(255, 255, 255);
    foreach ($header as $i => $col) {
        $pdf->Cell($cellWidths[$i], 10, $col, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    // Restablecer color de texto para las celdas de datos (duplicado)
    $pdf->SetTextColor(0, 0, 0);

    // Datos de los productos (duplicado)
    $pdf->SetFont('helvetica', '', 12);
    // Resetear el cursor de la consulta
    $stmtProd->execute();
    $resultProductos = $stmtProd->get_result();
    while ($producto = $resultProductos->fetch_assoc()) {
        $pdf->Cell($cellWidths[0], 10, $producto['producto'], 1);
        $pdf->Cell($cellWidths[1], 10, number_format($producto['piezas'], 0, '.', ','), 1);
        $pdf->Cell($cellWidths[2], 10, number_format($producto['kilos'], 2, '.', ','), 1);
        $pdf->Cell($cellWidths[3], 10, number_format($producto['precio'], 2, '.', ','), 1);
        $pdf->Cell($cellWidths[4], 10, number_format($producto['subtotal'], 2, '.', ','), 1);
        $pdf->Ln();
    }

      // Totales
      $pdf->Ln(3);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->Cell(0, 8, 'Subtotal Vendido: $' . number_format($nota['subtotal_vendido'], 2, '.', ','), 0, 1, 'R');
      $pdf->Cell(0, 8, 'Deuda Pendiente: $' . number_format($nota['deuda_pendiente'], 2, '.', ','), 0, 1, 'R');
      $pdf->Cell(0, 8, 'Total: $' . number_format($nota['total'], 2, '.', ','), 0, 1, 'R');

    // Dinero recibido y Deuda actual en una misma fila (duplicado)
    $pdf->Ln(3);
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->Cell(0, 10, 'Dinero recibido: __________________ ', 0, 1);

        // Mostrar los campos adicionales en una sola fila (duplicado)
        $pdf->Ln(3);
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 10, 'Caja Deudora: ' . number_format($nota['caja_deudora'], 0, '.', ',') . '   ' .
                         'Tapa Deudora: ' . number_format($nota['tapa_deudora'], 0, '.', ',') . '   ' .
                         'Caja Enviada: ' . number_format($nota['caja_enviada'], 0, '.', ',') . '   ' .
                         'Tapa Enviada: ' . number_format($nota['tapa_enviada'], 0, '.', ',') , 0, 1);
    
        // Campos vacíos para Caja Entregada y Tapa Entregada (duplicado)
        $pdf->Ln(3);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(0, 10, 'Caja Entregada: __________________   Tapa Entregada: __________________', 0, 1);

        
    // Texto de pagaré (duplicado)
    $pdf->Ln(3);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->MultiCell(0, 11, 
                    "Por este pagaré, me obligo incondicionalmente a pagar a la orden de Francisco González Flores la cantidad de " .
                    '$' . number_format($nota['total'], 2, '.', ',') . " (con letras: " . strtoupper(numToWords($nota['total'])) . "), " .
                    "que se me ha entregado en mercancía a mi entera satisfacción.\n\n" .
                    "Y será exigible desde la fecha de vencimiento de este documento hasta el día de su liquidación, causará intereses moratorios al tipo de ______% mensual, pagaderos con el principal. En caso de incumplimiento de este pagaré el beneficiario podrá demandar a su elección el cumplimiento del mismo en las ciudades Tecamachalco y/o Tehuacán.\n\n", 0, 'L', 0, 1);

                        // Dinero recibido y Deuda actual en una misma fila (duplicado)
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->Cell(0, 6, 'Firma del cliente: __________________   Chofer: __________________', 0, 1);

// Marca de agua en la segunda página
$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetTextColor(150, 150, 150);
$pdf->SetXY(110, 268);
$pdf->Cell(0, 0, 'Copia', 0, 1, 'C');

// Establecer la opacidad (transparencia) de la imagen
$pdf->SetAlpha(0.3); // Valor entre 0 (transparente) y 1 (opaco)

// Agregar la imagen (Icono) alineada a la derecha
$pdf->Image('../imgs/2.png', 20, 40, 180); // Coordenadas ajustadas para colocar la imagen a la derecha

// Restablecer la opacidad a 1 para el resto del contenido
$pdf->SetAlpha(1);

    // Generar y descargar el PDF
    $pdf->Output('nota_' . $nota_id . '.pdf', 'I'); //Si pongo la letra 'D' es para descargar el pdf 

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
  <title>Distribuidora González | Notas</title>
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
                <h3 class="card-title" id="title">Notas Pendientes</h3>
              </div>
              <div class="card-body">
              <div id="mensaje"></div>

                <div class="notes-container">
                <?php
                include '../config/conexion.php';

                // Filtra las notas pendientes del día actual usando la columna 'created_at'
                $sql = "SELECT id, cliente, direccion FROM notas WHERE estatus = 'pendiente' AND DATE(created_at) = CURDATE()";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="note-card">';
                        echo '<h4>' . htmlspecialchars($row['cliente']) . '</h4>'; // htmlspecialchars para evitar inyecciones XSS
                        echo '<p>' . htmlspecialchars($row['direccion']) . '</p>';
                        //echo '<a href="?nota_id=' . $row['id'] . '" class="btn btn-primary">Descargar nota</a>';
                        echo '<a href="?nota_id=' . $row['id'] . '" target="_blank" class="btn btn-primary">Ver nota</a>';
                        echo '<button class="btn btn-success entregada-btn" data-id="' . $row['id'] . '">Entregada</button>';
                        echo '</div>';
                    }
                } else {
                    echo "No se encontraron notas pendientes para hoy.";
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

<script>
  $(document).ready(function() {
    $('.entregada-btn').on('click', function() {
      var notaId = $(this).data('id');

      $.ajax({
        url: 'actualizar_estatus.php',
        type: 'POST',
        data: { nota_id: notaId },
        success: function(response) {
          // Mostrar mensaje de éxito en la página
          $('#mensaje').html('<div class="alert alert-success">Estatus actualizado a entregado</div>');
          
          // Recargar la página después de 2 segundos para mostrar el cambio
          setTimeout(function() {
            location.reload();
          }, 1000);
        },
        error: function() {
          // Mostrar mensaje de error en la página
          $('#mensaje').html('<div class="alert alert-danger">Error al actualizar el estatus</div>');
        }
      });
    });
  });
</script>

</body>
</html>


<?php 
// Función para convertir números a palabras en español
function numToWords($number) {
  $units = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
  $teens = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
  $tens = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
  $hundreds = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

  if ($number == 0) {
      return 'cero';
  }

  if ($number < 10) {
      return $units[$number];
  }

  if ($number < 20) {
      return $teens[$number - 10];
  }

  if ($number < 100) {
      return $tens[intval($number / 10)] . (($number % 10 > 0) ? ' y ' . $units[$number % 10] : '');
  }

  if ($number < 1000) {
      if ($number == 100) {
          return 'cien';
      }
      return $hundreds[intval($number / 100)] . (($number % 100 > 0) ? ' ' . numToWords($number % 100) : '');
  }

  if ($number < 1000000) {
      return numToWords(intval($number / 1000)) . ' mil ' . (($number % 1000 > 0) ? numToWords($number % 1000) : '');
  }

  if ($number < 1000000000) {
      return numToWords(intval($number / 1000000)) . ' millones ' . (($number % 1000000 > 0) ? numToWords($number % 1000000) : '');
  }

  return 'Número demasiado grande';
}

?>