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

Route::prefix('/user')->namespace('App\\Http\\Controllers')-> group (function(){
  Route::resource('/evaluation', 'TestController');
});

Route::prefix('/admin')->namespace('App\\Http\\Controllers')-> group (function(){
  Route::get('/', 'AdminController@index');

  Route::prefix('/')->namespace('Admin')-> group (function(){
    Route::resource('quizzes', 'QuizController');


    Route::prefix('quizzes/{id_quiz}')->namespace('Quiz')-> group (function() {
      Route::resource('sections', 'SectionController', ['except' => ['index']]);
      Route::get('/sections', ['as' => 'sections.index', 'uses' => 'SectionController@index']);

      Route::prefix('/sections/{id_section}')->namespace('Section')->group(function (){
        Route::resource('questions', 'QuestionController');
      });
    });
  });
});