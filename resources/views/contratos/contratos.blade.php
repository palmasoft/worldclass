@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row justify-content-center">
            <div class="form-group col-sm-6 col-lg-4">
                Sede
                <select class="form-control" id="bus_sede">
                    <option value="">-Seleccione una Sede-</option>
                    @if (@$sedes)
                        @foreach ($sedes as $sed)
                            <option value="{{$sed->sede}}">{{$sed->sede.' - '.$sed->nombre}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group col-sm-6 col-lg-4">
                Estado de Contrato
                <select class="form-control" id="bus_estado">
                    <option></option>
                    <option>CASH</option>
                    <option>PROCE</option>
                    <option>CERO</option>
                    <option>GASTO LEGAL</option>
                    <option>SEPARACION</option>
                    <option>PEDDING</option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-lg-4">
                Estado de Servicio
                <select class="form-control" id="bus_servicio">
                    <option></option>
                    <option value="0">Activo</option>
                    <option value="1">Inactivo</option>
                    <option value="2">Anulado</option>
                    <option value="3">Anulado C.M.</option>
                    <option value="4">Anulado E.D.</option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-lg-4">
                Fecha Inicial
                <input type="date" class="form-control" id="bus_f1">
            </div>
            <div class="form-group col-sm-6 col-lg-4">
                Fecha Final
                <input type="date" class="form-control" id="bus_f2">
            </div>
            <div class="form-group col-sm-6 col-lg-4">
                Busqueda Universal
                <input type="text" class="form-control" id="bus_universal">
            </div>

            <div class="form-group col-12">
                <button onclick="buscarXcs();" class="btn btn-danger">Buscar</button>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-12">
                {{ $contratos->links() }}
            </div>

            @if (@$contratos)
                @foreach ($contratos as $item)
                    <div class="col-12 mt-1 mb-1">
                        <contratos-component base="{{ url('/crud') }}" contratoid="{{ $item->id }}" destino="{{ url('/') }}"></contratos-component>
                    </div>
                @endforeach
            @endif

            <div class="col-12">
                {{ $contratos->links() }}
            </div>
        </div>
    </div>
    <script>
        function buscarXcs(){
            var a1 = document.getElementById('bus_sede').value;
            var a2 = document.getElementById('bus_f1').value;
            var a3 = document.getElementById('bus_f2').value;
            var a4 = document.getElementById('bus_estado').value;
            var a5 = document.getElementById('bus_servicio').value;
            var a6 = document.getElementById('bus_universal').value;

            window.location.href = "<?php echo url('/contratos'); ?>" + "/" + a1 + "|" + a2 + "|" + a3 + "|" + a4 + "|" + a5 + "|" + a6;
        }
    </script>
@endsection