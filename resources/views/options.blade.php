@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Opciones para cuestionarios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarPregunta" style="background-color: #2F4F4F; border-color: #2F4F4F">
            <i class="fas fa-book fa-sm text-white-50"></i> Agregar opciones
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar opciones</h5>
                </div>
                <form method="post" action="/admin/options">
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
                            <label for="recipient-first-option" class="col-form-label">Opción 1</label>
                            <input type="text" class="form-control" required name="first_option" id="recipient-first-option" placeholder="Ingresa la sentencia." value="{{ old('first_option') }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-second-option" class="col-form-label">Opción 2</label>
                            <input type="text" class="form-control" required name="second_option" id="recipient-second-option" placeholder="Ingresa la sentencia." value="{{ old('second_option') }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-third-option" class="col-form-label">Opción 3</label>
                            <input type="text" class="form-control" required name="third_option" id="recipient-third-option" placeholder="Ingresa la sentencia." value="{{ old('third_option') }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-fourth-option" class="col-form-label">Opción 4</label>
                            <input type="text" class="form-control" required name="fourth_option" id="recipient-fourth-option" placeholder="Ingresa la sentencia." value="{{ old('fourth_option') }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-fifth-option" class="col-form-label">Opción 5</label>
                            <input type="text" class="form-control" required name="fifth_option" id="recipient-fifth-option" placeholder="Ingresa la sentencia." value="{{ old('fifth_option') }}">
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
        @if($option = \DB::table('options')
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
@endsection