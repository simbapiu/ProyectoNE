<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Controller;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Section;
use App\Models\Question;

class SectionController extends Controller
{
  public function index($id_quiz) {
    $sections = Section::Where('id_quiz', $id_quiz)
      ->select('sections.*')
      ->orderBy('id','ASC')
      ->get();
    return view('sections')
      ->with('id_quiz', $id_quiz)
      ->with('sections', $sections);
  }

  public function show($id_quiz, $id_section) {
    $section = Section::Where(['id_quiz' => $id_quiz, 'id' => $id_section])->first();
    return view('sections.show')
      ->with('id_section', $id_section)
      ->with('section', $section);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'description' => 'required|min:10|max:198'
    ]);
    if ($validator -> fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    }
    else {
      Section::updateOrCreate(
        ['id' => $request->id],
        [
          'description' => $request->description,
          'id_quiz' => $request->id_quiz,
          'percentage'=>0
        ]
      );
      return back()->with('Listo', 'Sección agregada correctamente');
    }
  }

  public function destroy($quiz_id, $id) {
    $section = Section::find($id);
    $questions = Question::where('id_section', $id)->get();
    if (count($questions) > 0) {
      return back()
        ->withInput()
        ->with('ErrorDelete', 'No se puede eliminar: Esta sección contiene preguntas.');
    }
    else {
      $section->delete();
      return back()
        ->with('Listo', 'La sección se eliminó correctamente')
        ->with('id_quiz', $quiz_id)
        ->with('id_section', $id);
    }
  }
}
