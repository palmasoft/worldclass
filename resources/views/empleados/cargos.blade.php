@extends('layouts.app')

@section('content')
<div class="container m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <cargos-component base="{{url('/crud')}}"></cargos-component>
        </div>
    </div>
</div>
@endsection