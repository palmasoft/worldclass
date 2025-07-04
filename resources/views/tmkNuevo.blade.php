@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <registrotmk-component base="{{url('/crud')}}"></registrotmk-component>
        </div>
    </div>
</div>

@endsection
