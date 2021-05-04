<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
  public function index() {
    return view('quizzes');
  }

  public function show($id) {
    return view('quiz.show')->with('id', $id);
  }

  public function store(Request $request) {

    dd($request);
  }
}
