<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Section;
use App\Models\Question;
use App\Models\Answer;
use App\Models\GeneralData;
use App\Models\Score;
use App\Models\User;

class ScoreController extends Controller
{
  public function store(Request $request) {
    $section_ids = [];
    $total_percentage = 0;
    $total_answers = 0;
    $total_sobresaliente = 0;
    $answers_values = [];
    $section_percentages = [];
    $section_percentagesW = [];
    $total_score_percentage = 0;
    $evaluation = Evaluation::find($request->evaluation_id);
    $general_data = GeneralData::find($evaluation->id_general_data);
    $evaluated = User::find($evaluation->user_evaluated_id);
    $sections = Section::where('id_quiz', $evaluation->id_quiz)->get();
    foreach ($sections as $section) {
      $total_section_score = 0;
      $questions = Question::where('id_section', $section->id)->get();
      if (count($questions) > 0) {
        foreach ($questions as $question) {
          $answers = Answer::where('id_question', $question->id)->get();
          if (count($answers) == 0) {
            return back()
              ->withInput()
              ->with('ErrorInsert', 'Por favor responde todas las preguntas.');
          }
          array_push($answers_values, $answers->first()->selected_value);
          $total_section_score += $answers->first()->answer_value;
        }
        array_push($section_percentagesW, $total_section_score);
        $total_section_value = count($questions) * 4;
        array_push($section_percentages, (($total_section_score*100)/$total_section_value));
        $total_answers += count($questions);
        array_push($section_ids, $section->id);
      }
    }
    foreach ($section_ids as $section_id) {
      $section = Section::find($section_id);
      $percentage = $request->input('percentage_value-'.$section_id);
      $total_score_percentage += (array_shift($section_percentages)/100)*$percentage;
      $section->percentage = $percentage;
      $section->save();
      $total_percentage += $percentage;
    }
    if ($total_percentage != 100) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'El total de porcentaje debe ser 100.');
    }

    foreach ($answers_values as $answer_value) {
      $answer_value=='Sobresaliente'? $total_sobresaliente += 1 : 0;
    }
    $extrapoints = floor($total_sobresaliente / 3);
    $total_score = $total_score_percentage + $extrapoints;
    $score = Score::create([
      'total_percentage' => 100,
      'total_answered' => $total_answers,
      'pre_score' => $total_score_percentage,
      'final_score' => $total_score,
      'extra_points' => $extrapoints,
      'id_quiz' => $evaluation->id_quiz
    ]);
    $evaluation->id_score = $score->id;
    $evaluation->is_closed = true;
    $evaluation->save();
    return view('score.show')
      ->with('evaluation', $evaluation)
      ->with('score', $score)
      ->with('general_data', $general_data)
      ->with('evaluated', $evaluated);
  }

  public function show($user_id, $id, $year) {
    $evaluation = Evaluation::find($id);
    $general_data = GeneralData::find($evaluation->id_general_data);
    $evaluated = User::find($evaluation->user_evaluated_id);
    $score = Score::find($evaluation->id_score);
    $pre_score = $score->pre_score;
    $final_score = $score->final_score;
    if ($pre_score == 0) {
      $level = 'No aplica';
    }
    elseif ($pre_score >= 30 && $pre_score < 60) {
      $level = 'No satisfactorio';
    }
    elseif ($pre_score >= 60 && $pre_score < 75) {
      $level = 'Regularmente satisfactorio';
    }
    elseif ($pre_score >= 75 && $pre_score < 90) {
      $level = 'Medianamente satisfactorio';
    }
    elseif ($pre_score >= 90 && $pre_score <= 100) {
      $level = 'Satisfactorio';
    }
    elseif ($pre_score > 100) {
      $level = 'Sobresaliente';
    }

    if ($final_score == 0) {
      $final_level = 'No aplica';
    }
    elseif ($final_score >= 30 && $final_score < 60) {
      $final_level = 'No satisfactorio';
    }
    elseif ($final_score >= 60 && $final_score < 75) {
      $final_level = 'Regularmente satisfactorio';
    }
    elseif ($final_score >= 75 && $final_score < 90) {
      $final_level = 'Medianamente satisfactorio';
    }
    elseif ($final_score >= 90 && $final_score <= 100) {
      $final_level = 'Satisfactorio';
    }
    elseif ($final_score > 100) {
      $final_level = 'Sobresaliente';
    }
    return view('score.show')
      ->with('evaluation', $evaluation)
      ->with('general_data', $general_data)
      ->with('evaluated', $evaluated)
      ->with('score', $score)
      ->with('level', $level)
      ->with('final_level', $final_level);
  }
}
