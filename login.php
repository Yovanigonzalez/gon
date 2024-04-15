<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <link href="css/login.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts - Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="login-form">
        <h2 class="text-center mb-4" style="font-family: 'Montserrat', sans-serif;">Iniciar Sesión</h2>
        <form id="loginForm" action="#" method="post">
          <div class="form-group">
            <label for="email" style="font-family: 'Montserrat', sans-serif;">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div id="emailError" class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="password" style="font-family: 'Montserrat', sans-serif;">Contraseña:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" required>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" style="font-family: 'Montserrat', sans-serif;">Iniciar Sesión</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="js/login.js"></script>

</body>
</html>
