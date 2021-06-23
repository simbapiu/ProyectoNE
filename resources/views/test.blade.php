@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Evaluaciones</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarTest" style="background-color: #2F4F4F; border-color: #2F4F4F;">
            <i class="fas fa-book fa-sm text-white-50"></i> Crear evaluación
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

    <div class="modal fade" id="modalAgregarTest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Evaluación</h5>
                </div>
                <form method="post" action="/user/generalData">
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
                            <div class="general-data-fields">
                                <div class="evaluated">
                                    <div class="mb-3">
                                        <h5 class="card-title"><b>Evaluado</b></h5>
                                        <div class="form-group row">
                                            <label for="inputNameEvaluated" class="col-sm-2 col-form-label">Nombre:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="inputNameEvaluated" name="evaluated_name" placeholder="Ingresa nombre y apellidos" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="evaluator">
                                    <div class="mb-3">
                                        <h5 class="card-title"><b>Evaluador</b></h5>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nombre:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="inputNameEvaluator" name="evaluator_name" disabled value="{{ Auth::User()->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputCharge" class="col-sm-2 col-form-label">Cargo:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="inputCargeEvaluator" name="evaluator_charge" disabled value="{{ Auth::User()->charge }}">
                                            </div>
                                        </div>
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
                                                        <input type="date" class="form-control" id="inputStartPeriod" name="start_period" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label for="inputEndPeriod" class="col-sm-2 col-form-label">Al:</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="inputEndPeriod" name="end_period" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar evaluación</h5>
                </div>
                <div class="modal-body">
                    <h5>¿Esta seguro de que desea eliminar la evaluación?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btnModalEliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="table-responsive-md">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre evaluado</th>
                <th scope="col">Periodo</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($evaluations as $test)
                @if($general_data = \DB::table('general_datas')->where('id', $test->id_general_data)->get())
                    @if($year = \Carbon\Carbon::parse($general_data->first()->start_period)->format('Y'))
                        @if($user = \DB::table('users')->where('id', $test->user_evaluated_id)->get())
                            <tr>
                                <th scope="row">{{ $test->id }}</th>
                                <td>{{ $user->first()->name }}</td>
                                <td>{{ $year }}</td>
                                @if($test->is_closed)
                                    <td>{{ 'Cerrado' }}</td>
                                @else
                                    <td>{{ 'Abierto' }}</td>
                                @endif
                                <td>
                                    @if($test->is_closed)
                                        <a href="test/{{ $test->id }}/{{ $year }}/score">
                                            <i class="fas fa-eye fa-sm text-black-50"></i>
                                        </a>
                                        <span style="padding-left: 10px"></span>
                                    @else
                                        <a href="test/{{ $test->id }}/{{ $year }}">
                                            <i class="fas fa-pencil-alt fa-sm text-black-50"></i>
                                        </a>
                                        <span style="padding-left: 10px"></span>
                                    @endif
                                    <button class="btn btn-round btnEliminar" data-id="{{ $test->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="fas fa-trash fa-sm text-black-50"></i></button>
                                    <form action="{{ url('/user/'.Auth::User()->id.'/test', ['id' => $test->id]) }}" method="post" id="formDel_{{ $test->id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $test->id }}">
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        var idEliminar = 0;
        $(document).ready(function () {
            $(".btnEliminar").click(function () {
                idEliminar = $(this).data('id');
            });
            $(".btnModalEliminar").click(function () {
                $('#formDel_'+idEliminar).submit();
            });
        });

        $(function () {
            $('#inputNameEvaluated').autocomplete({
                minLength: 2,
                source: function (request, response) {
                    $.ajax({
                        url: "{{route("search.user")}}",
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data)
                        }
                    });
                }
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        .ui-front {
            z-index: 2000 !important;
        }
    </style>
@endsection