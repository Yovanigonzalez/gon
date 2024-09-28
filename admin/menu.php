<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <!-- AdminLTE CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">

    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" href="../log/logo.jpg" type="image/jpeg">


    <style>
    body, .nav-link, .brand-text {
      font-family: 'Montserrat', sans-serif;
    }

    .hr-blanco {
            border: none; /* Elimina los bordes predeterminados */
            height: 1px; /* Altura de la línea */
            background-color: white; /* Color de fondo de la línea */
            margin: 20px 0; /* Espaciado superior e inferior */
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
  <span class="brand-text font-weight-light">Administrador</span>
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



    <!-- Agregar Clientes -->
    <li class="nav-item">
      <a href="agregar_cliente" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Agregar Clientes
        </p>
      </a>
    </li>

        <!-- Agregar Productos -->
        <li class="nav-item">
      <a href="canastilla" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
          Canastilla Patsa
        </p>
      </a>
    </li>

    <hr class="hr-blanco">

    <!-- Agregar Productos -->
    <li class="nav-item">
      <a href="agregar_productos_pollo" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
        Agregar  Productos (Pollo)
        </p>
      </a>
    </li>

            <!-- Agregar Productos -->
            <li class="nav-item">
      <a href="agregar_productos_menudencia" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
          Agregar Productos (Menudencia)
        </p>
      </a>
    </li>


    <hr class="hr-blanco">


        <!-- Agregar Entradas -->
        <li class="nav-item">
      <a href="agregar_entradas" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
        Agregar Entradas
        </p>
      </a>
    </li>


    <hr class="hr-blanco">

        <!-- Pedidos -->
        <li class="nav-item">
      <a href="pedidos" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
          Agregar Pedidos
        </p>
      </a>
    </li>

    

        <!-- Nuevo elemento para descargar PDF -->
        <li class="nav-item">
    <a href="../pdf/manual_admin.pdf" class="nav-link" download>
        <i class="nav-icon fas fa-file-pdf"></i>
        <p>
            Manual
        </p>
    </a>
</li>


        <!-- Nuevo elemento para descargar PDF -->
        <li class="nav-item">
    <a href="logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
            Cerrar Sesión
        </p>
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

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
