<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
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
    $banners = Banner::sortable()->paginate(10);

    return view('website-content.banners.index', [
      'banners' => $banners
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('website-content.banners.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $banner = new Banner();

    // Modify status value
    $bannerStatus = request('bannerStatus');
    if ($bannerStatus === 'on') {
      $bannerStatus = 1;
    } else {
      $bannerStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'bannerTitle' => 'required|min:10|max:150',
      'bannerImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages
      return redirect('dashboard/banners/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('bannerImage')) {

      $image = $request->file('bannerImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'banners_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    }

    // Save all input values to new post instance
    $banner->title = request('bannerTitle');
    $banner->text_1 = request('bannerText1');
    $banner->text_2 = request('bannerText2');
    $banner->btn_link = request('bannerBtnLink');
    $banner->btn_text = request('bannerBtnText');
    $banner->image = $newImageName;
    $banner->status = $bannerStatus;

    $banner->save();

    // Create new alerts
    Session::flash('alert-message', 'New banner created successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/banners');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $banner = DB::table('banners')->find($id);

    return view('website-content.banners.edit', ['banner' => $banner]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('website-content.banners.edit');
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
    $bannerStatus = request('bannerStatus');
    if ($bannerStatus === 'on') {
      $bannerStatus = 1;
    } else {
      $bannerStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'bannerTitle' => 'required|min:10|max:150',
      'bannerImage' => 'file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages
      return redirect('dashboard/banners/' . $request->bannerId)
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('bannerImage')) {
      $image = $request->file('bannerImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'banners_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    } else {
      $newImageName = $request->bannerPrevImage;
    }

    DB::table('banners')
      ->where('id', $request->bannerId)
      ->update([
        "title" => $request->bannerTitle,
        "text_1" => $request->bannerText1,
        "text_2" => $request->bannerText2,
        "btn_link" => $request->bannerBtnLink,
        "btn_text" => $request->bannerBtnText,
        "image" => $newImageName,
        "status" => $bannerStatus,
      ]);

    // Create new alert
    Session::flash('alert-message', 'Banner updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/banners');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $banner = Banner::findOrFail($id);
    $banner->delete();

    Session::flash('alert-message', 'Banner deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
