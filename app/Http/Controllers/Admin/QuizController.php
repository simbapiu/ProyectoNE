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
      ->orderBy('id','DESC')
      ->get();
    return view('quizzes')->with('quizzes', $quizzes);
  }

  public function show($id) {
    $sections = \DB::table('sections')
      ->select('sections.*')
      ->orderBy('id','DESC')
      ->get();
    return view('quiz.show')
      ->with('id', $id)
      ->with('sections', $sections);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'description' => 'required|min:10|max:198',
      'period' => 'required|digits:4|integer|min:2000|max:'.(Date('Y')+1)
    ]);
    if ($validator -> fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    }
    else {
      $period = $request->period;
      $start_period = new Carbon ("{$period}-01-01");
      $end_period = new Carbon ("{$period}-12-31");
      $quiz = Quiz::create([
        'description' => $request->description,
        'start_period' => $start_period,
        'end_period' => $end_period
      ]);
      return back()->with('Listo', 'Cuestionario creado correctamente');
    }
  }
}
