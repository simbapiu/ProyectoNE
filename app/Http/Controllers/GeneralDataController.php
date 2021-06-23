<?php

namespace App\Http\Controllers;

use Carbon\Traits\Creator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Evaluation;
use App\Models\GeneralData;
use App\Models\Score;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class GeneralDataController extends Controller
{
  public function index() {
  }

  public function show($id) {
  }

  public function store(Request $request)
  {
    if ($request->period >= Carbon::now()->year) {
      return back()
        ->withInput()
        ->with('ErrorInsertPeriod', 'No se puede iniciar una evaluación con el año actual');
    }

    $evaluated = User::where('name', $request->evaluated_name)->first();
    $user_id = Auth::User()->id;

    $general_data = GeneralData::create([
      'start_period' => $request->start_period,
      'end_period' => $request->end_period
    ]);
    $period = Carbon::createFromFormat('Y-m-d', $request->start_period)->format('Y');
    $quiz_start_period = new Carbon ("{$period}-01-01");
    $quiz = Quiz::where('start_period', $quiz_start_period)->first();
    $id_quiz = $quiz->id;
    $evaluation = Evaluation::create([
      'id_general_data' => $general_data->id,
      'id_quiz' => $id_quiz,
      'id_score' => 0,
      'id_summary_score' => 0,
      'is_closed' => false,
      'user_id' => $user_id,
      'user_evaluated_id' => $evaluated->id
    ]);
    return view('test.show')
      ->with('evaluation', $evaluation)
      ->with('evaluated', $evaluated)
      ->with('general_data', $general_data);
  }
}
