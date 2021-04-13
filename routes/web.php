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

  Route::prefix('/quiz')->namespace('App\\Http\\Controllers\\Admin\\Quiz')-> group (function(){
    Route::resource('/', 'QuestionController');
  });
});