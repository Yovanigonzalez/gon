<!-- Es una plantilla HTML para el panel de una aplicación web. Incluye varios elementos
como un menú de navegación de la barra lateral, barra de navegación superior, menú desplegable de perfil de usuario, notificaciones
menú desplegable y un modo de cierre de sesión. -->

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--<title>SB Admin 2 - Dashboard</title>-->

    <!-- Fuentes personalizadas para esta plantilla-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link rel="shortcut icon" type="image/x-icon" href="../log/hospital.png">


    <!-- Estilos personalizados para esta plantilla-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Envoltura de la página -->
    <div id="wrapper">

        <!-- Barra lateral -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Marca de la barra lateral -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!--<i class="fas fa-laugh-wink"></i>-->
                </div>
                <div class="sidebar-brand-text mx-3">Panel Admin </div>
            </a>

            <!-- Separador -->
            <hr class="sidebar-divider my-0">

            <!-- Elemento de navegación - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="inicio.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de Control</span></a>
            </li>

            <!-- Separador -->
            <hr class="sidebar-divider">
            <!-- Encabezado -->
            <div class="sidebar-heading">
                Utilidades
            </div>


            <!-- Elemento de navegación - Agregar Usuario -->
            <li class="nav-item">
                <a class="nav-link" href="agregar_usuario.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Agregar Clientes</span>
                </a>
            </li>

            <!-- Elemento de navegación - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="empleado.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Agregar Prodcutos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="compañia.php">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Agregar Entradas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="servicios.php">
                    <i class="fas fa-fw fa-h-square"></i>
                    <span>Agergar Pedidos</span>
                </a>
            </li>

            <!-- Separador -->
            <hr class="sidebar-divider">

            <!-- Encabezado -->
            <div class="sidebar-heading">
                GESTION
            </div>

            <!-- Elemento de navegación - Usuarios -->
            <li class="nav-item">
                <a class="nav-link" href="../pdf/db.pdf" download>
                    <i class="fas fa-fw fa-book"></i>
                    <span>Manual de Admin</span>
                </a>
            </li>




            <!-- Separador -->
            <hr class="sidebar-divider">

                        <!-- Encabezado -->
                        <div class="sidebar-heading">
                        Cerrar sesión  
            </div>


            <!-- Elemento de navegación - Menú de colapso de utilidades -->
            <li class="nav-item">
            <a class="nav-link" href="logout.php" data-toggle="modal"
                data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                Cerrar sesión 
            </a>
            </li>
            <style>
                .nav-link {
                    font-size: 14px; /* o cualquier otro tamaño deseado */
                }
            </style>
            

            <!-- Separador -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Barra lateral Toggle (Barra lateral) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>



        <!-- Envoltura de contenido -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Contenido principal -->
            <div id="content">

                <!-- Barra superior -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Barra lateral Toggle (Barra superior) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Navbar de la barra superior -->

                    <!-- Navbar de la barra superior -->
                    <ul class="navbar-nav ml-auto">
                        <?php
                        include '../config/conexion.php';

                        // Verificar conexión
                        if ($conn->connect_error) {
                            die("Error de conexión: " . $conn->connect_error);
                        }

                        // Consulta para obtener los datos de la tabla recuperacion
                        $sql = "SELECT * FROM recuperacion";
                        $result = $conn->query($sql);

                        // Contar el número de notificaciones
                        $num_notificaciones = $result->num_rows;

                        // Cerrar conexión
                        $conn->close();
                        ?>

                        <!-- Elemento de navegación - Alertas -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Contador - Alertas -->
                                <span class="badge badge-danger badge-counter">
                                    <?php echo $num_notificaciones; ?>
                                </span>
                            </a>
                            <!-- Menú desplegable - Alertas -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notificaciones
                                </h6>
                                <?php
                                // Verificar si se encontraron resultados
                                if ($num_notificaciones > 0) {
                                    // Mostrar las notificaciones en una lista
                                    while($row = $result->fetch_assoc()) {
                                        echo '<a class="dropdown-item d-flex align-items-center" href="recuperacion_empleado.php?id=' . $row["id"] . '">';
                                        echo '<div class="mr-3">';
                                        echo '<div class="icon-circle bg-warning">';
                                        echo '<i class="fas fa-exclamation-triangle text-white"></i>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div>';
                                        echo '<div class="small text-gray-500">Solicitud de recuperación de ' . $row["nombre"] . '</div>';
                                        echo '</div>';
                                        echo '</a>';
                                    }
                                } else {
                                    // Si no hay notificaciones
                                    echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                                    echo '<div>No hay notificaciones.</div>';
                                    echo '</a>';
                                }
                                ?>
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="recuperaciones.php">Mostrar todas las notificaciones</a>
                            </div>
                        </li>


                        <!-- Elemento de navegación - Información del usuario -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php 
                                    if (isset($_SESSION['usuario'])) {
                                        echo $_SESSION['usuario']; // Mostrar el nombre de usuario si está definido en la sesión
                                    } else {
                                        echo 'Usuario'; // Mostrar un texto predeterminado si el nombre de usuario no está definido
                                    }
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="../svg/perfil.png">
                            </a>
                        </li>


                            <!-- Menú desplegable - Información del usuario -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="editar_datos.php">
                                    <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Editar datos
                                </a>




                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- Fin de la barra superior -->


                <!-- Modal de cierre de sesión-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para
                                finalizar su sesión actual.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                <a class="btn btn-primary" href="logout.php">Salir</a>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Botón de desplazamiento hacia arriba -->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <script src="../vendor/jquery/jquery.min.js"></script>
                <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- JavaScript del complemento principal -->
                <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Scripts personalizados para todas las páginas-->
                <script src="../js/sb-admin-2.min.js"></script>

                <!-- Plugins de nivel de página -->
                <script src="../vendor/chart.js/Chart.min.js"></script>

                <!-- Scripts personalizados de nivel de página -->
                <script src="../js/demo/chart-area-demo.js"></script>
                <script src="../js/demo/chart-pie-demo.js"></script>