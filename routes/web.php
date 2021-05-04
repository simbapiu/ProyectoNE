<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::prefix('/admin')->namespace('App\\Http\\Controllers')-> group (function(){
  Route::get('/', 'AdminController@index');

  Route::prefix('/quizzes')->namespace('Admin')-> group (function(){
    Route::get('/', 'QuizController@index');
    Route::get('/{id}', 'QuizController@show');
    Route::post('/{id}', 'QuizController@store');


    Route::prefix('/{id}')->namespace('Quiz')-> group (function(){
      Route::resource('questions', 'QuestionController');
      Route::resource('answers', 'AnswerController');
    });
  });
});