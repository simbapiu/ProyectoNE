@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Apartado {{ $id_section }}</h1>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #2F4F4F">
                <div class="card-body">Preguntas</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ $id_section }}/questions">Ver</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <h3> Descripción: </h3>
            <span>{{ $section->value('description') }}</span>
        </div>
    </div>
@endsection