<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
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
    $comments = Comment::sortable()->paginate(10);

    $posts = Post::all();

    return view('comments.index', ['comments' => $comments, 'posts' => $posts]);
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
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $comment = DB::table('comments')->find($id);

    $posts = Post::all();

    return view('comments.edit', ['comment' => $comment, 'posts' => $posts]);
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
  public function update(Request $request)
  {
    DB::table('comments')
      ->where('id', $request->commentId)
      ->update([
        "text" => $request->commentText,
        "status" => $request->commentStatus,
      ]);

    // Create new alert
    Session::flash('alert-message', 'Comment updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/comments');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $comment = Comment::findOrFail($id);
    $comment->delete();

    Session::flash('alert-message', 'Comment deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }

  public function accept($id)
  {
    DB::table('comments')
      ->where('id', $id)
      ->update([
        "status" => 1,
      ]);

    Session::flash('alert-message', 'Comment accepted successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return back();
  }

  public function reject($id)
  {
    DB::table('comments')
      ->where('id', $id)
      ->update([
        "status" => 0,
      ]);

    Session::flash('alert-message', 'Comment rejected successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return back();
  }
}
