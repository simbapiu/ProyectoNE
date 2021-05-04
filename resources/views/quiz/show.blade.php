@extends('layouts.main')
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuestionario {{$id}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <i class="fas fa-book fa-sm text-white-50"></i> Agregar preguntas
        </a>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar preguntas</h5>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Buscar pregunta
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Crear pregunta
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name" placeholder="Buscar">
                        </div>
                        <div class="mb-3">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Pregunta</th>
                                    <th scope="col">Seleccionar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <b>Legalidad:</b> Conoce, cumple y demuestra dominio sobre el
                                        conocimiento de la normatividad que regula su actividad, de tal
                                        forma que no sea objeto de reproche.
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Crear pregunta:</label>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name" name="sentence" placeholder="Ingrese la sentencia">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Ingrese el tipo de respuesta: </label>
                            <input type="text" class="form-control" id="recipient-name"  name="answer_type" placeholder="Ejemplos: checkbox, radiobuton">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Ingrese las opciones de respuesta: </label>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name"  name="first_option" placeholder="Opción 1">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name" name="second_option" placeholder="Opción 2">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name" name="third_option" placeholder="Opción 3">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name" name="fourth_option" placeholder="Opción 4">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="recipient-name" name="fifth_option" placeholder="Opción 5">
                            <input type="hidden" class="form-control" id="recipient-name" name="default_option" value="No aplica">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear pregunta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre encuestado</th>
            <th scope="col">Calificación</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark Pérez</td>
            <td>70%</td>
            <td>
                <button type="button" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>80%</td>
            <td>Trash item</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry the Bird</td>
            <td>100%</td>
            <td>Trash item</td>
        </tr>
        </tbody>
    </table>


@endsection