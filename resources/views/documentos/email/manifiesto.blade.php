<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Manifiesto {{ @$sede }}</title>
</head>
<body>
    <table style="border-spacing: 0px; border-style: solid;">
        <thead>
            <tr>
                <th  style="border-spacing: 0px; border-bottom-style: solid;" colspan="3">
                    REPORTE SALA {{ @$sede }}
                </th>
            </tr>
            <tr>
                <th  style="border-spacing: 0px; border-bottom-style: solid;" colspan="3">
                    {{ @$sede }}
                </th>
            </tr>
            <tr>
                <th  style="border-spacing: 0px; border-style: solid; background-color: aqua;">
                    MENU
                </th>
                <th  style="border-spacing: 0px; border-style: solid; background-color: aqua;">
                    Cantidad
                </th>
                <th  style="border-spacing: 0px; border-style: solid; background-color: aqua;">
                    TOTAL
                </th>
            </tr>
        </thead>
        <tbody>
            @if (@$items)
                @foreach ($items as $item)
                    <tr>
                        <td>
                            {{ $item['nombre'] }}
                        </td>
                        <td>
                            {{ $item['cantidad'] }}
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th  style="border-spacing: 0px; border-style: solid; background-color: aqua;">
                    Nro. de Factura
                </th>
                <th style="border-spacing: 0px; border-style: solid;">
                    {{ @$factura }}
                </th>
                <th style="border-spacing: 0px; border-style: solid;">
                    {{ @$total }}
                </th>
            </tr>
        </tfoot>
    </table>
</body>
</html>