<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ url('tmk-opc') }}">Tmk/Opc</a>
                        <a href="{{ route('login') }}">Ingresar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrarse</a>
                        @endif

                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                   WORDCLASS
                </div>
            </div>
        </div>
    </body>
</html>

<!--<html lang="es"> ACTIVAR CUANDO ESTE EL DISEÑO JD
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WORDCLASS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="http://systemsoca.com/images/oneclasslogo.png" />
    <style>
        html, body {
            height: 100%;
            width: 100%;
           /* background-image: url('../images/sistema.png');modificar imagen jesus diaz**/
                background-repeat: no-repeat;
                /*background-attachment: fixed;*/
                background-position: center;
                background-size: cover;
        }
        
        * {
        box-sizing: border-box;
        }

        body {
        margin: 0;
        font-family: Arial;
        font-size: 17px;
        }

        #myVideo {
        right: 0;
        bottom: 0;
        min-width: 100%; 
        min-height: 100%;
        }

        .content {
        position: absolute;
        top: 0;
        background: rgba(0, 0, 0, 0);
        color: #f1f1f1;
        width: 100%;
        padding: 20px;
        }

        .myBtn {
        width: 200px;
        font-size: 18px;
        padding: 10px;
        border: none;
        background: #000;
        color: #fff;
        cursor: pointer;
        }

        .myBtn:hover {
        background: #ddd;
        color: black;
        }

        .background1{
            height:400px;
            background-image : url('images/comida.webp');
            background-position: 100% 0;
            background-size:50%;
            background-repeat:no-repeat;        
        }

        .background2{
            height:400px;
            background-image : url('images/avion.jpg');
            background-position: 100% 0;
            background-size:50%;
            background-repeat:no-repeat;        
        }

        .background3{
            height:400px;
            background-image : url('images/hoteles.jpg');
            background-position: 100% 0;
            background-size:50%;
            background-repeat:no-repeat;        
        }

        .background4{
            height:400px;
            background-image : url('images/autos.jpg');
            background-position: 100% 0;
            background-size:50%;
            background-repeat:no-repeat;        
        }
    </style>
</head>
<body>
   

   
      
    <!--<div class="content">
        <div class="container">
            CUANDO ESTE LISTA LA IMAGEN ACTIVAR ESTA VISTA
            <div class="row">
                <div class="col-6">
                    <h1>WORDCLASS</h1>
                    <p>Tus sueños en Primera Clase.</p>
                </div>
                
                <div class="col-6 text-right align-middle">
                    @auth
                        <a class="btn btn-outline-light mx-1" href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a class="btn btn-outline-light mx-1" href="{{ url('tmk-opc') }}">Tmk/Opc</a>
                        <a class="btn btn-outline-light mx-1" href="{{ route('login') }}">Ingresar</a>
            
                        @if (Route::has('register'))
                            <a class="btn btn-outline-light mx-1" href="{{ route('register') }}">Registrarse</a>
                        @endif
            
                    @endauth
                    
                    </div>
                </div>
                
            </div>
        </div>
    </div>--->

   <!-- <div class="container p-4 text-center my-4">
        <h1>
            Unete a Nuestro Club One Class Travel
        </h1>
    </div>

    <hr>
    
    <div class="background1 row">
        <div class="col-6 p-4 text-center">
            <h1>
                <strong>Gana en restaurantes</strong>
            </h1>
            <br>
            <h3>
                Obten descuentos en nuestros restaurantes afiliados.
            </h3>
        </div>
    </div>

    <hr>
    
    <div class="background2 row">
        <div class="col-6 p-4 text-center">
            <h1>
                <strong>Gana en Vuelos</strong>
            </h1>
            <br>
            <h3>
                Obten descuentos a donde quieras con nuestras aerolineas afiliadas.
            </h3>
        </div>
    </div>

    <hr>
    
    <div class="background3 row">
        <div class="col-6 p-4 text-center">
            <h1>
                <strong>Gana en Hoteles</strong>
            </h1>
            <br>
            <h3>
                Obten descuentos en hoteles afiliados, o pregunta por nuestros Hoteles.
            </h3>
        </div>
    </div>

    <hr>
    
    <div class="background4 row">
        <div class="col-6 p-4 text-center">
            <h1>
                <strong>Gana en Renta de Autos</strong>
            </h1>
            <br>
            <h3>
                Obten descuentos en renta de Autos.
            </h3>
        </div>
    </div>

    <hr>

    <div class="container p-4 text-center my-4">
        <h1>
            <strong>
                Usa tu Membresia en Casi Todo
            </strong>
        </h1>
    </div>

    <script>
        var video = document.getElementById("myVideo");
        var btn = document.getElementById("myBtn");

        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pause";
            } else {
                video.pause();
                btn.innerHTML = "Play";
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</body>
</html>