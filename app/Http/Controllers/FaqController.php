<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
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
    $faqs = Faq::sortable()->paginate(10);

    return view('website-content.faq.index', ['faqs' => $faqs]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('website-content.faq.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $faq = new Faq();

    // Modify status value
    $faqStatus = request('faqStatus');
    if ($faqStatus === 'on') {
      $faqStatus = 1;
    } else {
      $faqStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'faqQuestion' => 'required|min:10|max:100',
      'faqAnswer' => 'required|min:10|max:800'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {
      return redirect('/dashboard/faq/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Save all input values to new post instance
    $faq->question = request('faqQuestion');
    $faq->answer = request('faqAnswer');
    $faq->status = $faqStatus;

    // Save a new post to a db
    $faq->save();

    // Create new alerts
    Session::flash('alert-message', 'New FAQ created successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/faq');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $faq = DB::table('faqs')->find($id);

    return view('website-content.faq.edit', ['faq' => $faq]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('website-content.faq.edit');
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
    // Modify status value
    $faqStatus = request('faqStatus');
    if ($faqStatus === 'on') {
      $faqStatus = 1;
    } else {
      $faqStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'faqQuestion' => 'required|min:10|max:100',
      'faqAnswer' => 'required|min:10|max:800'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {
      return redirect('/dashboard/faq/' . $request->faqId)
        ->withErrors($validator)
        ->withInput();
    }

    DB::table('faqs')
      ->where('id', $request->faqId)
      ->update([
        "question" => $request->faqQuestion,
        "answer" => $request->faqAnswer,
        "status" => $faqStatus
      ]);

    // Create new alerts
    Session::flash('alert-message', 'FAQ updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/faq');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $faq = Faq::findOrFail($id);
    $faq->delete();

    Session::flash('alert-message', 'FAQ deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
