@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong>
                            Invitados - 
                            @if ($tipo == 'hoy')
                                Citas para hoy
                            @endif
                            @if ($tipo == 'pasadas')
                                Citas Pasadas
                            @endif
                            @if ($tipo == 'proximas')
                                Citas Proximas
                            @endif
                            @if ($tipo == 'listanegra')
                                Lista Negra
                            @endif
                            @if ($tipo == 'canceladas')
                                Citas Canceladas
                            @endif
                        </strong>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-10">
                                Sede
                                <select class="form-control" value="{{@$sede}}" onchange="buscarSEDEURL(this)">
                                    <option value="">-Seleccione una Sede-</option>
                                    @if (@$sedes)
                                        @foreach ($sedes as $sed)
                                            <option value="{{$sed->sede}}">{{$sed->sede.' - '.$sed->nombre}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if (@$sede)
                                @can('manifiesto.view')
                                    <div class="form-group col-10">
                                        <a target="_blank" href="{{url('excelmanifiesto').'/'.$sede}}" class="btn btn-danger">
                                            Manifiesto
                                        </a>
                                        
                                        <b-button v-b-modal.modal1>Enviar Manifiesto</b-button>
                                        <b-button v-b-modal.modal2 variant="success">Embudo</b-button>


                                        <b-modal id="modal1" hide-footer title="Formulario de Envio">
                                            <manifiesto-component destino="{{ url('/') }}" sede="{{@$sede}}"></manifiesto-component>
                                        </b-modal>


                                        <b-modal id="modal2" hide-footer title="Embudo">
                                            <form action="{{ url('/embudo') }}" class="row" enctype="multipart/form-data" target="_blank">
                                                @csrf
                                                <div class="form-group col-md-6">
                                                    Columna de Nombres
                                                    <input type="text" name="nombre" class="form-control" placeholder="A" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    Columnas de Celulares
                                                    <input type="text" name="celular" class="form-control" placeholder="A,B,C" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    Columnas de Telefonos
                                                    <input type="text" name="telefono" class="form-control" placeholder="A,B,C" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    Cantidad de Filas
                                                    <input type="number" name="filas" class="form-control" value="0" required>
                                                </div>
                                                <div class="form-group col-12">
                                                    Archivo Excel
                                                    <input type="file" name="archivo" class="form-control" required>
                                                </div>
                                                <div class="form-group col-12">
                                                    <button type="submit" class="btn btn-primary">Comprobar</button>
                                                </div>
                                            </form>
                                        </b-modal>
                                    </div>  
                                @endcan
                            @endif
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                @if (@$invitados)
                                    @foreach ($invitados as $item)
                                        @php
                                            if (@$acompanantes) {
                                                foreach ($acompanantes as $key) {
                                                    if ($key->id == $item->acompanante) {
                                                        $acompanante = $key;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if ($acompanante)
                                            <invitado-component base="{{url('/crud')}}" :invitado="{{ $item }}" :acompanante="{{ @$acompanante }}"  baseorigen="{{url('/')}}"></invitado-component>
                                        @else
                                            <invitado-component base="{{url('/crud')}}" :invitado="{{ $item }}" acompanante=""  baseorigen="{{url('/')}}"></invitado-component>
                                        @endif
                                    @endforeach                            
                                @endif
                            </div>
                        </div>

                        {{ $invitados->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function buscarSEDEURL(e){
            window.location.href = "<?php echo url('/invitados/'.@$tipo); ?>" + "/" + e.value;
        }
    </script>
@endsection