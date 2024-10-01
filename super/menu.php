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
  <span class="brand-text font-weight-light">Super Administrador</span>
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

    
    <!-- Agregar Usuarios -->
<li class="nav-item">
  <a href="usuarios" class="nav-link">
    <i class="nav-icon fas fa-user-plus"></i>
    <p>
      Agregar Usuarios
    </p>
  </a>
</li>


        <!-- Agregar Deudores -->
        <li class="nav-item">
      <a href="deudores" class="nav-link">
        <i class="nav-icon fas fa-money-bill-wave"></i>
        <p>
          Agregar Dedudores
        </p>
      </a>
    </li>

            <!-- Agregar Deudores Cajas -->
            <li class="nav-item">
      <a href="deudores_cajas" class="nav-link">
        <i class="nav-icon fas fa-money-bill-wave"></i>
        <p>
           + Deudas Cajas
        </p>
      </a>
    </li>

    <!-- Localizador de Notas -->
    <li class="nav-item">
  <a href="actualizar_inventario" class="nav-link">
    <i class="nav-icon fas fa-box"></i>
    <p>
      Actualizar Inventario
    </p>
  </a>
</li>




        <!-- Nuevo elemento para descargar PDF -->
        <li class="nav-item">
      <a href="../pdf/" class="nav-link">
        <i class="nav-icon fas fa-file-pdf"></i>
        <p>
          Descargar PDF (Manual)
        </p>
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

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
