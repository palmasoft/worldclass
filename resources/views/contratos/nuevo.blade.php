@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row justify-content-center">
            <div class="col-12">
                <contrato-nuevo-component base="{{ url('/crud') }}" cliente="{{ $invitado }}" destino="{{ url('/') }}"></contrato-nuevo-component>
            </div>
        </div>
    </div>
@endsection