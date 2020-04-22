<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function index()
  {
    return view('dashboard');
  }


  // Manually Authenticating Users
  public function authenticate(Request $request)
  {
    // $credentials = $request->only('email', 'password');

    $email = $request->input('email');
    $password = $request->input('password');
    $status = 1;
    $remember = $request->input('remember');

    if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => $status], $remember)) {
      // Authentication passed...

      Session::flash('alert-message', 'Subscriber logged out successfully!');
      Session::flash('alert-class', 'alert-primary');

      return redirect()->intended('/dashboard');
    } else {
      // No passed...
      return redirect()->intended('/home');
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();

    Session::flash('alert-message', 'Subscriber logged out successfully!');
    Session::flash('alert-class', 'alert-primary');

    return redirect('/login');
  }

  // Guard Customization
  // protected function guard()
  // {
  //   return Auth::guard('routes-guard');
  // }
}
