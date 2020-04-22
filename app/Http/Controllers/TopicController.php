<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{

  public function __contruct()
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
    $topics = Topic::sortable()->paginate(10);

    return view('topics.index', ['topics' => $topics]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('topics.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $topic = new Topic();

    $topicStatus = request('topicStatus');
    if ($topicStatus === 'on') {
      $topicStatus = 1;
    } else {
      $topicStatus = 0;
    }

    $validator = Validator::make($request->all(), [
      'topicName' => 'required|min:3|max:50',
      'topicDescription' => 'required|min:10|max:100',
    ]);

    if ($validator->fails()) {
      return redirect('/dashboardtopics/create')
        ->withErrors($validator)
        ->withInput();
    }

    $topic->name = request('topicName');
    $topic->description = request('topicDescription');
    $topic->status = $topicStatus;

    $topic->save();

    Session::flash('alert-message', 'New topic (' . request('topicName') . ') created successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('/dashboard/topics');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $topic = DB::table('topics')->find($id);

    return view('topics.edit', ['topic' => $topic]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('topics.edit');
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
    $topicStatus = request('topicStatus');
    if ($topicStatus === 'on') {
      $topicStatus = 1;
    } else {
      $topicStatus = 0;
    }

    $validator = Validator::make($request->all(), [
      'topicName' => 'required|min:3|max:50',
      'topicDescription' => 'required|min:10|max:100',
    ]);

    if ($validator->fails()) {
      return redirect('/dashboard/topics/' . $request->topicId)
        ->withErrors($validator)
        ->withInput();
    }

    DB::table('topics')
      ->where('id', $request->topicId)
      ->update([
        "name" => $request->topicName,
        "description" => $request->topicDescription,
        "status" => $topicStatus,
      ]);

    Session::flash('alert-message', 'Topic (' . $request->topicName . ') updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('/dashboard/topics');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $topic = Topic::findOrFail($id);
    $topic->delete();

    Session::flash('alert-message', 'Topic (' . $topic->name . ') deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('/dashboard/topics');
  }
}
