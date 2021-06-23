@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario" style="background-color: #2F4F4F; border-color: #2F4F4F">
            <i class="fas fa-book fa-sm text-white-50"></i> Agregar usuario
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

    <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                </div>
                <form method="post" action="/admin/users">
                    @csrf
                    <div class="modal-body">
                        @if($message = Session::get('ErrorInsert'))
                            <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert" id="errors">
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
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" required name="name" id="recipient-name" placeholder="Ingresa nombre y apellidos." value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" required name="email" id="recipient-email" placeholder="Ingresa el correo electrónico." value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-password" class="col-form-label">Contraseña</label>
                            <input type="password" class="form-control" required name="password" id="recipient-password" placeholder="Ingresa la contraseña.">
                            <p style="margin-bottom: 0">*Alfanumérico</p>
                            <p>**Mínimo 8 caracteres</p>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-pass2" class="col-form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" required name="pass2" id="recipient-pass2" placeholder="Repite la contraseña.">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-role" class="col-form-label">Tipo de usuario</label>
                            <select class="form-select" aria-label="Default select example" name="role">
                                <option selected>Seleccionar...</option>
                                <option value="user">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>
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

    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Tipo de usuario</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Tipo de usuario</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 to 0 of 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
            $("#modalAgregarUsuario").modal("show");
            @endif
        });
    </script>
@endsection