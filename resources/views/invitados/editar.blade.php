@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row justify-content-center">
            <div class="col-12">
                <invitado-new-component base="{{ url('/crud') }}" destino="{{ url('/home') }}" cliente="{{ $invitado }}"></invitado-new-component>
            </div>
        </div>
    </div>
@endsection