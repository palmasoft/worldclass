@extends('layouts.app')

@section('content')
<div class="container m-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <foros-component base="{{url('/crud')}}" tipo="1"></foros-component>
        </div>
    </div>
</div>
@endsection