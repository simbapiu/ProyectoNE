@extends('layouts.main')
@section('styles')

@endsection
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuestionarios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregar" style="background-color: #2F4F4F; border-color: #2F4F4F;">
            <i class="fas fa-book fa-sm text-white-50"></i> Crear cuestionario
        </a>
    </div>

    <div class="row">
        @if($message = Session::get('Listo'))
            <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
                <span>{{ $message }}</span>
            </div>
        @endif
    </div>
    <!-- Modal -->

    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar cuestionario</h5>
                </div>
                <form method="post" action="/admin/quizzes">
                    @csrf
                    <div class="modal-body">
                        @if($message = Session::get('ErrorInsert'))
                            <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                                <h5>Errores:</h5>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Descripción</label>
                            <textarea class="form-control" required name="description" id="recipient-description" placeholder="Ingresa una breve descripción.">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Periodo:</label>
                            <input type="text" name="period" required class="form-control" id="recipient-period" placeholder="Ingrese un año. Ej. 2021" value="{{ old('period') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>

    <div class="table-responsive-md">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col"># Encuesta</th>
                <th scope="col">Descripción</th>
                <th scope="col">Inicio de periodo</th>
                <th scope="col">Fin de periodo</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <th scope="row">{{ $quiz->id }}</th>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $quiz->description }}</td>
                    <td>{{ $quiz->start_period }}</td>
                    <td>{{ $quiz->end_period }}</td>
                    <td>
                        <a href="quizzes/{{ $quiz->id }}">
                            <i class="fas fa-eye fa-sm text-black-50"></i>
                        </a>
                        <span style="padding-left: 10px"></span>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                            <i class="fas fa-pencil-alt fa-sm text-black-50"></i>
                        </a>
                        <span style="padding-left: 10px"></span>
                        <a href="#">
                            <i class="fas fa-trash fa-sm text-black-50"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            @if($message = Session::get('ErrorInsert'))
            $("#modalAgregar").modal("show");
            @endif
        });
    </script>
@endsection