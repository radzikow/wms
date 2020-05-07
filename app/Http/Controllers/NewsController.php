<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
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
    $allNews = News::sortable()->paginate(10);

    return view('news.index', ['allNews' => $allNews]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('news.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $newNews = new News();

    // Modify status value
    $newsStatus = request('newsStatus');
    if ($newsStatus === 'on') {
      $newsStatus = 1;
    } else {
      $newsStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'newsTitle' => 'required|min:10|max:100',
      'newsDate' => 'required|date',
      'newsContent' => 'required|min:100',
      'newsImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages

      return redirect('/dashboard/news/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('newsImage')) {

      $image = $request->file('newsImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'news_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    }

    // Save all input values to new post instance
    $newNews->title = request('newsTitle');
    $newNews->date = request('newsDate');
    $newNews->content = request('newsContent');
    $newNews->image = $newImageName;
    $newNews->status = $newsStatus;

    // Save a new post to a db
    $newNews->save();

    // Create new alerts
    Session::flash('alert-message', 'News created successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/news');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $oneNews = DB::table('news')->find($id);

    return view('news.edit', ['oneNews' => $oneNews]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('news.edit');
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
    $newsStatus = request('newsStatus');
    if ($newsStatus === 'on') {
      $newsStatus = 1;
    } else {
      $newsStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'newsTitle' => 'required|min:10|max:100',
      'newsDate' => 'required|date',
      'newsContent' => 'required|min:20',
      'postImage' => 'file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages
      return redirect('/dashboard/news/'  . $request->newsId)
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('newsImage')) {
      $image = $request->file('newsImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = time() . '.' . $imageExtension;
      $destinationPath = 'news_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    } else {
      $newImageName = $request->newsPrevImage;
    }

    DB::table('news')
      ->where('id', $request->newsId)
      ->update([
        "title" => $request->newsTitle,
        "date" => $request->newsDate,
        "content" => $request->newsContent,
        "image" => $newImageName,
        "status" => $newsStatus,
      ]);

    // Create new alert
    Session::flash('alert-message', 'News updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/news');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $oneNews = News::findOrFail($id);
    $oneNews->delete();

    Session::flash('alert-message', 'News deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
