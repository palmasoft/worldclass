<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tiket #{{ @$tiket->id }}</title>
</head>
<body>
    <center>
        <strong>
            Respuesta al Tiket #{{ @$tiket->id }}
        </strong>
        <hr>
        Respuesta al Tiket con asunto "{{ @$tiket->asunto }}". 
        <hr>
        Mensaje enviado por 
        @if ($tiket->estado == 1)
            <strong>SERVICIO AL CLIENTE</strong>
        @else
            <strong>Afiliado</strong>
        @endif
        <br>
        <strong>Mensaje:</strong>
        <br>
        <p>
            {{ $mensaje->mensaje }}
        </p>
    </center>
</body>
</html>