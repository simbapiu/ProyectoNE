@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Preguntas de sección {{ $id_section }}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarPregunta" style="background-color: #2F4F4F; border-color: #2F4F4F">
            <i class="fas fa-book fa-sm text-white-50"></i> Agregar preguta
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

    <div class="modal fade" id="modalAgregarPregunta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar pregunta</h5>
                </div>
                <form method="post" action="/admin/quizzes/{{ $id_quiz }}/sections/{{ $id_section }}/questions">
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
                            <label for="recipient-name" class="col-form-label">Pregunta</label>
                            <input type="text" class="form-control" required name="sentence" id="recipient-description" placeholder="Ingresa la sentencia." value="{{ old('sentence') }}">
                            <input type="hidden" class="form-control" required name="id_section" id="recipient-description" value="{{ $id_section }}">
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

    <!-- data tables -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Listdo de preguntas
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th># Pregunta</th>
                        <th>Sentencia</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th># Pregunta</th>
                        <th>Sentencia</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @if($questions)
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{ $question->sentence }}</td>
                                <td>
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
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .page-item.active .page-link {
            background-color: #2F4F4F;
            border-color: #2F4F4F;
        }
    </style>
@endsection

@section('scripts')
    <script>
        var table = $('#dataTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Preguntas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Preguntas",
                "infoFiltered": "(Filtrado de _MAX_ total preguntas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Preguntas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            @if($message = Session::get('ErrorInsert'))
            $("#modalAgregarPregunta").modal("show");
            @endif
        });
    </script>
@endsection