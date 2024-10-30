<?php
include '../config/conexion.php'; // Incluir conexión a la base de datos
require_once('../tcpdf/tcpdf.php'); // Asegúrate de tener la ruta correcta a TCPDF

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    // Consulta para obtener datos de salidas
    $querySalidas = "SELECT * FROM salidas WHERE DATE(fecha) BETWEEN ? AND ? ORDER BY DATE(fecha)";
    $stmtSalidas = $conn->prepare($querySalidas);
    if (!$stmtSalidas) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmtSalidas->bind_param('ss', $fechaInicio, $fechaFin);
    $stmtSalidas->execute();
    $resultSalidas = $stmtSalidas->get_result();

    // Inicializar variable para totales globales de salidas
    $productosSalidasTotales = [];
    $dataSalidas = [];
    
    // Obtener datos de salidas
    if ($resultSalidas->num_rows > 0) {
        while ($row = $resultSalidas->fetch_assoc()) {
            $dataSalidas[] = $row;

            // Acumular totales globales por producto de salidas
            if (!isset($productosSalidasTotales[$row['producto']])) {
                $productosSalidasTotales[$row['producto']] = ['piezas' => 0, 'kilos' => 0];
            }
            $productosSalidasTotales[$row['producto']]['piezas'] += $row['piezas'];
            $productosSalidasTotales[$row['producto']]['kilos'] += $row['kilos'];
        }
    }

    // Consulta para obtener datos de entradas (entradas_con_fecha)
    $queryEntradas = "SELECT producto_nombre, SUM(stock) as total_stock, SUM(kilos) as total_kilos FROM entradas_con_fecha WHERE DATE(fecha) BETWEEN ? AND ? GROUP BY producto_nombre";
    $stmtEntradas = $conn->prepare($queryEntradas);
    if (!$stmtEntradas) {
        die("Error en la preparación de la consulta de entradas: " . $conn->error);
    }

    $stmtEntradas->bind_param('ss', $fechaInicio, $fechaFin);
    $stmtEntradas->execute();
    $resultEntradas = $stmtEntradas->get_result();

    // Inicializar variable para totales globales de entradas
    $productosEntradasTotales = [];
    
    // Obtener datos de entradas
    if ($resultEntradas->num_rows > 0) {
        while ($row = $resultEntradas->fetch_assoc()) {
            $productosEntradasTotales[$row['producto_nombre']] = [
                'stock' => $row['total_stock'],
                'kilos' => $row['total_kilos'],
            ];
        }
    }

    // Consulta para obtener datos de entradas (entradas_menudencia_con_fecha)
    $queryEntradasMenudencia = "SELECT producto_nombre, SUM(kilos) as total_kilos FROM entradas_menudencia_con_fecha WHERE DATE(fecha) BETWEEN ? AND ? GROUP BY producto_nombre";
    $stmtEntradasMenudencia = $conn->prepare($queryEntradasMenudencia);
    if (!$stmtEntradasMenudencia) {
        die("Error en la preparación de la consulta de entradas de menudencia: " . $conn->error);
    }

    $stmtEntradasMenudencia->bind_param('ss', $fechaInicio, $fechaFin);
    $stmtEntradasMenudencia->execute();
    $resultEntradasMenudencia = $stmtEntradasMenudencia->get_result();

    // Agregar totales de menudencia a las entradas
    if ($resultEntradasMenudencia->num_rows > 0) {
        while ($row = $resultEntradasMenudencia->fetch_assoc()) {
            if (!isset($productosEntradasTotales[$row['producto_nombre']])) {
                $productosEntradasTotales[$row['producto_nombre']] = [
                    'stock' => 0,
                    'kilos' => 0,
                ];
            }
            $productosEntradasTotales[$row['producto_nombre']]['kilos'] += $row['total_kilos'];
        }
    }

    // Generar el PDF
    $pdf = new TCPDF();
    $pdf->SetMargins(20, 20, 20); // Ajustar márgenes
    $pdf->AddPage();

    // Cabecera
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Informe de Inventario', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, "Desde: $fechaInicio  Hasta: $fechaFin", 0, 1, 'C');
    $pdf->Ln(10); // Espacio adicional

    // Imprimir datos de salidas
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, "Salidas", 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    $fechaAnterior = '';
    foreach ($dataSalidas as $row) {
        $fecha = date('Y-m-d', strtotime($row['fecha'])); // Solo obtener la fecha sin hora

        // Solo imprimir la fecha si es diferente de la anterior
        if ($fecha !== $fechaAnterior) {
            if ($fechaAnterior !== '') {
                // Solo añadir espacio entre fechas
                $pdf->Ln(10); // Espacio antes de la nueva fecha
            }

            // Imprimir la nueva fecha
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, "Fecha: $fecha", 0, 1);
            $pdf->SetFont('helvetica', '', 12);
            
            // Encabezados de la tabla para la fecha
            $pdf->Cell(50, 10, 'Producto', 1);
            $pdf->Cell(30, 10, 'Piezas', 1);
            $pdf->Cell(30, 10, 'Kilos', 1);
            $pdf->Ln();

            $fechaAnterior = $fecha; // Actualizar la fecha anterior
        }

        // Mostrar detalles de cada producto
        $pdf->Cell(50, 10, $row['producto'], 1);
        $pdf->Cell(30, 10, $row['piezas'], 1);
        $pdf->Cell(30, 10, $row['kilos'], 1);
        $pdf->Ln();
    }

    // Imprimir totales globales por producto de salidas
    $pdf->Ln(10); // Espacio antes del total global de salidas
    $pdf->SetFont('helvetica', 'B', 14); // Negrita para total global
    $pdf->Cell(0, 10, "Total Global Salidas", 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12); // Regresar a fuente normal

    foreach ($productosSalidasTotales as $producto => $totales) {
        $pdf->Cell(50, 10, $producto, 1);
        $pdf->Cell(30, 10, $totales['piezas'], 1);
        $pdf->Cell(30, 10, $totales['kilos'], 1);
        $pdf->Ln();
    }

    // Imprimir datos de entradas
    $pdf->Ln(10); // Espacio adicional
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, "Entradas", 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    foreach ($productosEntradasTotales as $producto => $totales) {
        $pdf->Cell(50, 10, $producto, 1);
        $pdf->Cell(30, 10, $totales['stock'], 1);
        $pdf->Cell(30, 10, $totales['kilos'], 1);
        $pdf->Ln();
    }

    // Imprimir totales globales por producto de entradas
    $pdf->Ln(10); // Espacio antes del total global de entradas
    $pdf->SetFont('helvetica', 'B', 14); // Negrita para total global
    $pdf->Cell(0, 10, "Total Global Entradas", 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12); // Regresar a fuente normal

    foreach ($productosEntradasTotales as $producto => $totales) {
        $pdf->Cell(50, 10, $producto, 1);
        $pdf->Cell(30, 10, $totales['stock'], 1);
        $pdf->Cell(30, 10, $totales['kilos'], 1);
        $pdf->Ln();
    }

// Calcular y mostrar inventario restante
$pdf->Ln(10); // Espacio adicional
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, "Inventario Restante", 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12); // Regresar a fuente normal

// Encabezados de la tabla
$pdf->Cell(50, 10, 'Producto', 1);
$pdf->Cell(30, 10, 'Piezas', 1);
$pdf->Cell(30, 10, 'Kilos', 1);
$pdf->Ln();

// Recorrer todos los productos en salidas y entradas
$productosTotales = array_unique(array_merge(array_keys($productosEntradasTotales), array_keys($productosSalidasTotales)));

foreach ($productosTotales as $producto) {
    // Obtener datos de salidas
    $totalesSalidas = $productosSalidasTotales[$producto] ?? ['piezas' => 0, 'kilos' => 0];
    
    // Obtener datos de entradas
    $totalesEntradas = $productosEntradasTotales[$producto] ?? ['stock' => 0, 'kilos' => 0];

    // Calcular el total de piezas de entradas
    $totalPiezas = $totalesEntradas['stock']; // Considerando el stock como el total de piezas disponibles

    // Calcular kilos restantes
    $inventarioRestanteKilos = $totalesEntradas['kilos'] - $totalesSalidas['kilos'];

    // Imprimir datos en la tabla
    $pdf->Cell(50, 10, $producto, 1);
    $pdf->Cell(30, 10, $totalPiezas - $totalesSalidas['piezas'], 1); // Piezas restantes
    $pdf->Cell(30, 10, $inventarioRestanteKilos, 1); // Kilos restantes
    $pdf->Ln();
}

    // Cerrar y output el PDF
    $pdf->Output('informe_inventario.pdf', 'D');

    $stmtSalidas->close();
    $stmtEntradas->close();
    $stmtEntradasMenudencia->close();
} else {
    echo "Método de solicitud no permitido.";
}

$conn->close();
?>
