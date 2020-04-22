<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
  //

  public function test()
  {
    // return view('test', ['firstname' => 'John', 'lastname' => 'Doe']);

    $firstname = 'John';
    $lastname = 'Doe';

    // return view('test', compact('firstname', 'lastname'));
    return view('test');
  }

  public function file(Request $request)
  {
    $path = $request->file('photo')->store('blog_images');

    dd($path);

    // return view('test');
  }
}
