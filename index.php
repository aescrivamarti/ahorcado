<?php
session_start();

// Lista de palabras para el juego
$palabras = ['elefante', 'jirafa', 'hipopotamo', 'rinoceronte', 'cocodrilo', 'camello', 'chimpance'];

// Inicializar el juego
if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = $palabras[array_rand($palabras)];
    $_SESSION['vidas'] = 6; // Número máximo de vidas
    $_SESSION['letras_acertadas'] = str_repeat('?', strlen($_SESSION['palabra']));
    $_SESSION['letras_usadas'] = [];
}

// Procesar la letra enviada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['letra'])) {
    $letra = strtolower($_POST['letra']);

    // Verificar si la letra ya se ha usado
    if (in_array($letra, $_SESSION['letras_usadas'])) {
        $mensaje = "Ya has usado la letra '$letra'. Intenta con otra.";
    } else {
        // Añadir la letra a las usadas
        $_SESSION['letras_usadas'][] = $letra;

        // Verificar si la letra está en la palabra secreta
        if (strpos($_SESSION['palabra'], $letra) !== false) {
            for ($i = 0; $i < strlen($_SESSION['palabra']); $i++) {
                if ($_SESSION['palabra'][$i] == $letra) {
                    $_SESSION['letras_acertadas'][$i] = $letra;
                }
            }
        } else {
            $_SESSION['vidas']--;
        }
    }
}

// Comprobar si se ha ganado o perdido
if ($_SESSION['letras_acertadas'] == $_SESSION['palabra']) {
    echo "<div class='message success'>¡Enhorabuena! Has ganado :) La palabra era: " . $_SESSION['palabra'] . "</div>";
    session_destroy();
    echo '<div class="play-again"><a href="">Jugar de nuevo</a></div>';
    exit();
} elseif ($_SESSION['vidas'] <= 0) {
    echo "<div class='message error'>Lo siento, has perdido :( La palabra era: " . $_SESSION['palabra'] . "</div>";
    session_destroy();
    echo '<div class="play-again"><a href="">Jugar de nuevo</a></div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego del Ahorcado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .message {
            font-size: 18px;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .play-again a {
            text-decoration: none;
            background-color: #6200ea;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        p {
            font-size: 16px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #6200ea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #3700b3;
        }

        .vidas {
            font-weight: bold;
            color: #e53935;
        }

        .letras-usadas {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Juego del Ahorcado</h1>
    <div class="container">
        <p>Palabra secreta: <span class="word"><?php echo $_SESSION['letras_acertadas']; ?></span></p>
        <p>Vidas restantes: <span class="vidas"><?php echo $_SESSION['vidas']; ?></span></p>
        <?php if (!empty($mensaje)) echo "<div class='message'>$mensaje</div>"; ?>
        <form method="post">
            <label for="letra">Introduce una letra:</label><br>
            <input type="text" name="letra" id="letra" maxlength="1" required><br>
            <button type="submit">Adivinar</button>
        </form>
        <div class="letras-usadas">
            Letras usadas: <?php echo implode(', ', $_SESSION['letras_usadas']); ?>
        </div>
    </div>
</body>
</html>
