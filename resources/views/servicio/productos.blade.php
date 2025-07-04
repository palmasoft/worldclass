@extends('layouts.app')

@section('content')
<div class="container m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <productos-afiliado-component base="{{url('/crud')}}" clienteid="{{ $cliente->id }}" tipo="1" saldo="{{ $contrato->saldoFavor }}" contratoid="{{ $contrato->id }}"></productos-afiliado-component>
        </div>
    </div>
</div>
@endsection