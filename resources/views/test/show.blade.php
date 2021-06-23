@extends('layouts.main')
@section('container')
    <div class="body-container">
        <div class="general-data">
            <div class="general-data-container">
                <div class="card">
                    <div class="card-header">
                        <h3><b>Datos generales</b></h3>

                    </div>
                    <div class="card-body">
                        <div class="general-data-fields">
                            <div class="evaluated">
                                <div class="mb-3">
                                    <h5 class="card-title"><b>Evaluado</b></h5>
                                    <span class="col-sm-6 col-form-label"><b>Nombre:</b> {{ $evaluated->name }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="evaluator">
                                <div class="mb-3">
                                    <h5 class="card-title"><b>Evaluador</b></h5>
                                    <span class="col-sm-6 col-form-label"><b>Nombre:</b> {{ Auth::User()->name }}</span>
                                    <br>
                                    <span class="col-sm-6 col-form-label"><b>Cargo:</b> {{ Auth::User()->charge }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="period-eval">
                                <div class="mb-3">
                                    <h5 class="card-title"><b>Periodo evaluación</b></h5>
                                    <span class="col-sm-4 col-form-label"><b>Del:</b> {{ $general_data->start_period }}</span>
                                    <br>
                                    <span class="col-sm-4 col-form-label"><b>Al:</b> {{ $general_data->end_period }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @if($message = Session::get('ErrorInsert'))
            <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                <h5>Errores:</h5>
                <span>{{ $message }}</span>
            </div>
        @endif
        <div>
            <div class="quiz-body">
                <form action="/user/score" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <b>Factores cualitativos (Desempeño Laboral y Código de ética y Conducta)</b>
                        </div>
                        <div class="card-body">
                            @if($sections = \DB::table('sections')->where('id_quiz', $evaluation->id_quiz)->get())
                                @foreach($sections as $section)
                                    @if($questions = \DB::table('questions')->where('id_section', $section->id)->get())
                                        @if(count($questions) > 0)
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group row">
                                                                <b>{{ $loop->index + 1 }}</b>. {{ $section->description }}
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group row">
                                                                <label for="inputNamePercentage" class="col-sm-6 col-form-label">Porcentaje:</label>
                                                                <div class="col-sm-3">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" class="form-control" id="inputPercentage" name="percentage_value-{{$section->id}}" value="{{ $section->percentage }}">
                                                                        <input type="hidden" id="evaluation_id" name="evaluation_id" value="{{ $evaluation->id }}">
                                                                        <span class="input-group-text" id="basic-addon1">%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    @foreach($questions as $question)
                                                        <div style="padding: 15px 0"><b>{{ $loop->index + 1}}.</b> {{ $question->sentence }}</div>
                                                        @if($option = \DB::table('options')->first())
                                                            <form>
                                                                @include('test.mobile_quiz_options')
                                                            </form>
                                                        @endif
                                                        <br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer text-muted">
                            <button type="submit" class="btn btn-primary" id="saveTest" style="background-color: #2F4F4F; border-color: #2F4F4F">Terminar evaluación</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(true)
            <div class="score-section"></div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .body-container {
            margin: 5px;
            padding: 5px;
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
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('input[type="radio"]').click(function() {
                let valueOption = 0;
                let selectedId = this.id;
                let selectedValue = $("#"+selectedId+":checked").val();
                let questionId = selectedId.split('-').pop();
                switch (selectedValue) {
                    case 'Sobresaliente':
                        valueOption = 4;
                        break;
                    case 'Satisfactorio':
                        valueOption = 4;
                        break;
                    case 'Medianamente satisfactorio':
                        valueOption = 3;
                        break;
                    case 'Regularmente satisfactorio':
                        valueOption = 2;
                        break;
                    case 'No satisfactorio':
                        valueOption = 1;
                        break;
                    default:
                        break;
                }
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('answer.store') }}",
                    type: 'post',
                    data: {
                        question_id: questionId,
                        selected_answer: selectedId,
                        value_option: valueOption,
                        selected_value: selectedValue,
                        _token: _token
                    },
                    success: function () {
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.message);
                    }
                });
            });
        });

        function getValue() {
            for (let i = 1; i <= 6; i++) {
                let valueOption = $("#rb"+questionId).val();
            }
        }
    </script>
@endsection