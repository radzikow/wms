<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NumbersController extends Controller
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
    // Get json file from storage
    $path = Storage::disk('public')->get('numbers.json');
    $content = json_decode($path, true);

    $numbers = $content['numbers'];

    // return json_decode(Storage::disk('public')->get('numbers.json'), true);

    return view('website-content.numbers.index', ['numbers' => $numbers]);
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
    if ($request && Storage::exists('numbers.json')) {

      $path = public_path('storage/numbers.json');
      // $content = json_decode(file_get_contents($path), true);

      $data = [
        "numbers" => [
          "clients_no" => $request->clientsNumber,
          "projects_no" => $request->projectsNumber,
          "coffees_no" => $request->coffeesNumber
        ]
      ];

      $updated = json_encode($data);

      file_put_contents($path, $updated);
    } else {
      return 'Error occured when saving json file in app filestorage!';
    }

    // Create new alerts
    Session::flash('alert-message', 'Numbers updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('dashboard/numbers');
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
}
