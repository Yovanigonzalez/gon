<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            max-width: 80%;
            margin: 20px auto;
            font-size: 1.2rem; /* Tamaño de fuente un poco mayor */
        }
        .calendar div {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            height: 80px; /* Altura un poco mayor */
            position: relative;
            box-sizing: border-box;
        }
        .calendar .header {
            font-weight: bold;
            background-color: #f4f4f4;
        }
        .current-day {
            background-color: #ffeb3b;
            border-radius: 5px;
        }
    </style>
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
                                <h3>Mostrador</h3>
                                <p>Ventas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-social-usd"></i>
                            </div>
                            <a href="mostrador.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Caja pequeña para Gastos -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>Detalles</h3>
                                <p>Canastilla</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Caja pequeña para Clientes a Crédito -->
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
                            <a href="detalles_pedidos.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <h1 align="center">Calendario de pendientes</h1>
                <!-- Calendario en tiempo real -->
                <div class="calendar">
                    <div class="header">Lun</div>
                    <div class="header">Mar</div>
                    <div class="header">Mié</div>
                    <div class="header">Jue</div>
                    <div class="header">Vie</div>
                    <div class="header">Sáb</div>
                    <div class="header">Dom</div>
                    
                    <!-- Aquí se deben generar los días del calendario -->
                    <?php
                    $month = date('m'); // Mes actual
                    $year = date('Y'); // Año actual
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    
                    // Imprimir días vacíos para alinear el primer día
                    $firstDayOfMonth = date('w', strtotime("$year-$month-01"));
                    $firstDayOfMonth = ($firstDayOfMonth == 0) ? 6 : $firstDayOfMonth - 1; // Ajustar el primer día a Lunes

                    for ($i = 0; $i < $firstDayOfMonth; $i++) {
                        echo '<div></div>';
                    }
                    
                    // Imprimir los días del mes
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $class = ($day == date('j')) ? 'current-day' : '';
                        echo "<div class='$class'>$day</div>";
                    }
                    ?>
                </div>
            </div>
            <div><br></div>
        </section>
    </div>

    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
