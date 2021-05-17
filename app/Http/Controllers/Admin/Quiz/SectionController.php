<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Controller;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Section;

class SectionController extends Controller
{
  public function index() {
    $sections = \DB::table('sections')
      ->select('sections.*')
      ->orderBy('id','DESC')
      ->get();
    return view('sections')->with('sections', $sections);
  }

  public function show($id) {
    return view('sections.show')->with('id', $id);
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
      $section = Section::create([
        'description' => $request->description,
        'id_quiz' => $request->id_quiz,
        'percentage'=>0
      ]);
      return back()->with('Listo', 'Sección creada correctamente');
    }
  }
}
