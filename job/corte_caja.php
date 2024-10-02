<?php
// Verificar si se hizo clic en el botón para generar el PDF
if (isset($_GET['generate_pdf'])) {
    require('../tcpdf/tcpdf.php');
    require '../config/conexion.php'; // Asegúrate de que la conexión esté correctamente incluida

    // Crear nuevo documento PDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('Distribuidora González');
    $pdf->SetAuthor('Distribuidora González');
    $pdf->SetTitle('Historial del Día');
    $pdf->SetSubject('Historial de Gastos y Deudas');
    $pdf->SetKeywords('Historial, PDF, Gastos, Deudas');

    $pdf->AddPage();

    // Fecha y hora actual
    date_default_timezone_set('America/Mexico_City'); // Asegurar GMT-6

    // Verificar si el horario de verano está activo
    $is_dst = date('I'); // Devuelve 1 si el horario de verano está activo, 0 si no
    
    if ($is_dst) {
        // Restar una hora si está en horario de verano
        $currentDateTime = date('Y-m-d h:i a', time() - 3600); // Restar una hora
    } else {
        $currentDateTime = date('Y-m-d h:i a', time());
    }

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Fecha y Hora: ' . $currentDateTime, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Historial del Día', 0, 1, 'C');
    $pdf->Ln(10);

    // Gastos del Día
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Gastos del día', 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    // Encabezados de tabla de gastos
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(80, 10, 'Descripción', 1);
    $pdf->Cell(40, 10, 'Monto', 1);
    $pdf->Cell(40, 10, 'Fecha', 1);
    $pdf->Ln();

    // Sumar los gastos del día
    $total_gastos = 0;

    // Obtener los gastos del día actual
    $sql = "SELECT id, descripcion, monto, fecha, fecha_registro 
            FROM gastos 
            WHERE DATE(fecha) = DATE(CONVERT_TZ(NOW(), 'SYSTEM', '-06:00'))";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(80, 10, $row['descripcion'], 1);
            $pdf->Cell(40, 10, '$' . number_format($row['monto'], 2, '.', ',') . ' MXN', 1);
            $pdf->Cell(40, 10, $row['fecha'], 1);
            $pdf->Ln();
            $total_gastos += $row['monto']; // Sumar el monto al total de gastos
        }
    } else {
        $pdf->Cell(0, 10, 'No hay gastos para el día actual.', 1, 1);
    }

    // Deudas del Día
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Dinero recaudado', 0, 1);
    $pdf->SetFont('helvetica', '', 12);

    // Encabezados de tabla de deudas
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(60, 10, 'Cliente', 1);
    $pdf->Cell(60, 10, 'Dirección', 1);
    $pdf->Cell(40, 10, 'Dinero Recaudado', 1);
    $pdf->Ln();

    // Sumar las deudas del día
    $total_deudas = 0;

    // Obtener las deudas del día actual
    $sql = "SELECT id, nombre_cliente, direccion, deuda_restante, fecha 
            FROM historial_deudas 
            WHERE DATE(fecha) = DATE(CONVERT_TZ(NOW(), 'SYSTEM', '-06:00'))";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(60, 10, $row['nombre_cliente'], 1);
            $pdf->Cell(60, 10, $row['direccion'], 1);
            $pdf->Cell(40, 10, '$' . number_format($row['deuda_restante'], 2, '.', ',') . ' MXN', 1);
            $pdf->Ln();
            $total_deudas += $row['deuda_restante']; // Sumar la deuda restante al total de deudas
        }
    } else {
        $pdf->Cell(0, 10, 'No hay deudas registradas para el día actual.', 1, 1);
    }

    // Mostrar los totales
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Total de Gastos: $' . number_format($total_gastos, 2, '.', ',') . ' MXN', 0, 1);
    $pdf->Cell(0, 10, 'Total de Recaudado: $' . number_format($total_deudas, 2, '.', ',') . ' MXN', 0, 1);

    // Calcular y mostrar el "Total Obtenido"
    $total_obtenido = $total_deudas - $total_gastos;
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Total Obtenido: $' . number_format($total_obtenido, 2, '.', ',') . ' MXN', 0, 1, 'C');

    // Agregar cuadro para el sello de recibido con texto largo de conformidad
    $pdf->Ln(20);
    $pdf->SetFont('helvetica', '', 10);
    
    // Texto largo de conformidad
    $conformidad_texto = "Declaro que he recibido el monto total especificado en este documento correspondiente "
                        . "a las deudas y gastos mencionados. Acepto de conformidad los términos y detalles aquí "
                        . "plasmados, y otorgo mi firma y sello como prueba de que el dinero ha sido recibido en su "
                        . "totalidad, sin objeciones ni reservas.";

    $pdf->MultiCell(0, 10, $conformidad_texto, 0, 'L');
    
    // Dibujar el cuadro con guiones para el sello
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 20, 'Sello de Recibido:', 0, 1);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 20, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 1, 'C');

    // Descargar el PDF
    $pdf->Output('historial_del_dia.pdf', 'D');

    // Cerrar la conexión a la base de datos
    $conn->close();
    exit;
}
?>



<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribuidora González | Corte de caja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .stat-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }
        .stat-title {
            font-size: 1.2em;
            font-weight: bold;
        }
        .stat-value {
            font-size: 2em;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Cajas pequeñas (estadísticas) -->
        <div><br></div>
        <div class="row">
            <div class="col-md-4">
                <div class="stat-box">
                    <div class="stat-title">Gastos</div>
                    <div class="stat-value">
                        <?php
                        // Conexión a la base de datos
                        include '../config/conexion.php';

                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Ajuste de zona horaria a GMT-6
                        date_default_timezone_set('America/Mexico_City');

                        // Obtener la fecha actual en GMT-6
                        $fecha_actual = date('Y-m-d');

                        // Consulta para obtener la suma de monto solo del día actual (GMT-6)
                        $sql = "SELECT SUM(monto) AS total_gastos 
                                FROM gastos 
                                WHERE DATE(fecha) = DATE(CONVERT_TZ(NOW(), 'SYSTEM', '-06:00'))";
                                                        
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $total_gastos = $row['total_gastos'] ? $row['total_gastos'] : 0;

                            // Formatear el valor a moneda (MXN)
                            echo '$' . number_format($total_gastos, 2, '.', ',') . ' MXN';
                        } else {
                            echo '$0.00 MXN';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <div class="stat-title">Recaudado</div>
                    <div class="stat-value">
                        <?php
                        // Consulta para obtener la suma de deuda_restante solo del día actual (GMT-6)
                        $sql = "SELECT SUM(deuda_restante) AS total_recaudado 
                                FROM historial_deudas 
                                WHERE DATE(fecha) = DATE(CONVERT_TZ(NOW(), 'SYSTEM', '-06:00'))";
                                                        
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $total_recaudado = $row['total_recaudado'] ? $row['total_recaudado'] : 0;

                            // Formatear el valor a moneda (MXN)
                            echo '$' . number_format($total_recaudado, 2, '.', ',') . ' MXN';
                        } else {
                            echo '$0.00 MXN';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <div class="stat-title">En existencia</div>
                    <div class="stat-value">
                        <?php
                        // Sumar los totales para calcular 'En existencia'
                        $en_existencia = $total_recaudado - $total_gastos;

                        // Formatear el valor a moneda (MXN)
                        echo '$' . number_format($en_existencia, 2, '.', ',') . ' MXN';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección para descargar el PDF -->
        <div class="row">
            <div class="col-md-12">
                <div class="stat-box">
                    <div class="stat-title">Descargar Historial del Día</div>
                    <br>
                    <form method="get">
                        <button type="submit" name="generate_pdf" class="btn btn-primary">Generar PDF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
