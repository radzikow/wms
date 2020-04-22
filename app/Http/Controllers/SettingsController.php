<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
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
    $settings = Setting::all();

    $sidebar = Setting::where('nesting', 'Sidebar')->get();

    $websiteContent = Setting::where('nesting', 'Website Content')->get();

    $blog = Setting::where('nesting', 'Blog')->get();

    return view('settings.index', ['settings' => $settings, 'sidebar' => $sidebar, 'websiteContent' => $websiteContent, 'blog' => $blog]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function active($id)
  {
    DB::table('settings')
      ->where('id', $id)
      ->update([
        "status" => 1,
      ]);

    Session::flash('alert-message', 'Settings updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return back();
  }

  public function inactive($id)
  {
    DB::table('settings')
    ->where('id', $id)
    ->update([
      "status" => 0,
    ]);

  Session::flash('alert-message', 'Settings updated successfully!');
  Session::flash('alert-class', 'alert-success');

  // Redirect
  return back();
  }
}
