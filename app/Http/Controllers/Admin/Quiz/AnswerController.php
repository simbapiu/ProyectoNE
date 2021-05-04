<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
  public function index()
  {
    return view('answers');
  }
}
