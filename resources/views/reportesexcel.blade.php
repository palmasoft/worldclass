@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/reportesexcel') }}" class="row" target="_blank">
            <div class="form-group col-sm-6 col-md-4 col-lg-3">
                Tipo de Informe
                <select name="tipo" class="form-control" onchange="busquedaCargo(this);">
                    <option value="1">Contratos</option>
                    <option value="2">Afiliados</option>
                    <option value="3">Invitados</option>
                    <option value="4">Empleados</option>
                    <option value="5">Empleados por Cargo</option>
                    <option value="6">Cartera</option>
                    <option value="7">Agencia</option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-md-4 col-lg-3">
                Sede
                <select name="sede" class="form-control">
                    <option value="">Todas</option>
                    @if (@$sedes)
                        @foreach ($sedes as $sede)
                            <option value="{{$sede->sede}}">{{$sede->sede.' - '.$sede->nombre}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group col-sm-6 col-md-4 col-lg-3">
                Fecha de Inicio
                <input type="date" name="fecha1" class="form-control">
            </div>
            <div class="form-group col-sm-6 col-md-4 col-lg-3">
                Fecha de Fin
                <input type="date" name="fecha2" class="form-control">
            </div>
            <div id="buscarCargoID1" style="display: none;" class="form-group col-sm-6 col-md-4 col-lg-3">
                Cargo
                <select name="cargo" class="form-control">
                    <option value="0">Todos</option>
                    @if (@$cargos)
                        @foreach ($cargos as $cargo)
                            <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div id="buscarCargoID2" style="display: none;" class="form-group col-sm-6 col-md-4 col-lg-3">
                Empleado
                <select name="empleado" class="form-control">
                    <option value="0">Todos</option>
                    @if (@$empleados)
                        @foreach ($empleados as $empleado)
                            <option value="{{$empleado->id}}">{{$empleado->nombre.' - '.$empleado->apellido}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Generar</button>
            </div>
        </form>
    </div>
    <script>
        function busquedaCargo(e) {
            let valor = e.value;
            let divCargo = document.getElementById("buscarCargoID1");
            let divEmpleado = document.getElementById("buscarCargoID2");
        
            if (valor==4) {
                divCargo.style.display = "initial";
                divEmpleado.style.display = "initial";
            }else{
                divCargo.style.display = "none";
                divEmpleado.style.display = "none";
            }
        }
    </script>
@endsection