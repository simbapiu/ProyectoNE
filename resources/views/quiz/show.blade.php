@extends('layouts.main')
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuestionario {{ $year }}</h1>
    </div>

    <!-- Modal secciones -->

    <div class="row">
        @if($message = Session::get('Listo'))
            <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
                <span>{{ $message }}</span>
            </div>
        @endif
    </div>

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
                            <input type="hidden" name="id_quiz" value="{{ $id }}">
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

    <!-- Modal Preguntas -->

    <div class="modal fade" id="modalAgregarPregunta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar preguntas</h5>
                </div>
                <form action="/admin/quizzes/{{ $id }}/questions" method="post">
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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioSearch" value="search">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Buscar pregunta
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioCreate" value="create">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Crear pregunta
                                </label>
                            </div>
                        </div>
                        <div class="search inputs">
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
                        </div>
                        <div class="create inputs">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Crear pregunta:</label>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="recipient-name" name="sentence" placeholder="Ingrese la sentencia">
                                <input type="hidden" class="form-control" id="recipient-name"  name="answer_type" value="radiobutton">
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
                                <input type="hidden" class="form-control" id="recipient-section-id" name="id_section">
                            </div>
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

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: #2F4F4F">
                <div class="card-body">Secciones</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ $id }}/sections">Ver</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <h3> Descripción: </h3>
            <span>{{ $quiz->value('description') }}</span>
        </div>
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

    <script>
        $(document).ready(function () {
            @if($message = Session::get('ErrorInsert'))
            $("#modalAgregarPregunta").modal("show");
            @endif
        });
    </script>

    <script>
        $(document).on("click", "#addPregunta", function () {
            var idSection = $("#section_id").val();
            $(".modal-body #recipient-section-id").val( idSection );
        });
    </script>

    <script>
        $(document).ready(function(){
            $('input[type="radio"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".inputs").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        .inputs {
            display: none;
        }
    </style>
@endsection