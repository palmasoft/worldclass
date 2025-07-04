@extends('layouts.app')

@section('content')
<div class="container m-2">
    
    <strong>
        <h2>
            Soporte Técnico via WhatsApp
        </h2>
    </strong>
    <hr>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row" style="padding:0em 2em 0em 0em;">
                <div class="col-xs-9" style="padding-right: 2em;text-align:justify;">
                    <h2>
                        ¿Necesitas asistencia técnica?
                    </h2>
                   <p>
                       Por favor ten en cuenta que en algunas ocasiónes <b>podríamos estar atendiendo varios chats</b>, en esos casos no atenderemos tu solicitud hasta que estemos listos para brindarte atención completa y enfocada.
                   </p>
                   <p>
                        <p>
                           <b>
                               Al solicitar soporte vía WhatsApp asegurate de tener presente lo siguiente:
                            </b>
                        </p>
                        <p>
                            <ul>
                                <li>Debes contactarnos desde el numero de WhatsApp que tienes registrado en tu cuenta.</li>
                                <li>No atendemos ningun tipo de llamada telefónica, nunca.</li>
                                <li>Si no te respondemos de inmediato se debe a que estamos atendiendo otro chat en ese momento, te pedimos por favor esperes por nuestra respuesta, enviar varios mensajes insistiendo una respuesta no apresurará la misma.</li>
                                <li>No nos incluyas en ningun grupo o listas de difusión, podrias bloquear tu numero.</li>
                                <li>Asegurate de brindar todos los detalles de tu incidencia, mientras mas detalles mas rápida y efectiva será la atención.</li>    
                            </ul>
                        </p>
                   </p>
                </div>
                <div class="col-xs-3 ">
                    <img src="{{ asset('images/icons/whatsapp1.png') }}" class="pull-right img-responsive">
                </div>
                   
            </div>  
            <hr>
            <div>    
                <a class="btn btn-primary" href="https://web.whatsapp.com/send?phone=593930706329&text=Hola%20Necesito%20Soporte%20Técnico." target="_blank">
                    Iniciar Chat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection