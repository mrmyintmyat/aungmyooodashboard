<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AdminPanelController extends Controller
{
  public function index(){
    return view('admin.home');
  }

  public function create(){
    return view('admin.create_user');
  }

  public function store(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
          'siteName' => ['required', 'string'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      }

      $user = User::create([
          'name' => $request->input('name'),
          'siteName' => $request->input('siteName'),
          'email' => $request->input('email'),
          'password' => Hash::make($request->input('password')),
      ]);

      return back()->with('success', 'User created successfully');
  }

  public function ShowUsersPage(){
    $users = User::latest()->paginate(10);
    return view('admin.users', compact('users'));
  }

  public function show($id)
  {
      // Logic for displaying a specific admin panel item
  }

  public function edit($id)
  {
    $user = User::find($id);
    if (!$user) {
        session()->flash('error', 'User not found.');
    }
    return view('admin.update_user', compact('user'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'siteName' => ['required', 'string'],
        'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        'role' => 'required|in:admin,user',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->siteName = $request->siteName;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->save();

    return redirect()->back()->with('success', 'User updated successfully');
  }

  public function destroy($id)
  {
      $user = User::find($id);

      if (!$user) {
          return response()->json([
              'error' => 'User not found.',
              'status' => false
          ], 404);
      }

      $user->delete();

      return response()->json([
          'message' => 'User deleted successfully.',
          'status' => true
      ], 200);
  }

}
