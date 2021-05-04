@extends('layouts.main')
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuestionarios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <i class="fas fa-book fa-sm text-white-50"></i> Crear cuestionario
        </a>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar cuestionario</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Área a aplicar el cuestionario:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Inicio de periodo:</label>
                            <input type="date" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Fin de periodo:</label>
                            <input type="date" class="form-control" id="recipient-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <br>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Área</th>
            <th scope="col">Inicio de periodo</th>
            <th scope="col">Fin de periodo</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Programadores</td>
            <td>01-01-2021</td>
            <td>01-07-2021</td>
            <td>
                <a href="quizzes/1">
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
        <tr>
            <th scope="row">2</th>
            <td>Redes</td>
            <td>01-01-2021</td>
            <td>01-07-2021</td>
            <td>
                <a href="#">
                    <i class="fas fa-eye fa-sm text-black-50"></i>
                </a>
                <span style="padding-left: 10px"></span>
                <a href="#">
                    <i class="fas fa-pencil-alt fa-sm text-black-50"></i>
                </a>
                <span style="padding-left: 10px"></span>
                <a href="#">
                    <i class="fas fa-trash fa-sm text-black-50"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>


@endsection