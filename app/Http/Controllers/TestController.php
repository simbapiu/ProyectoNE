<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Carbon\Traits\Creator;
use Carbon\Traits\Date;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Section;
use App\Models\Evaluation;
use App\Models\GeneralData;
use App\Models\User;

class TestController extends Controller
{
  public function index($user_id)
  {
    if (Auth::User()->role == 'admin') {
      return redirect('admin');
    }
    $evaluations = Evaluation::where('user_id', $user_id)
      ->select('evaluations.*')
      ->orderBy('id', 'DESC')
      ->get();
    return view('test')->with('evaluations', $evaluations);
  }

  public function show($user_id, $id, $year)
  {
    $evaluation = Evaluation::find($id);
    if ($evaluation->is_closed) {
      return redirect('user/'.$user_id.'/test/'.$evaluation->id.'/'.$year.'/score')
        ->with('evaluation', $evaluation)
        ->with('year', $year)
        ->with('user_id', $user_id);
    }
    $general_data = GeneralData::find($evaluation->id_general_data);
    $evaluated = User::find($evaluation->user_evaluated_id);
    return view('test.show')
      ->with('evaluation', $evaluation)
      ->with('general_data', $general_data)
      ->with('evaluated', $evaluated);
  }

  public function destroy($user_id, $id) {
    $test = Evaluation::find($id);
    $test->delete();
    return back()
      ->with('Listo', 'La evaluación se eliminó correctamente')
      ->with('test', $test);

  }
}