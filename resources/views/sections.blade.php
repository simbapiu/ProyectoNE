@extends('layouts.main')
@section('styles')

@endsection
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Secciones</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarSeccion">
            <i class="fas fa-book fa-sm text-white-50"></i> Crear sección
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

    <div class="modal fade" id="modalAgregarSeccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Sección</h5>
                </div>
                <form method="post" action="/admin/quizzes/{{ $id }}/sections">
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
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sections as $section)
                <tr>
                    <th scope="row">{{ $section->id }}</th>
                    <td>{{ $section->description }}</td>
                    <td>
                        <a href="quizzes/{{ $section->id }}">
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
            $("#modalAgregarSeccion").modal("show");
            @endif
        });
    </script>
@endsection