@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row justify-content-center">
            <div class="col-12">
                <cartera-component base="{{ url('/crud') }}" contratoid="{{ $contrato }}" destino="{{ url('/') }}"></cartera-component>
            </div>
        </div>
    </div>
@endsection