<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Topic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class PostController extends Controller
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
    $posts = Post::sortable()->paginate(10);

    $users = User::all();
    $topics = Topic::all();

    return view('posts.index', [
      'posts' => $posts, 'users' => $users, 'topics' => $topics
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $users = User::all();
    $topics = Topic::all();

    return view('posts.create', ['users' => $users, 'topics' => $topics]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Create new post instance
    $post = new Post();

    // Get all users
    $users = User::all();

    // Get all topics
    $topics = Topic::all();

    // Modify status value
    $postStatus = request('postStatus');
    if ($postStatus === 'on') {
      $postStatus = 1;
    } else {
      $postStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'postTitle' => 'required|min:10|max:100',
      'postAuthor' => 'required',
      'postDate' => 'required|date',
      'postTopic' => 'required',
      'postTags' => 'required',
      'postShort' => 'required|min:200|max:800',
      'postLong' => 'required|min:800',
      'postImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {
      return redirect('dashboard/posts/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('postImage')) {

      $image = $request->file('postImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = '/blog_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    }

    // Save all input values to new post instance
    $post->title = request('postTitle');
    $post->user_id = request('postAuthor');
    $post->date = request('postDate');
    $post->topic_id = request('postTopic');
    $post->tags = request('postTags');
    $post->short_text = request('postShort');
    $post->long_text = request('postLong');
    $post->image = $newImageName;
    $post->status = $postStatus;

    // Save a new post to a db
    $post->save();

    // Create new alerts
    Session::flash('alert-message', 'New post created successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/posts');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // Get all users
    $users = User::all();

    // Get all topics
    $topics = Topic::all();

    $post = DB::table('posts')->find($id);
    return view('posts.edit', ['post' => $post, 'users' => $users, 'topics' => $topics]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('posts.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    // Modify status value
    $postStatus = request('postStatus');
    if ($postStatus == 'on') {
      $postStatus = 1;
    } else {
      $postStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'postTitle' => 'required|min:10|max:100',
      'postAuthor' => 'required',
      'postDate' => 'required|date',
      'postTopic' => 'required',
      'postTags' => 'required',
      'postShort' => 'required|min:200|max:800',
      'postLong' => 'required|min:800',
      'postImage' => 'file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {
      return redirect('/dashboard/posts/' . $request->postId)
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('postImage')) {
      $image = $request->file('postImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = time() . '.' . $imageExtension;
      $destinationPath = 'blog_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    } else {
      $newImageName = $request->postPrevImage;
    }

    DB::table('posts')
      ->where('id', $request->postId)
      ->update([
        "title" => $request->postTitle,
        "user_id" => $request->postAuthor,
        "date" => $request->postDate,
        "topic_id" => $request->postTopic,
        "tags" => $request->postTags,
        "short_text" => $request->postShort,
        "long_text" => $request->postLong,
        "image" => $newImageName,
        "status" => $postStatus,
      ]);

    // Create new alert
    Session::flash('alert-message', 'Post updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/posts');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->delete();

    Session::flash('alert-message', 'Post deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
