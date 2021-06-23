<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Carbon\Traits\Date;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Section;

class QuizController extends Controller
{
  public function index() {
    $quizzes = \DB::table('quizzes')
      ->select('quizzes.*')
      ->orderBy('id','ASC')
      ->get();
    return view('quizzes')
      ->with('quizzes', $quizzes);
  }

  public function show($id) {
    $quiz = Quiz::find($id);
    $start_period = $quiz->value('start_period');
    $date = new Carbon($start_period);
    $year = $date->year;
    $sections = \DB::table('sections')
      ->select('sections.*')
      ->orderBy('id','DESC')
      ->get();
    return view('quiz.show')
      ->with('id', $id)
      ->with('year', $year)
      ->with('quiz', $quiz);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'description' => 'required|min:10|max:198',
      'period' => 'required|digits:4|integer|min:2000|max:'.(Date('Y'))
    ]);
    if ($validator -> fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    }
    else {
      $period = $request->period;
      if ($period >= Carbon::now()->year) {
        return back()
          ->withInput()
          ->with('ErrorInsertPeriod', 'No se puede crear un cuestionario con el año actual');
      }
      $start_period = new Carbon ("{$period}-01-01");
      $end_period = new Carbon ("{$period}-12-31");
      $quiz = Quiz::updateOrCreate(
          ['id' => $request->id],
          [
            'description' => $request->description,
            'start_period' => $start_period,
            'end_period' => $end_period
          ]
      );
      return back()
        ->with('Listo', 'Guardado correctamente')
        ->with('quiz', $quiz);
    }
  }

  public function destroy($id) {
    $quiz = Quiz::find($id);
    $sections = Section::where('id_quiz', $id)->get();
    if (count($sections) > 0) {
      return back()
        ->withInput()
        ->with('ErrorDelete', 'No se puede eliminar: Este cuestionario contiene secciones.');
    }
    else {
      $quiz->delete();
      return back()
        ->with('Listo', 'El cuestionario se eliminó correctamente')
        ->with('id_quiz', $id)
        ->with('quiz', $quiz);
    }
  }
}
