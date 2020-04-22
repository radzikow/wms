<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;


class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // $users = User::all();
    // $users = User::paginate(7);
    // $posts = User::find(1)->posts;
    // $posts = Post::all();
    // $posts = Post::where('user_id', 2)->get();

    $users = User::sortable()->paginate(10);

    return view('users.index', ['users' => $users]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('users.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  // Request $request
  public function store(Request $request)
  {
    $user = new User();

    $userStatus = request('userStatus');

    if ($userStatus === 'on') {
      $userStatus = 1;
    } else {
      $userStatus = 0;
    }

    $validator = Validator::make($request->all(), [
      'userFirstname' => 'required|min:3|max:50',
      'userLastname' => 'required|min:3|max:50',
      'userEmail' => 'required|email|unique:users,email',
      'userPassword' => 'required|confirmed|min:4',
    ]);

    if ($validator->fails()) {
      return redirect('/dashboard/users/create')
        ->withErrors($validator)
        ->withInput();
    }

    $user->firstname = request('userFirstname');
    $user->lastname = request('userLastname');
    $user->email = request('userEmail');
    $user->role = request('userPrivileges');
    $user->password = Hash::make(request('userPassword'));
    $user->status = $userStatus;

    $user->save();

    Session::flash('alert-message', 'New user (' . request('userEmail') . ') created successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('/dashboard/users');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = DB::table('users')->find($id);

    return view('users.edit', ['user' => $user]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('users.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $userStatus = request('userStatus');
    if ($userStatus === 'on') {
      $userStatus = 1;
    } else {
      $userStatus = 0;
    }

    $userCurrentPassword = request('userCurrentPassword');

    if ($userCurrentPassword) {
      $userPassword = $request->userCurrentPassword;

      $validator = Validator::make($request->all(), [
        'userFirstname' => 'required|min:3|max:50',
        'userLastname' => 'required|min:3|max:50',
      ]);

      if ($validator->fails()) {
        return redirect('/dashboard/users/' . $request->userId)
          ->withErrors($validator)
          ->withInput();
      }
    } else {
      $userPassword = Hash::make($request->userPassword);

      $validator = Validator::make($request->all(), [
        'userFirstname' => 'required|min:3|max:50',
        'userLastname' => 'required|min:3|max:50',
        'userPassword' => 'confirmed|min:4',
      ]);

      if ($validator->fails()) {
        return redirect('/dashboard/users/' . $request->userId)
          ->withErrors($validator)
          ->withInput();
      }
    }

    DB::table('users')
      ->where('id', $request->userId)
      ->update([
        "firstname" => $request->userFirstname,
        "lastname" => $request->userLastname,
        "email" => $request->userEmail,
        "password" => $userPassword,
        "role" => $request->userPrivileges,
        "status" => $userStatus,
      ]);

    Session::flash('alert-message', 'User (' . $request->userEmail . ') updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('/dashboard/users');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    Session::flash('alert-message', 'User (' . $user->email . ') deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
