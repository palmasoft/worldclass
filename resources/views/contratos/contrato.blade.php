@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row justify-content-center">
            <div class="col-12">
                <contrato-component base="{{ url('/crud') }}" contratoid="{{ $contrato }}" destino="{{ url('/') }}"></contrato-component>
            </div>
        </div>
    </div>
@endsection