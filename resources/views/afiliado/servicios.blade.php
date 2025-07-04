@extends('layouts.app')

@section('content')
<div class="container m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <servicios-afiliado-component base="{{url('/crud')}}"  cliente="{{ $cliente->id }}" contratoid="{{ $contratos->id }}"></servicios-afiliado-component>
        </div>
    </div>
</div>
@endsection