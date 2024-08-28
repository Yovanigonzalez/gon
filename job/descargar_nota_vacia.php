<?php
require('../tcpdf/tcpdf.php');

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
$pdf->Cell(0, 10, 'Nota de remisión', 0, 1, 'C');

// Información del cliente alineada a la izquierda
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 8, 'Cliente: ____________________________', 0, 1, 'L');
$pdf->Cell(0, 8, 'Dirección: ___________________________', 0, 1, 'L');
$pdf->Cell(0, 8, 'Fecha: ___________________________', 0, 1, 'L');
$pdf->Ln(3);

// Agregar la imagen (Icono) alineada a la derecha
$pdf->Image('../font/number.png', 150, 13, 40); // Coordenadas ajustadas para colocar la imagen a la derecha

// Encabezado de la tabla de productos
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(0, 0, 0); // Fondo negro
$pdf->SetTextColor(255, 255, 255); // Texto blanco
$header = array('Producto', 'Piezas', 'Kilos', 'Precio', 'Subtotal');
$cellWidths = array(80, 20, 20, 30, 40); // Ancho personalizado para cada columna

foreach ($header as $i => $col) {
    $pdf->Cell($cellWidths[$i], 10, $col, 1, 0, 'C', 1); // Asignar ancho de celda personalizado
}
$pdf->Ln();

// Restablecer color de texto para las celdas de datos
$pdf->SetTextColor(0, 0, 0); // Texto negro para los datos

// Campos vacíos para productos (8 filas en total)
$pdf->SetFont('helvetica', '', 12);
for ($i = 0; $i < 8; $i++) {
    $pdf->Cell($cellWidths[0], 10, '', 1);
    $pdf->Cell($cellWidths[1], 10, '', 1);
    $pdf->Cell($cellWidths[2], 10, '', 1);
    $pdf->Cell($cellWidths[3], 10, '', 1);
    $pdf->Cell($cellWidths[4], 10, '', 1);
    $pdf->Ln();
}

// Totales
$pdf->Ln(3);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 8, 'Subtotal Vendido: ___________________', 0, 1, 'R');
$pdf->Cell(0, 8, 'Deuda Pendiente: ___________________', 0, 1, 'R');
$pdf->Cell(0, 8, 'Total: ___________________', 0, 1, 'R');

// Dinero recibido y Deuda actual en una misma fila
$pdf->Ln(3);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 10, 'Dinero recibido: __________________ ', 0, 1);

// Campos vacíos para Caja Entregada y Tapa Entregada
$pdf->Ln(3);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 8, 'Caja Entregada: __________________   Tapa Entregada: __________________', 0, 1);

// Texto de pagaré
$pdf->Ln(3);
$pdf->SetFont('helvetica', '', 9);
$pdf->MultiCell(0, 11, 
                "Por este pagaré, me obligo incondicionalmente a pagar a la orden de Francisco González Flores la cantidad de ___________________ " .
                "," .
                "que se me ha entregado en mercancía a mi entera satisfacción.\n\n" .
                "Y será exigible desde la fecha de vencimiento de este documento hasta el día de su liquidación, causará intereses moratorios al tipo de ______% mensual, pagaderos con el principal. En caso de incumplimiento de este pagaré el beneficiario podrá demandar a su elección el cumplimiento del mismo en las ciudades Tecamachalco y/o Tehuacán.\n\n", 0, 'L', 0, 1);

// Firma del cliente
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(0, 6, 'Firma del cliente: __________________ ', 0, 1);

// Marca de agua en la segunda página
$pdf->SetAlpha(0.3); // Valor entre 0 (transparente) y 1 (opaco)
$pdf->Image('../pdf/icono.png', 20, 40, 180); // Coordenadas ajustadas para colocar la imagen a la derecha
$pdf->SetAlpha(1);

// Generar y descargar el PDF
$pdf->Output('nota_vacia.pdf', 'D');
?>
