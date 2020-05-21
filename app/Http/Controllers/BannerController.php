<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

  // ================================================
  public function __construct()
  {
    $this->middleware('auth');
  }

  // ================================================
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

  // ================================================
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('website-content.banners.create');
  }

  // ================================================
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // ------------------------------
    // new banner instance
    $banner = new Banner();

    // ------------------------------
    // modify status value
    $bannerStatus = request('bannerStatus');
    if ($bannerStatus === 'on') {
      $bannerStatus = 1;
    } else {
      $bannerStatus = 0;
    }

    // ------------------------------
    // validation
    $validator = Validator::make($request->all(), [
      'bannerTitle' => 'required|min:10|max:150',
      'bannerImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

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

    // ------------------------------
    // image upload
    if ($request->hasFile('bannerImage')) {

      $image = $request->file('bannerImage');

      // save to server (public)
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $public_destination = 'banners_images';
      $public_path = $image->storeAs($public_destination, $newImageName);

      // save to aws s3
      // $s3_destination = 'wms-template/images/banners';
      // $s3_path = Storage::disk('s3')->put($s3_destination, $image, 'public');
    }

    // ------------------------------
    // new banner instace data
    $banner->title = request('bannerTitle');
    $banner->text_1 = request('bannerText1');
    $banner->text_2 = request('bannerText2');
    $banner->btn_link = request('bannerBtnLink');
    $banner->btn_text = request('bannerBtnText');
    $banner->image_public_path = $public_path;
    // $banner->image_s3_path = $s3_path;
    $banner->status = $bannerStatus;

    // ------------------------------
    // save new banner to db
    $banner->save();

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'New banner created successfully!');
    Session::flash('alert-class', 'alert-success');

    // ------------------------------
    // redirect
    return redirect('/dashboard/banners');
  }

  // ================================================
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

  // ================================================
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

  // ================================================
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    // ------------------------------
    // get banner by id
    $banner = DB::table('banners')->find($request->bannerId);

    // ------------------------------
    // modify status value
    $bannerStatus = request('bannerStatus');
    if ($bannerStatus === 'on') {
      $bannerStatus = 1;
    } else {
      $bannerStatus = 0;
    }

    // ------------------------------
    // validation
    $validator = Validator::make($request->all(), [
      'bannerTitle' => 'required|min:10|max:150',
      'bannerImage' => 'file|image|mimes:jpeg,jpg,png,gif|max:1000'
    ]);

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

    // ------------------------------
    // image upload
    if ($request->hasFile('bannerImage')) {

      $image = $request->file('bannerImage');

      // save new image to server (public)
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $public_destination = 'banners_images';
      $public_path = $image->storeAs($public_destination, $newImageName);

      // delete previous image from server (public)
      Storage::delete($banner->image_public_path);

      // save new image to aws s3
      // $s3_destination = 'wms-template/images/banners';
      // $s3_path = Storage::disk('s3')->put($s3_destination, $image, 'public');

      // delete previous image from aws 3s
      // Storage::disk('s3')->delete($banner->image_s3_path);

      DB::table('banners')
        ->where('id', $request->bannerId)
        ->update([
          "image_public_path" => $public_path,
          // "image_s3_path" => $s3_path,
        ]);
    }

    DB::table('banners')
      ->where('id', $request->bannerId)
      ->update([
        "title" => $request->bannerTitle,
        "text_1" => $request->bannerText1,
        "text_2" => $request->bannerText2,
        "btn_link" => $request->bannerBtnLink,
        "btn_text" => $request->bannerBtnText,
        "status" => $bannerStatus,
      ]);

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'Banner updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // ------------------------------
    // redirect
    return redirect('/dashboard/banners');
  }

  // ================================================
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // ------------------------------
    // find post by id
    $banner = Banner::findOrFail($id);

    // ------------------------------
    // delete image from db
    $banner->delete();

    // ------------------------------
    // delete image from public storage
    Storage::delete($banner->image_public_path);

    // ------------------------------
    // delete image from aws s3
    // Storage::disk('s3')->delete($banner->image_s3_path);

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'Banner deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
