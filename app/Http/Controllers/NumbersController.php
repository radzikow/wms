<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NumbersController extends Controller
{

  // ===============================================================
  public function __construct()
  {
    $this->middleware('auth');

    // ------------------------------
    // create file numbers.json if it doesn't exist
    if (!Storage::disk('local')->exists('numbers.json')) {

      $data = [
        "numbers" => [
          "clients_no" => 0,
          "projects_no" => 0,
          "coffees_no" => 0
        ]
      ];

      Storage::disk('local')->put('numbers.json', json_encode($data));
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
    if (Storage::disk('local')->exists('numbers.json')) {
      // ------------------------------
      // get json file from storage
      $path = Storage::disk('local')->get('numbers.json');

      // ------------------------------
      // create file numbers.json if it doesn't exist
    } else if (!Storage::disk('local')->exists('numbers.json')) {

      $data = [
        "numbers" => [
          "clients_no" => 0,
          "projects_no" => 0,
          "coffees_no" => 0
        ]
      ];

      Storage::disk('local')->put('numbers.json', json_encode($data));
    }

    // ------------------------------
    // convert json to array
    $content = json_decode($path, true);

    $numbers = $content['numbers'];

    return view('website-content.numbers.index', ['numbers' => $numbers]);
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
    if ($request && Storage::disk('local')->exists('numbers.json')) {

      // ------------------------------
      // get file path
      $path = public_path('files/numbers.json');

      $data = [
        "numbers" => [
          "clients_no" => $request->clientsNumber,
          "projects_no" => $request->projectsNumber,
          "coffees_no" => $request->coffeesNumber
        ]
      ];

      $updated = json_encode($data);

      // ------------------------------
      // update file content
      file_put_contents($path, $updated);

      // ------------------------------
      // create file numbers.json if it doesn't exist
    } else if (!Storage::disk('local')->exists('numbers.json')) {

      $data = [
        "numbers" => [
          "clients_no" => 0,
          "projects_no" => 0,
          "coffees_no" => 0
        ]
      ];

      Storage::disk('local')->put('numbers.json', json_encode($data));
    }

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'Numbers updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('dashboard/numbers');
  }
}
