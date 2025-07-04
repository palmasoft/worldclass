<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de Producto</title> 
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <center>
        <img src="{{ asset('images/oneclasslogo.png') }}" height="75">
    </center>

    Prefactura No: {{ $factura->numero }}
    <br>
    Consumidor: {{ @$factura->nombre.' '.@$factura->apellido }}
    <br>
    Cedula de Consumidor: {{ @$factura->cedula }}
    <br>
    Email del Consumidor: {{ @$factura->email }}

    <br>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Valor Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if ($productos)
                @foreach ($productos as $producto)
                    <tr>
                        <td>
                            {{ $producto->producto }}
                        </td>
                        <td>
                            {{ $producto->valor_unitario }}
                        </td>
                        <td>
                            {{ $producto->cantidad }}
                        </td>
                        <td>
                            {{ $producto->valor }}
                        </td>
                    </tr>                    
                @endforeach
            @endif
            <tr>
                <td colspan="2"></td>
                <td>
                    <strong>Descuento</strong>
                </td>
                <td>
                    {{ $factura->descuento }}
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <strong>I.V.A.</strong>
                </td>
                <td>
                    {{ $factura->iva }}
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <strong>TOTAL</strong>
                </td>
                <td>
                    {{ $factura->total }}
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>