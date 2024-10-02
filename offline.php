<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sin conexión a Internet</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="403.png">

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #FFF;
      color: #333;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 80vh; /* Establece el cuerpo para ocupar toda la altura de la ventana */
      margin: 0; /* Elimina el margen predeterminado del cuerpo */
      padding: 50px;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    img {
      max-width: 5%;
      height: auto;
    }

    /* Media query para pantallas pequeñas */
    @media screen and (max-width: 600px) {
      h1 {
        font-size: 24px;
        text-align: center;
      }

      p {
        font-size: 16px;
        text-align: center;
      }

      img {
        max-width: 10%;
      }
    }
  </style>
</head>
<body>
  <h1>¡Ups! Parece que no estás conectado a Internet.</h1>
  <p>Por favor, revisa tu conexión y vuelve a intentarlo.</p>
  <img src="403.png" alt="Error 403">
</body>
</html>
