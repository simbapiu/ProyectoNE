@extends('layouts.main')
@section('container')
    <div class="body-container">
        <div class="general-data">
            <div class="general-data-container">
                <div class="card">
                    <div class="card-header">
                        <b>Datos generales</b>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="general-data-fields">
                                <div class="evaluator">
                                    <div class="mb-3">
                                        <h5 class="card-title"><b>Evaluado</b></h5>
                                        <div class="desktop-evaluator-inputs">
                                            @include('test.desktop_generaldata_evaluator')
                                        </div>
                                        <div class="mobile-evaluator-inputs">
                                            @include('test.mobile_generaldata_evaluator')
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="evaluated">
                                    <div class="desktop-evaluated-inputs">
                                        @include('test.desktop_generaldata_evaluated')
                                    </div>
                                    <div class="mobile-evaluated-inputs">
                                        @include('test.mobile_generaldata_evaluated')
                                    </div>
                                </div>
                                <br>
                                <div class="period-eval">
                                    <div class="mb-3">
                                        <h5 class="card-title"><b>Periodo evaluación</b></h5>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label for="inputStartPeriod" class="col-sm-2 col-form-label">Del:</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="inputStartPeriod">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label for="inputEndPeriod" class="col-sm-2 col-form-label">Al:</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="inputEndPeriod">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: #2F4F4F; border-color: #2F4F4F">Iniciar evaluación</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @if(true)
            <div class="quiz-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <b>Factores cualitativos (Desempeño Laboral y Código de ética y Conducta)</b>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="inputNameEvaluated" class="col-sm-2 col-form-label">Porcentaje:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="inputNameEvaluated" placeholder="0%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($sections = \DB::table('sections')->where('id_quiz', 1)->get())
                            @foreach($sections as $section)
                                <div class="card">
                                    <div class="card-header">
                                        <b>{{ $loop->index + 1}}.</b> {{ $section->description }}
                                        <input type="hidden" id="section_id" value="{{ $section->id }}">
                                    </div>
                                    <div class="card-body">
                                        @if($questions = \DB::table('questions')->where('id_section', $section->id)->get())
                                            @foreach($questions as $question)
                                                <div style="padding: 15px 0"><b>{{ $loop->index + 1}}.</b> {{ $question->sentence }}</div>

                                                @if($option = \DB::table('options')->first())
                                                    <form>
                                                        <div class="desktop-quiz-options">
                                                            @include('test.desktop_quiz_options')
                                                        </div>
                                                        <div class="mobile-quiz-options">
                                                            @include('test.mobile_quiz_options')
                                                        </div>
                                                    </form>
                                                @endif
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @if(true)
                <div class="score-section"></div>
            @endif
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .body-container {
            margin: 5px;
            padding: 5px;
        }
        .desktop-evaluator-inputs {
            display: none;
        }
        .mobile-evaluator-inputs {
            display: block;
        }
        .desktop-evaluated-inputs {
            display: none;
        }
        .mobile-evaluated-inputs {
            display: block;
        }
        .desktop-quiz-options {
            display: none;
        }
        .mobile-quiz-options {
            display: block;
        }

        @media (min-width: 1000px) {
            .body-container {
                margin: 5px;
                padding: 20px;
            }
        }

        @media (min-width: 860px) {
            .body-container {
                margin: 5px;
                padding: 10px;
            }
            .desktop-evaluator-inputs {
                display: block;
            }
            .mobile-evaluator-inputs {
                display: none;
            }
            .desktop-evaluated-inputs {
                display: block;
            }
            .mobile-evaluated-inputs {
                display: none;
            }
            .desktop-quiz-options {
                display: block;
            }
            .mobile-quiz-options {
                display: none;
            }
        }
    </style>
@endsection