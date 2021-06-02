<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Option;

class OptionController extends Controller
{
  public function index() {
    $options = \DB::table('options')
      ->select('options.*')
      ->orderBy('id','DESC')
      ->get();
    return view('options')->with('options', $options);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'first_option' => 'required|min:10|max:198',
      'second_option' => 'required|min:10|max:198',
      'third_option' => 'required|min:10|max:198',
      'fourth_option' => 'required|min:10|max:198',
      'fifth_option' => 'required|min:10|max:198'
    ]);
    if ($validator -> fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    }
    else {
      Option::create([
        'first_option' => $request->first_option,
        'second_option' => $request->second_option,
        'third_option' => $request->third_option,
        'fourth_option' => $request->fourth_option,
        'fifth_option' => $request->fifth_option,
        'default_option' => 'NA',
        'answer_type' => 'radio'
      ]);
      return back()->with('Listo', 'Opciones creadas correctamente');
    }
  }
}
