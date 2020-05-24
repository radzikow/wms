<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Analytics;
use Spatie\Analytics\Period;

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

    $date = \Carbon\Carbon::today()->subDays(7);
    $commentsThisWeek = DB::table('comments')
      ->where('created_at', '>=', $date)
      ->get();
    // dd($commentsThisWeek);

    //fetch the most visited pages for today and the past week
    $visitorsLastWeek = Analytics::fetchVisitorsAndPageViews(Period::days(7));

    //fetch visitors and page views for the past week
    $visitorsToday = Analytics::fetchVisitorsAndPageViews(Period::days(1));

    // $test = Analytics::getAnalyticsService();
    // dd($test);

    // $getActiveUsers = $this->getActiveUsers();
    $live_users = Analytics::getAnalyticsService()->data_realtime->get('ga:' . env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];

    return view('dashboard', [
      'posts' => $posts,
      'comments' => $comments,
      'users' => $users,
      'visitorsToday' => $visitorsToday,
      'visitorsLastWeek' => $visitorsLastWeek,
      'live_users' => $live_users,
      'commentsThisWeek' => count($commentsThisWeek)
    ]);
  }
}
