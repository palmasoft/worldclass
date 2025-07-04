@extends('layouts.app')

@section('content')
<div class="container m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <tikets-component base="{{url('/crud')}}" cliente="{{ $cliente->id }}" tipo="2"></tikets-component>
        </div>
    </div>
</div>
@endsection