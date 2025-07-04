<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Codigo de confirmacion de producto</title>
</head>
<body>
    Use este codigo "{{ $factura->codigo }}" para continuar el proseso de la venta con id: {{ $factura->numero }}.

    <br>
    <br>
    <a href="{{url('/productos-cliente'.'/'.$factura->cliente_id)}}">Reviselo aqui.</a>
</body>
</html>