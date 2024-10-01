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
                                        WHERE DATE(fecha) = '$fecha_actual'";
                                
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
                                // Reutilizar la conexión
                                include '../config/conexion.php';

                                // Consulta para obtener la suma de deuda_restante solo del día actual (GMT-6)
                                $sql = "SELECT SUM(deuda_restante) AS total_recaudado 
                                        FROM historial_deudas 
                                        WHERE DATE(fecha) = '$fecha_actual'";
                                
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
                                // Reutilizar la conexión
                                include '../config/conexion.php';

                                // Sumar los totales para calcular 'En existencia'
                                $en_existencia = $total_recaudado - $total_gastos;

                                // Formatear el valor a moneda (MXN)
                                echo '$' . number_format($en_existencia, 2, '.', ',') . ' MXN';

                                // Cerrar conexión
                                $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
