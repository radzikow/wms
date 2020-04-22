<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    // Get 5 most popular posts
    $posts = DB::table('posts')
      ->orderBy('views')
      ->take(5)
      ->get();

    // Get 5 recently added comments
    $comments = DB::table('comments')
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();

    // Get 5 recently added users
    $users = DB::table('users')
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();

    return view('dashboard', ['posts' => $posts, 'comments' => $comments, 'users' => $users]);
  }
}
