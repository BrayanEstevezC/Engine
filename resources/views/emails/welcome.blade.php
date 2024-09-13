<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a nuestra aplicación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a90e2;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4a90e2;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenido a EngineAir</h1>
        </div>
        <div class="content">
            <h2>Hola {{ $user->name }},</h2>
            <p>Gracias por registrarte en nuestra aplicación. Estamos emocionados de tenerte con nosotros.</p>
            <p>Tu cuenta ha sido creada con éxito. Aquí están los detalles de tu cuenta:</p>
            <ul>
                <li>Nombre: {{ $user->name }}</li>
                <li>Correo electrónico: {{ $user->email }}</li>
            </ul>
            <p>Por favor, haz clic en el siguiente botón para verificar tu dirección de correo electrónico:</p>
            <p>
                <a href="{{ route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]) }}" class="button">Verificar correo electrónico</a>
            </p>
            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
            <p>¡Gracias por unirte a nosotros!</p>
            <p>El equipo de EngineAir</p>
        </div>
    </div>
</body>
</html>