<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
  public function index()
  {

  }
  public function store(Request $request) {
    $answer = Answer::updateOrCreate(
      ['id_question' => $request->question_id],
      [
        'id_question' => $request->question_id,
        'selected_answer' => $request->selected_answer,
        'answer_value' => floatval($request->value_option),
        'selected_value' => $request->selected_value
      ]
    );

    $request->session()->put('Listo', 'Se guardó la respuesta');
    $request->session()->put('answer', $answer);
  }
}
