<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../img/peligro.png">
    <title>Error 404</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: #333333;
        }
        .error-container {
            text-align: center;
            background: white;
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }
        .error-code {
            font-size: 72px;
            font-weight: bold;
            color: #dc3545;
            margin: 0;
        }
        .error-message {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            color: #666666;
        }
        p {
            margin: 10px 0;
            color: #666666;
        }
        .error-image {
            margin: 20px 0;
            width: 200px;
            height: auto;
        }

                /* Media Queries for Responsiveness */
                @media (max-width: 768px) {
            .error-container {
                padding: 20px;
            }
            .error-code {
                font-size: 48px;
            }
            .error-message {
                font-size: 18px;
            }
            .error-image {
                width: 150px;
            }
        }
        @media (max-width: 480px) {
            .error-code {
                font-size: 36px;
            }
            .error-message {
                font-size: 16px;
            }
            .error-image {
                width: 100px;
            }
            p {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">Error 404</h1>
        <img src="../imgs/candado.png" alt="Acceso denegado" class="error-image">
        <p class="error-message">¡Acceso denegado!</p>
        <p>Lo sentimos, no tienes permiso para acceder a esta página.</p>
    </div>
</body>
</html>
