<?php

namespace App\Http\Controllers\Admin\Quiz\Section;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\Option;

class QuestionController extends Controller
{
  public function index($id_quiz, $id_section) {
    $questions = Question::Where('id_section', $id_section)
      ->select('questions.*')
      ->orderBy('id','ASC')
      ->get();
    return view('questions')
      ->with('questions', $questions)
      ->with('id_quiz', $id_quiz)
      ->with('id_section', $id_section);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'sentence' => 'required|min:10|max:191'
    ]);
    if ($validator -> fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    }
    else {
      $question = Question::updateOrCreate(
        ['id' => $request->id],
        [
          'sentence' => $request->sentence,
          'id_option' => 1,
          'id_section' => $request->id_section
        ]
      );
      return back()
        ->with('Listo', 'Pregunta agregada correctamente')
        ->with('question', $question);
    }
  }

  public function destroy($quiz_id, $section_id, $id) {
    $question = Question::find($id);
    $question->delete();
    return back()
      ->with('Listo', 'La pregunta se eliminó correctamente')
      ->with('id_quiz', $quiz_id)
      ->with('id_section', $section_id);
  }
}
