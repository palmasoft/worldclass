<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificacion de Contrato</title>
</head>
<body>
    <center>
        <strong>
            Verificacion  
            {{ $contrato->verificado }} del contrato {{ $contrato->sede.$contrato->consecutivo  }} 
        </strong>
    </center>
    <hr>
    La verificacion del contrato a sido realizada por <strong>
        {{ Auth::user()->name }}
    </strong>.
    <br>
    Comentario:
    <br>
    <center>
        "{{ $comentario }}"
    </center>.
</body>
</html>