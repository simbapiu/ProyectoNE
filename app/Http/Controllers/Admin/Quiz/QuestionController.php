<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\Option;

class QuestionController extends Controller
{
  public function index() {
    $sections = \DB::table('questions')
      ->select('questions.*')
      ->orderBy('id','DESC')
      ->get();
    return view('questions')->with('questions', $questions);
  }

  public function show($id) {
    return view('questions.show')->with('id', $id);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
    ]);
    if ($validator -> fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    }
    else {
      $option = Option::create([
        'answer_type' => $request->answer_type,
        'first_option' => $request->first_option,
        'second_option' => $request->second_option,
        'third_option' => $request->third_option,
        'fourth_option' => $request->fourth_option,
        'fifth_option' => $request->fifth_option,
        'default_option' => $request->default_option,
      ]);
      $question = Question::create([
        'sentence' => $request->sentence,
        'id_option' => $option->id,
        'id_section' => $request->id_section,
        'percentage'=>0
      ]);
      return back()->with('Listo', 'Sección creada correctamente');
    }
  }
}
