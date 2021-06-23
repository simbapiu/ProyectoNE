@extends('layouts.main')
@section('styles')

@endsection
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Secciones</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarSeccion" style="background-color: #2F4F4F; border-color: #2F4F4F">
            <i class="fas fa-book fa-sm text-white-50"></i> Agregar sección
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
                <form method="post" action="/admin/quizzes/{{ $id_quiz }}/sections">
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

    <!-- Modal Eliminar -->

    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Sección</h5>
                </div>
                <div class="modal-body">
                    @if($message = Session::get('ErrorDelete'))
                        <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                            <h5>Errores:</h5>
                            <ul>
                                {{ $message }}
                            </ul>
                        </div>
                    @endif
                    <h5>¿Esta seguro de que desea eliminar la sección?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btnModalEliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar sección</h5>
                </div>
                <form method="post" action="/admin/quizzes/{{$id_quiz}}/sections">
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
                        <input type="hidden" name="id" id="idEdit">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Descripción</label>
                            <textarea class="form-control" required name="description" id="editDescription" placeholder="Ingresa una breve descripción.">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
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
                <th scope="col"># Sección</th>
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sections as $section)
                <tr>
                    <th scope="row">{{ $section->id }}</th>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $section->description }}</td>
                    <td>
                        <a href="sections/{{ $section->id }}" style="padding: 6px 12px; display: inline-block;">
                            <i class="fas fa-eye fa-sm text-black-50"></i>
                        </a>
                        <button class="btn btn-round btnEditar"
                                data-id="{{ $section->id }}"
                                data-description="{{ $section->description }}"
                                data-bs-toggle="modal" data-bs-target="#modalEditar">
                            <i class="fas fa-edit fa-sm text-black-50"></i>
                        </button>
                        <button class="btn btn-round btnEliminar" data-id="{{ $section->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="fas fa-trash fa-sm text-black-50"></i></button>
                        <form action="{{ url('/admin/quizzes/'.$id_quiz.'/sections', ['id' => $section->id]) }}" method="post" id="formDel_{{ $section->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $section->id }}">
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        var idEliminar = 0;
        $(document).ready(function () {
            @if($message = Session::get('ErrorInsert'))
            $("#modalAgregarSeccion").modal("show");
            @endif
            @if($message = Session::get('ErrorDelete'))
            $("#modalEliminar").modal("show");
            @endif
            @if($message = Session::get('ErrorInsert'))
            $("#modalEditar").modal("show");
            @endif
            $(".btnEliminar").click(function () {
                idEliminar = $(this).data('id');
            });
            $(".btnModalEliminar").click(function () {
                $('#formDel_'+idEliminar).submit();
            });
            $(".btnEditar").click(function () {
                $('#idEdit').val($(this).data('id'));
                $('#editDescription').val($(this).data('description'));
            });
        });
    </script>
@endsection