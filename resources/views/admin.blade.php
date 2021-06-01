@extends('layouts.main')
@section('container')
    <!-- cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #2F4F4F">
                <div class="card-body">Cuestionarios</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/admin/quizzes">Ver</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #2F4F4F">
                <div class="card-body">Resultados</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="admin/grades">Ver</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection