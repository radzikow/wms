<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PolicyController extends Controller
{

  // ===============================================================
  public function __construct()
  {
    $this->middleware('auth');

    // ------------------------------
    // create file policy.txt if it doesn't exist
    if (!Storage::disk('local')->exists('policy.txt')) {
      // $path = Storage::disk('local');
      Storage::disk('local')->put('policy.txt', 'no policy');
    }
  }

  // ===============================================================
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (Storage::disk('local')->exists('policy.txt')) {
      // ------------------------------
      // get file
      $policy = Storage::disk('local')->get('policy.txt');
    } else if (!Storage::disk('local')->exists('policy.txt')) {
      // $path = Storage::disk('local');
      Storage::disk('local')->put('policy.txt', 'no policy');
    }

    return view('website-content.policy.index', ['policy' => $policy]);
  }

  // ===============================================================
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // ------------------------------
    // get new policy from textarea
    $policy = $request->policyContent;

    if ($policy && Storage::disk('local')->exists('policy.txt')) {
      // ------------------------------
      // update file
      Storage::disk('local')->put('policy.txt', $policy);
    } else if ($policy && !(Storage::disk('local')->exists('policy.txt'))) {
      Storage::disk('local')->put('policy.txt', $policy);
    }

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'Privacy & Cookies Policy updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('dashboard/policy');
  }
}
