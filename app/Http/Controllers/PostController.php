<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Post;
use App\Topic;


class PostController extends Controller
{

  // ===============================================================
  public function __construct()
  {
    $this->middleware('auth');
  }

  // ===============================================================
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

  // ===============================================================
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

  // ===============================================================
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // ------------------------------
    // new post instance
    $post = new Post();

    // ------------------------------
    // modify status value
    $postStatus = request('postStatus');
    if ($postStatus === 'on') {
      $postStatus = 1;
    } else {
      $postStatus = 0;
    }

    // ------------------------------
    // validation
    $validator = Validator::make($request->all(), [
      'postTitle' => 'required|min:10|max:100',
      'postAuthor' => 'required',
      'postDate' => 'required|date',
      'postTopic' => 'required',
      'postTags' => 'required',
      'postShort' => 'required|min:200|max:800',
      'postLong' => 'required|min:800',
      'postImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:1000'
    ]);

    if ($validator->fails()) {

      // ------------------------------
      // alerts
      Session::flash('alert-message', 'Error occured. Please fill correctly all required fields!');
      Session::flash('alert-class', 'alert-danger');

      // ------------------------------
      // redirect with validation messages
      return redirect('dashboard/posts/create')
        ->withErrors($validator)
        ->withInput();
    }

    // ------------------------------
    // image upload
    if ($request->hasFile('postImage')) {

      $image = $request->file('postImage');

      // save to server (public)
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $public_destination = 'blog_images';
      $public_path = $image->storeAs($public_destination, $newImageName);

      // save to aws s3
      $s3_destination = 'wms-template/images/blog';
      $s3_path = Storage::disk('s3')->put($s3_destination, $image, 'public');
    }

    // ------------------------------
    // new post instace data
    $post->title = request('postTitle');
    $post->user_id = request('postAuthor');
    $post->date = request('postDate');
    $post->topic_id = request('postTopic');
    $post->tags = request('postTags');
    $post->short_text = request('postShort');
    $post->long_text = request('postLong');
    $post->image_public_path = $public_path;
    $post->image_s3_path = $s3_path;
    $post->status = $postStatus;

    // ------------------------------
    // save new post to db
    $post->save();

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'New post created successfully!');
    Session::flash('alert-class', 'alert-success');

    // ------------------------------
    // redirect

    return redirect('/dashboard/posts');
  }

  // ===============================================================
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

  // ===============================================================
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

  // ===============================================================
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    // ------------------------------
    // get post by id
    $post = DB::table('posts')->find($request->postId);

    // ------------------------------
    // modify status value
    $postStatus = request('postStatus');
    if ($postStatus == 'on') {
      $postStatus = 1;
    } else {
      $postStatus = 0;
    }

    // ------------------------------
    // validation
    $validator = Validator::make($request->all(), [
      'postTitle' => 'required|min:10|max:100',
      'postAuthor' => 'required',
      'postDate' => 'required|date',
      'postTopic' => 'required',
      'postTags' => 'required',
      'postShort' => 'required|min:200|max:800',
      'postLong' => 'required|min:800',
      'postImage' => 'file|image|mimes:jpeg,jpg,png,gif|max:1000'
    ]);

    if ($validator->fails()) {
      return redirect('/dashboard/posts/' . $request->postId)
        ->withErrors($validator)
        ->withInput();
    }

    // ------------------------------
    // image upload
    if ($request->hasFile('postImage')) {

      $image = $request->file('postImage');

      // save new image to server (public)
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $public_destination = 'blog_images';
      $public_path = $image->storeAs($public_destination, $newImageName);

      // delete previous image from server (public)
      Storage::delete($post->image);

      // save new image to aws s3
      $s3_destination = 'wms-template/images/blog';
      $s3_path = Storage::disk('s3')->put($s3_destination, $image, 'public');

      // delete previous image from aws 3s
      Storage::disk('s3')->delete($post->image);

      DB::table('posts')
        ->where('id', $request->postId)
        ->update([
          "image_storage_path" => $public_path,
          "image_s3_path" => $s3_path,
        ]);
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
        "image_storage_path" => $public_path,
        "image_s3_path" => $s3_path,
        "status" => $postStatus,
      ]);

    // Create new alert
    Session::flash('alert-message', 'Post updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/posts');
  }

  // ===============================================================
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // ------------------------------
    // find post by id
    $post = Post::findOrFail($id);

    // ------------------------------
    // delete image from db
    $post->delete();

    // ------------------------------
    // delete image from public storage
    Storage::delete($post->image_public_path);

    // ------------------------------
    // delete image from aws s3
    Storage::disk('s3')->delete($post->image_s3_path);

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'Post deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }

  // public function showImage($url)
  // {
  //   $disk = Storage::disk('s3');
  //   $path = $disk->url($url);
  //   return $path;
  // }
}
