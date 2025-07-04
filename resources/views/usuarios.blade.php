@extends('layouts.app')

@section('content')
<div class="container m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <usuarios-component base="{{url('/crud')}}"></usuarios-component>
        </div>
    </div>
</div>
@endsection