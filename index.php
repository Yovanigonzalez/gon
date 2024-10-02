<?php include 'check_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="icon" href="log/logo.jpg" type="image/jpeg">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Montserrat', sans-serif;
      background-color: #fff;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .left {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #fff;
    }

    .login-form {
      background-color: white;
      padding: 3rem;
      border-radius: 10px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      width: 600px;
      text-align: center;
      height: auto;
    }

    .login-form h2 {
      margin-bottom: 1.5rem;
      font-weight: 600;
      font-size: 1.8rem;
    }

    .login-form p {
      font-size: 1rem;
      color: #555;
      margin-bottom: 2rem;
    }

    .login-form label {
      display: block;
      text-align: left;
      margin-bottom: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
    }

    .login-form input {
      width: 100%;
      padding: 12px;
      margin-bottom: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      font-family: 'Montserrat', sans-serif;
    }

    .login-form small {
      display: block;
      margin-bottom: 1.2rem;
      font-size: 0.85rem;
      color: #777;
    }

    .login-form button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      border: none;
      color: white;
      font-size: 1.1rem;
      border-radius: 6px;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
    }

    .login-form button:hover {
      background-color: #0056b3;
    }

    .login-form .date-time {
      margin-top: 2rem;
      font-size: 0.9rem;
      color: #777;
    }

    .right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right img {
      max-width: 80%;
      background: #fff;
      height: auto;
    }

    .alert-danger {
        border-radius: 50px;
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sección izquierda con el formulario -->
    <div class="left">
      <div class="login-form">
        <h2>Iniciar Sesión</h2>
        <p>Es necesario iniciar sesión para acceder a la plataforma</p>
        <form action="validacion" method="POST">
        <?php
                                      if (isset($_GET['mensaje_exito'])) {
                                          $mensaje_exito = $_GET['mensaje_exito'];
                                          echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
                                      } elseif (isset($_GET['mensaje_error'])) {
                                          $mensaje_error = $_GET['mensaje_error'];
                                          echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                                      }
                                      ?>

          <label for="email">Correo electrónico:</label>
          <input type="email" name="email" id="email" placeholder="Ingrese su correo electrónico" required>
          <small align="left">Ingrese su correo corporativo.</small>
          
          <label for="password">Contraseña:</label>
          <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>
          <small align="left">Escriba la contraseña corporativa.</small>
          
          <button type="submit">Ingresar</button>
        </form>
        <div class="date-time">
          Fecha y hora actual: <span id="currentDateTime"></span> (GMT-6)
        </div>
      </div>
    </div>
    <!-- Sección derecha con la imagen -->
    <div class="right">
      <img src="font/logo.png" alt="Imagen de la empresa">
    </div>
  </div>

</body>
</html>

<script>
    // Función para obtener y mostrar la fecha y hora actual en GMT-6
    function updateDateTime() {
      const now = new Date();
      const options = {
        timeZone: 'America/Mexico_City',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      };
      const dateTime = now.toLocaleString('es-MX', options);
      document.getElementById('currentDateTime').textContent = dateTime;
    }

    // Actualiza la fecha y hora cada segundo
    setInterval(updateDateTime, 1000);
    updateDateTime(); // Llamada inicial para mostrar la fecha y hora inmediatamente
  </script>