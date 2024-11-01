<?php
session_start();
// Resto del código de login.php

if (empty($_SERVER['HTTP_REFERER'])) {
    // El acceso se está realizando directamente desde la URL
    header('Location: 404');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="../job_js/scss/menu.css">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <!-- AdminLTE CSS -->
  <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">--> 
  <link rel="stylesheet" href="../job_js/scss/adminlte.css">

    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" href="../log/logo.jpg" type="image/jpeg">


    <style>
    body, .nav-link, .brand-text {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Enlaces de navegación izquierdos -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Contenedor del Sidebar Principal -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo de la Marca -->
    <a href="#" class="brand-link text-center">
  <span class="brand-text font-weight-light">Mostrador</span>
</a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Menú del Sidebar -->
<!-- Menú del Sidebar -->
<!-- Menú del Sidebar -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Agrega iconos a los enlaces utilizando la clase .nav-icon con Font Awesome o cualquier otra biblioteca de iconos -->
    <li class="nav-item">
      <a href="admin" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Panel de Control
        </p>
      </a>
    </li>

    <!-- Verificador de Notas -->
<li class="nav-item">
    <a href="facturas" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>
            Verificador de Notas
        </p>
    </a>
</li>

    <!-- Agregar Clientes -->
    <li class="nav-item">
      <a href="mostrador" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Ventas a mostrador
        </p>
      </a>
    </li>

    <!-- Agregar Actualizar Deuda -->
<li class="nav-item">
  <a href="actualizar_deuda" class="nav-link">
    <i class="nav-icon fas fa-edit"></i>
    <p>
      Actualizar Deuda
    </p>
  </a>
</li>

    
    <!-- Agregar Productos -->
    <li class="nav-item">
      <a href="canastilla" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
          Canastilla
        </p>
      </a>
    </li>

    <?php
include '../config/conexion.php';

// Consulta para contar las notas con estatus 'pendiente' en la tabla 'notas'
$sql = "SELECT COUNT(*) as total_pendientes FROM notas WHERE estatus = 'pendiente'";
$result = $conn->query($sql);
$pendientes = 0;

if ($result && $row = $result->fetch_assoc()) {
    $pendientes = $row['total_pendientes'];
}
?>


<!-- Agregar Notas -->
<li class="nav-item">
  <a href="notas" class="nav-link">
    <i class="nav-icon fas fa-clipboard"></i>
    <p>
      Notas
      <span class="badge badge-warning"><?php echo $pendientes; ?></span>
    </p>
  </a>
</li>



<?php
include '../config/conexion.php';

// Consulta para contar los pedidos con estatus 'PENDIENTE' en la tabla 'pedidos'
$sql_pedidos = "SELECT COUNT(*) as total_pendientes_pedidos FROM pedidos WHERE estatus = 'PENDIENTE'";
$result_pedidos = $conn->query($sql_pedidos);
$pendientes_pedidos = 0;

if ($result_pedidos && $row_pedidos = $result_pedidos->fetch_assoc()) {
    $pendientes_pedidos = $row_pedidos['total_pendientes_pedidos'];
}
?>

<!-- Pedidos -->
<li class="nav-item">
  <a href="detalles_pedidos" class="nav-link">
    <i class="nav-icon fas fa-shopping-cart"></i>
    <p>
      Ver Pedidos
      <span class="badge badge-warning"><?php echo $pendientes_pedidos; ?></span>
    </p>
  </a>
</li>

    <!-- Eventos -->
<li class="nav-item">
    <a href="eventos" class="nav-link">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
            Agregar Eventos
        </p>
    </a>
</li>


<li class="nav-item">
    <a href="gastos" class="nav-link">
        <i class="nav-icon fas fa-wallet"></i> <!-- Puedes cambiar el ícono si deseas -->
        <p>
            Gastos
        </p>
    </a>
</li>
    

    <!-- Agregar Productos -->
    <li class="nav-item">
      <a href="canastilla_patsa" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
          Canastilla Patsa
        </p>
      </a>
    </li>


    <!-- Nota Vacía -->
<li class="nav-item">
  <a href="nota_vacia" class="nav-link">
    <i class="nav-icon fas fa-file-alt"></i>
    <p>Nota Vacía</p>
  </a>
</li>

<!-- Corte de Caja -->
<li class="nav-item">
  <a href="corte_caja" class="nav-link">
    <i class="nav-icon fas fa-cash-register"></i>
    <p>Corte de Caja</p>
  </a>
</li>

  <!-- Inventario -->
  <li class="nav-item">
    <a href="inventario" class="nav-link">
      <i class="nav-icon fas fa-archive"></i>
      <p>Inventario</p>
    </a>
  </li>

<!-- Cerrar Sesión -->
<li class="nav-item">
  <a href="logout" class="nav-link">
    <i class="nav-icon fas fa-sign-out-alt"></i>
    <p>Cerrar Sesión</p>
  </a>
</li>

  </ul>
</nav>
<!-- /.sidebar-menu -->
<!-- /.sidebar-menu -->
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS en caso de fallar la recuperacion solo sera cambiar las llaves ya que el codigi estara en 'exception_job' -->
    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>

    <!-- Bootstrap 4 -->
    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>-->
    <script src="../job_js/bj.js"></script>

    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>

    <!-- AdminLTE App -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>-->
    <script src="../job_js/admin.js"></script>
