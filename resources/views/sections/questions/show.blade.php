@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pregunta {{ $id }}</h1>
    </div>

    <br>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <h3> Sentencia: </h3>
            <span>{{ $section->value('sentence') }}</span>
        </div>
    </div>
@endsection