<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Rules\CheckPass;


class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    // Session::flash('updateInfo-status', 'active');

    // $infoStatus = $request->session()->get('updateInfo-status');
    // $passStatus = $request->session()->get('passStatus-status');

    $user = Auth::user();

    return view('profile.index', ['user' => $user]);
  }

  public function updateInfo(Request $request)
  {
    $user = Auth::user();
    $user_id = Auth::id();

    $user_email = $user->email;

    $email = $request->email;

    if ($email === $user_email) {
      $validator = Validator::make($request->all(), [
        'firstname' => 'required|min:3|max:50',
        'lastname' => 'required|min:3|max:50'
      ]);

      if ($validator->fails()) {

        // ------------------------------
        // alerts
        Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
        Session::flash('alert-class', 'alert-danger');

        // ------------------------------
        // redirect with validation messages
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }

      DB::table('users')
        ->where('id', $user_id)
        ->update([
          "firstname" => $request->firstname,
          "lastname" => $request->lastname,
          "email" => $user_email
        ]);
    } else {

      $validator = Validator::make($request->all(), [
        'firstname' => 'required|min:3|max:50',
        'lastname' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users,email'
      ]);

      if ($validator->fails()) {

        // ------------------------------
        // alerts
        Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
        Session::flash('alert-class', 'alert-danger');

        // ------------------------------
        // redirect with validation messages
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }

      DB::table('users')
        ->where('id', $user_id)
        ->update([
          "firstname" => $request->firstname,
          "lastname" => $request->lastname,
          "email" => $email
        ]);
    }

    Session::flash('alert-message', 'Profile information updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return back();
  }

  // Update password
  public function updatePass(Request $request)
  {
    // Get currently logged in user
    $user_id = Auth::id();
    $user = DB::table('users')->find($user_id);

    // check if current password is correct
    if (Hash::check($request->currentPassword, $user->password)) {
      $validator = Validator::make($request->all(), [
        'currentPassword' => ['required', new CheckPass],
        'newPassword' => 'required|confirmed|min:4',
        'newPassword_confirmation' => 'required'
      ]);

      if ($validator->fails()) {

        // ------------------------------
        // alerts
        Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
        Session::flash('alert-class', 'alert-danger');

        // ------------------------------
        // redirect with validation messages
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
    } else {
      $validator = Validator::make($request->all(), [
        'currentPassword' => ['required', new CheckPass],
        'newPassword' => 'required|confirmed|min:4',
        'newPassword_confirmation' => 'required'
      ]);

      if ($validator->fails()) {

        // ------------------------------
        // alerts
        Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
        Session::flash('alert-class', 'alert-danger');

        // ------------------------------
        // redirect with validation messages
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
    }

    DB::table('users')
      ->where('id', $user_id)
      ->update([
        "password" => Hash::make($request->newPassword)
      ]);

    Session::flash('alert-message', 'Profile password updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return back();
  }
}
