<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'WORDSCLASS') }}</title>-->
    <title> WORLDCLASS</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/w3.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style-nav.css') }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/oneclasslogo.png') }}" /> 
</head>
<body>
    <div id="app">
        <div id="wrapper" class="active">
            <div id="sidebar-wrapper" >
                <ul id="sidebar_menu" class="sidebar-nav">
                   <li class="sidebar-brand"><a id="menu-toggle" href="#">
                        Menu
                        <font-awesome-icon icon="bars" class="float-right" style="margin-top: .5em; margin-right: 1em; font-size: 1.5em;"></font-awesome-icon>
                    </li>
                </ul>
                <ul class="sidebar-nav" id="sidebar">
                    <li>
                        <a href="{{url('/home')}}" class="text-responsive">
                            Inicio
                            <font-awesome-icon icon="home" class="float-right estilo-menu-nor"></font-awesome-icon>
                        </a>
                    </li>
                    @role('afiliado')

                        <li>
                            <a href="{{url('/mis-servicios')}}" class="text-responsive">
                                Servicios
                                <font-awesome-icon icon="home" class="float-right estilo-menu-nor"></font-awesome-icon>
                            </a>
                        </li>
                        <div class="" id="accordionExample0">
                            <li>
                                <a data-toggle="collapse" href="#collapse0" class="text-responsive">
                                    Servicio al Cliente
                                    <font-awesome-icon icon="sort-down" class="float-right estilo-menu-nor2"></font-awesome-icon>
                                </a>
                            </li>
                            <div id="collapse0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample0">
                                <li>
                                    <ul style="padding: 0;margin: 0">
                                        <li class="">
                                            <a href="{{url('/mis-tikets')}}" class="text-responsive">
                                                Solicitudes
                                                <font-awesome-icon icon="cog" class="float-right estilo-menu-peq"></font-awesome-icon>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{url('/whatsapp')}}" class="text-responsive">
                                                WhatsApp
                                                <font-awesome-icon icon="exchange-alt" class="float-right estilo-menu-peq"></font-awesome-icon>
                                            </a>
                                        </li>
                                        <!--<li class="">
                                            <a href="{{url('/foro-soporte')}}" class="text-responsive">
                                                Foro de Soporte
                                                <font-awesome-icon icon="exchange-alt" class="float-right estilo-menu-peq"></font-awesome-icon>
                                            </a>
                                        </li>-->
                                    </ul>
                                </li>
                            </div>
                        </div>

                    @else
                        
                        @canatleast(['configuracion','cargo.index','user.index','role.index'])
                            <div class="" id="accordionExample0">
                                <li>
                                    <a data-toggle="collapse" href="#collapse0" class="text-responsive">
                                        Panel de Control
                                        <font-awesome-icon icon="sort-down" class="float-right estilo-menu-nor2"></font-awesome-icon>
                                    </a>
                                </li>
                                <div id="collapse0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample0">
                                    <li>
                                        <ul style="padding: 0;margin: 0">
                                            @can('configuracion')
                                                <li class="">
                                                    <a href="{{url('/configuracion')}}" class="text-responsive">
                                                        Configuracion
                                                        <font-awesome-icon icon="cog" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('cargo.index')
                                                <li class="">
                                                    <a href="{{url('/cargos')}}" class="text-responsive">
                                                        Cargos
                                                        <font-awesome-icon icon="exchange-alt" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('role.index')
                                                <li class="">
                                                    <a href="{{url('/roles')}}" class="text-responsive">
                                                        Roles
                                                        <font-awesome-icon icon="user" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>                                            
                                            @endcan
                                            @can('user.index')
                                                <li class="">
                                                    <a href="{{url('/usuarios')}}" class="text-responsive">
                                                        Usuarios
                                                        <font-awesome-icon icon="users" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>                                            
                                            @endcan
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        @endcanatleast
                            
                        @canatleast(['afiliado','foro'])
                            <div class="" id="accordionExampleservi">
                                <li>
                                    <a data-toggle="collapse" href="#collapseservi" class="text-responsive">
                                        Servicio al Cliente
                                        <font-awesome-icon icon="sort-down" class="float-right estilo-menu-nor2"></font-awesome-icon>
                                    </a>
                                </li>
                                <div id="collapseservi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExampleservi">
                                    <li>
                                        <ul style="padding: 0;margin: 0">
                                            @can('afiliado')
                                                <li class="">
                                                    <a href="{{url('/afiliados')}}" class="text-responsive">
                                                        Afiliados
                                                        <font-awesome-icon icon="cog" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>                                                
                                            @endcan
                                            @can('foro')
                                                <!--<li class="">
                                                    <a href="{{url('/foro-soporte')}}" class="text-responsive">
                                                        Foro
                                                        <font-awesome-icon icon="exchange-alt" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>-->                                                
                                            @endcan
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        @endcanatleast

                        @can('empleado.index')
                            <li>
                                <a href="{{url('/empleados')}}" class="text-responsive">
                                    Empleados
                                    <font-awesome-icon icon="users" class="float-right estilo-menu-nor"></font-awesome-icon>
                                </a>
                            </li>
                        @endcan
                        
                        @can('reportes.excel')
                            <li>
                                <a href="{{url('/reportes')}}" class="text-responsive">
                                    Reportes
                                    <font-awesome-icon icon="files" class="float-right estilo-menu-nor"></font-awesome-icon>
                                </a>
                            </li>
                        @endcan
                          
                        @can('nomina.index')
                            <li>
                                <a href="{{url('/nomina')}}" class="text-responsive">
                                    Nomina
                                    <font-awesome-icon icon="file" class="float-right estilo-menu-nor"></font-awesome-icon>
                                </a>
                            </li>
                        @endcan

                        @can('cartera.index')
                            <li>
                                <a href="{{url('/cartera')}}" class="text-responsive">
                                    Cartera
                                    <font-awesome-icon icon="wallet" class="float-right estilo-menu-nor"></font-awesome-icon>
                                </a>
                            </li>
                        @endcan
                        
                        @canatleast(['invitado.store','invitado.index','invitado.index2','invitado.index3','invitado.index4'])
                            <div class="" id="accordionExample">
                                <li>
                                    <a data-toggle="collapse" href="#collapse" class="text-responsive">
                                        Invitados
                                        <font-awesome-icon icon="sort-down" class="float-right estilo-menu-nor2"></font-awesome-icon>
                                    </a>
                                </li>
                                <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <li>
                                        <ul style="padding: 0;margin: 0">
                                            @can('invitado.store')
                                                <li class="">
                                                    <a href="{{url('/nuevoinvitado')}}" class="text-responsive">
                                                        Crear Invitado
                                                        <font-awesome-icon icon="calendar-plus" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>                                                
                                            @endcan
                                            @can('invitado.index')
                                                <li class="">
                                                    <a href="{{url('/invitados/hoy/')}}" class="text-responsive">
                                                        Citas para hoy
                                                        <font-awesome-icon icon="calendar-check" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('invitado.index2')
                                                <li class="">
                                                    <a href="{{url('/invitados/pasadas/')}}" class="text-responsive">
                                                        Citas pasadas
                                                        <font-awesome-icon icon="calendar-alt" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{url('/invitados/proximas/')}}" class="text-responsive">
                                                        Citas próximas
                                                        <font-awesome-icon icon="calendar-day" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('invitado.index4')
                                                <li class="">
                                                    <a href="{{url('/invitados/listanegra/')}}" class="text-responsive">
                                                        Lista Negra
                                                        <font-awesome-icon icon="calendar-minus" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('invitado.index3')
                                                <li class="">
                                                    <a href="{{url('/invitados/canceladas/')}}" class="text-responsive">
                                                        Citas Canceladas
                                                        <font-awesome-icon icon="calendar-times" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        @endcanatleast

                        @canatleast(['contrato.index','contrato.store'])
                            <div class="" id="accordionExample1">
                                <li>
                                    <a data-toggle="collapse" href="#collapse1" class="text-responsive">
                                        Contratos
                                        <font-awesome-icon icon="sort-down" class="float-right estilo-menu-nor2"></font-awesome-icon>
                                    </a>
                                </li>
                                <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample1">
                                    <li>
                                        <ul style="padding: 0;margin: 0">
                                            @can('contrato.store')
                                                <li class="">
                                                    <a href="{{url('/crearcontrato')}}" class="text-responsive">
                                                        Crear Contratos
                                                        <font-awesome-icon icon="edit" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>                                                
                                            @endcan
                                            @can('contrato.index')
                                                <li class="">
                                                    <a href="{{url('/contratos')}}" class="text-responsive">
                                                        Ver Contratos
                                                        <font-awesome-icon icon="eye" class="float-right estilo-menu-peq"></font-awesome-icon>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        @endcanatleast
                        
                        
                    @endrole
                    <div class="" id="accordionExample2">
                        <li>
                            <a data-toggle="collapse" href="#collapse2" class="text-responsive">
                                Perfil
                                <font-awesome-icon icon="sort-down" class="float-right estilo-menu-nor2"></font-awesome-icon>
                            </a>
                        </li>
                        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample2">
                            <li>
                                <ul style="padding: 0;margin: 0">
                                    <li class="">
                                        <a href="{{url('/')}}" class="text-responsive">
                                            <a class="" style="font-size: 10px" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                    <font-awesome-icon icon="key" class="float-right estilo-menu-peq"></font-awesome-icon>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    </div>

                </ul>
            </div>
            <div id="page-content-wrapper">
                <div class="page-content inset">
                    <div class="row">
                        <div class="col-md-12" style="background-color: #DE2525;">
                             
                            <img style="margin: .6em" src="{{ asset('images/logo.png') }}" rel="stylesheet">
                            

                            <div class="float-right text-white hidden-2" style="padding: 1.2em;"><p class="hidden-2">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="hidden-1 float-right" style="color: white; margin-top: 1.6em;">
                                <font-awesome-icon data-toggle="collapse" data-target="#demo" icon="bars" class="float-right"></font-awesome-icon>
                            </div>
                            <div id="demo" class="collapse text-white">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main class="py-4">
                @yield('content')
            </main>
        </div>

    </div>



</body>
</html>
