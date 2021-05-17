@extends('layouts.main')
@section('container')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cuestionario {{ $id }}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarSeccion">
            <i class="fas fa-book fa-sm text-white-50"></i> Agregar sección
        </a>
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

    @foreach($sections as $section)
        <div class="card">
            <div class="card-header">
                {{ $loop->index + 1}}. <b>{{ $section->description }}</b>
                <input type="hidden" id="section_id" value="{{ $section->id }}">
            </div>
            @if($questions = \DB::table('questions')
            ->select('questions.*')
            ->get())
                @foreach($questions as $question)
                    <div class="card-body">
                        <p class="card-text">{{ $loop->index + 1}}. {{ $question->sentence }}</p>
                        <div class="row">
                            @if($option = \DB::table('options')->where('id', $question->id_option)
                                ->select('options.*')
                                ->orderBy('id','DESC')
                                ->first())
                                <div class="card-body">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">{{ $option->first_option }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">{{ $option->second_option }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">{{ $option->third_option }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">{{ $option->fourth_option }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">{{ $option->fifth_option }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">{{ $option->default_option }}</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="card-footer">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarPregunta" id="addPregunta">
                        <i class="fas fa-book fa-sm text-white-50"></i> Agregar pregunta
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    <!--
    <td>
        <a href="quizzes/{ //$quiz->id }}">
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
    -->

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