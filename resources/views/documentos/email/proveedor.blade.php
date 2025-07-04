<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>One Class Travel</title>
</head>
<body>
    Emicion
    
    <center>
        @if (@$datos->record)
            <br>    
            <hr>
            <br>

            <strong>Vuelo</strong>
            <br>
            <table style="border-collapse: collapse;border: 1px solid black;">
                <tbody>
                    <tr>
                        <td>
                            <strong>
                                Tipo de servicio (emisión, reemisión o anulación):
                            </strong>
                        </td>
                        <td>
                            {{@$datos->servicio}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Boletos (nacionales o internacionales):
                            </strong>
                        </td>
                        <td>
                            {{@$datos->boletos}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Adultos:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->adultos}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Ni&ntilde;os:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->ninos}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Tercera Edad:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->ancianos}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                    Record localizador:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->record}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Forma de pago (trasferencia, depósito, tarjeta de crédito, en caso de ser mixto especificar valores):
                            </strong>
                        </td>
                        <td>
                            {{@$datos->formaPago}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Valor total a pagar (No incluir intereses en caso de ser diferido)
                            </strong>
                        </td>
                        <td>
                            {{@$datos->total}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Agente incentivo (nombre y número de cédula)
                            </strong>
                        </td>
                        <td>
                            {{@$datos->agenteNombre.' '.@$datos->agenteCedula}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Asesor agencia  que solicita
                            </strong>
                        </td>
                        <td>
                            {{@$datos->asesor}}
                        </td>
                    </tr>
                    @if (@$datos->pagoTc)
                        <tr>
                            <td>
                                <strong>
                                    Valor a pagar con Tarjeta:
                                </strong>
                            </td>
                            <td>
                                {{@$datos->pagoTc}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                        Valor Interés (en caso de ser diferido):
                                </strong>
                            </td>
                            <td>
                                {{@$datos->interesTc}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Diferido(Meses):
                                </strong>
                            </td>
                            <td>
                                {{@$datos->diferido}} Meses
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Valor a pagar, incluido el interés
                                </strong>
                            </td>
                            <td>
                                {{@$datos->totalTc}}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endif
        @if (@$datos->recordLan)
            <br>    
            <hr>
            <br>
            <strong>Servicios Terrestres</strong>
            <br>
            <table style="border-collapse: collapse;border: 1px solid black;">
                <tbody>
                    <tr>
                        <td>
                            <strong>
                                SERVICIO:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->servicioLan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                RECORD:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->recordLan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                TARIFA COTIZADA:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->cotizado}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                VALOR A PAGAR:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->pagoLan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Forma de pago:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->formaPagoLan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Agente incentivo (nombre y número de cédula)
                            </strong>
                        </td>
                        <td>
                            {{@$datos->agenteNombreLan.' '.@$datos->agenteCedulaLan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Asesor agencia  que solicita
                            </strong>
                        </td>
                        <td>
                            {{@$datos->asesorLan}}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
        @if (@$datos->reservaX)
            <br>    
            <hr>
            <br>
            <strong>SOLICITUD DE SERVICIOS</strong>
            <br>
            <table style="border-collapse: collapse;border: 1px solid black;">
                <tbody>
                    <tr>
                        <td>
                            <strong>
                                SERVICIO:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->servicioX}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                RESERVA:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->reservaX}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                VALOR A PAGAR:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->pagoX}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Forma de pago:
                            </strong>
                        </td>
                        <td>
                            {{@$datos->formaPagoX}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Asesor agencia  que solicita
                            </strong>
                        </td>
                        <td>
                            {{@$datos->asesorX}}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </center>
</body>
</html>