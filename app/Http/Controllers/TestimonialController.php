<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
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
    $testimonials = Testimonial::sortable()->paginate(10);

    return view('website-content.testimonials.index', [
      'testimonials' => $testimonials
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('website-content.testimonials.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $testimonial = new Testimonial();

    // Modify status value
    $testimonialStatus = request('testimonialStatus');
    if ($testimonialStatus === 'on') {
      $testimonialStatus = 1;
    } else {
      $testimonialStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'testimonialName' => 'required|min:10|max:150',
      'testimonialImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages
      return redirect('dashboard/testimonials/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('testimonialImage')) {

      $image = $request->file('testimonialImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'testimonials_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    }

    // Save all input values to new post instance
    $testimonial->name = request('testimonialName');
    $testimonial->company = request('testimonialCompany');
    $testimonial->text = request('testimonialText');
    $testimonial->stars = request('testimonialStars');
    $testimonial->date = request('testimonialDate');
    $testimonial->image = $newImageName;
    $testimonial->status = $testimonialStatus;

    $testimonial->save();

    // Create new alerts
    Session::flash('alert-message', 'New testimonial created successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/testimonials');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $testimonial = DB::table('testimonials')->find($id);

    return view('website-content.testimonials.edit', ['testimonial' => $testimonial]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('website-content.testimonials.edit');
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
    $testimonialStatus = request('testimonialStatus');
    if ($testimonialStatus === 'on') {
      $testimonialStatus = 1;
    } else {
      $testimonialStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'testimonialName' => 'required|min:10|max:150',
      'testimonialImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages
      return redirect('dashboard/testimonials/' . $request->testimonialId)
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('testimonialImage')) {

      $image = $request->file('testimonialImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'testimonials_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    } else {
      $newImageName = $request->testimonialPrevImage;
    }

    DB::table('testimonials')
      ->where('id', $request->testimonialId)
      ->update([
        "name" => $request->testimonialName,
        "company" => $request->testimonialCompany,
        "text" => $request->testimonialText,
        "stars" => $request->testimonialStars,
        "date" => $request->testimonialDate,
        "image" => $newImageName,
        "status" => $testimonialStatus
      ]);

    // Create new alert
    Session::flash('alert-message', 'Testimonial updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/testimonials');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $testimonial = Testimonial::findOrFail($id);
    $testimonial->delete();

    Session::flash('alert-message', 'Testimonial deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
