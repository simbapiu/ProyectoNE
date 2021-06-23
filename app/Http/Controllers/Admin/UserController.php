<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function index() {
    $users = \DB::table('users')
      ->select('users.*')
      ->orderBy('id', 'ASC')
      ->get();
    return view('admin.users')->with('users', $users);
  }

  public function search(Request $request) {
    $term = $request->get('term');
    $queries = User::where('name', 'LIKE', '%'.$term.'%')->get();
    $data = [];

    foreach ($queries as $query) {
      $data[] = [
        'label' => $query->name
      ];

      return $data;
    }
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:5|max:100',
      'email' => 'required|email',
      'password' => 'required|min:8|required_with:pass2|same:pass2',
      'role' => 'required'
    ]);
    if($validator->fails()) {
      return back()
        ->withInput()
        ->with('ErrorInsert', 'Favor de llenar todos los campos')
        ->withErrors($validator);
    } else {
      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'image' => 'default.jpg',
        'role' => $request->role
      ]);
      return back()->with('Listo', 'Usuario creado correctamente');
    }
  }
}