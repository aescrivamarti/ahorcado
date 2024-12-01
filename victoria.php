<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Victoria - Juego del Ahorcado</title>
    <!-- Importación de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #4caf50, #81c784);
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #6200ea;
            color: white;
            padding: 20px;
            margin: 0;
            font-size: 28px;
        }

        .container {
            margin: 20px auto;
            max-width: 600px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease;
        }

        .message {
            font-size: 20px;
            padding: 10px;
            margin: 10px 0;
            color: #2e7d32;
            font-weight: bold;
        }

        .play-again a {
            text-decoration: none;
            background-color: #6200ea;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            font-weight: bold;
        }

        .play-again a:hover {
            background-color: #3700b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h1>¡Has ganado!</h1>
    <div class="container">
        <div class="message">
            ¡Felicidades! Has acertado la palabra secreta
        </div>
        <div class="play-again">
            <a href="index.php?reiniciar=1">Jugar de nuevo</a>
        </div>
    </div>
</body>
</html>
