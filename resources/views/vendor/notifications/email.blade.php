<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecimiento de Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f4f4; font-family: Arial, sans-serif;">

<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.1);">

    <h1 style="text-align: center; color: #333;">Restablecimiento de Contraseña</h1>

    <p>¡Hola!</p>

    <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Si no has realizado esta solicitud, puedes ignorar este mensaje.</p>

    <p>Para restablecer tu contraseña, haz clic en el siguiente botón:</p>

    <p style="text-align: center;">
        <a href="{{ $actionUrl }}" class="btn btn-primary">Restablecer Contraseña</a>
    </p>

    <p>Si tienes problemas al hacer clic en el botón, copia y pega la siguiente URL en tu navegador web:</p>

    <p><a href="{{ $actionUrl }}">{{ $actionUrl }}</a></p>

    <p>Saludos,</p>
    <p>{{$business->name}}</p>
    <span>{{$business->mail}}</span><br>
    <span>{{$business->address}}</span><br>
    <span>{{$business->phone}}</span>
</div>
<footer class="footer">
    <div class="col-lg-12 login-half-bg d-flex flex-row justify-content-center">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
            Todos los derechos reservados.&nbsp;</span>
    </div>
</footer>
</body>
</html>
