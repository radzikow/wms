<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
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
    $projects = Project::sortable()->paginate(10);

    return view('website-content.projects.index', [
      'projects' => $projects
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('website-content.projects.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $project = new Project();

    // Modify status value
    $projectStatus = request('projectStatus');
    if ($projectStatus === 'on') {
      $projectStatus = 1;
    } else {
      $projectStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'projectTitle' => 'required|min:10|max:150',
      'projectImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {
      return redirect('dashboard/projects/create')
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('projectImage')) {

      $image = $request->file('projectImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'projects_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    }

    // Save all input values to new post instance
    $project->title = request('projectTitle');
    $project->company = request('projectCompany');
    $project->category = request('projectCategory');
    $project->description_1 = request('projectDescription2');
    $project->description_2 = request('projectDescription2');
    $project->btn_link = request('projectBtnLink');
    $project->btn_text = request('projectBtnText');
    $project->list_1 = request('projectList1');
    $project->list_2 = request('projectList2');
    $project->image = $newImageName;
    $project->status = $projectStatus;

    $project->save();

    // Create new alerts
    Session::flash('alert-message', 'New project created successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/projects');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $project = DB::table('projects')->find($id);

    return view('website-content.projects.edit', ['project' => $project]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('website-content.projects.edit');
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
    $projectStatus = request('projectStatus');
    if ($projectStatus === 'on') {
      $projectStatus = 1;
    } else {
      $projectStatus = 0;
    }

    // Inputs validation
    $validator = Validator::make($request->all(), [
      'projectTitle' => 'required|min:10|max:150',
      'projectImage' => 'required|file|image|mimes:jpeg,jpg,png,gif|max:10000'
    ]);

    // Check if any validation failed
    if ($validator->fails()) {
      return redirect('dashboard/projects/' . $request->projectId)
        ->withErrors($validator)
        ->withInput();
    }

    // Get file and save it to a filesystem
    if ($request->hasFile('projectImage')) {

      $image = $request->file('projectImage');
      $imageExtension = $image->getClientOriginalExtension();
      $newImageName = rand() . '.' . $imageExtension;
      $destinationPath = 'projects_images';

      $path = $image->storeAs($destinationPath, $newImageName);
    } else {
      $newImageName = $request->projectPrevImage;
    }

    DB::table('projects')
      ->where('id', $request->projectId)
      ->update([
        "title" => $request->projectTitle,
        "company" => $request->projectCompany,
        "category" => $request->projectCategory,
        "description_1" => $request->projectDescription1,
        "description_2" => $request->projectDescription2,
        "btn_link" => $request->projectBtnLink,
        "btn_text" => $request->projectBtnText,
        "list_1" => $request->projectList1,
        "list_2" => $request->projectList2,
        "image" => $newImageName,
        "status" => $projectStatus,
      ]);

    // Create new alert
    Session::flash('alert-message', 'Project updated successfully!');
    Session::flash('alert-class', 'alert-success');

    // Redirect
    return redirect('/dashboard/projects');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $project = Project::findOrFail($id);
    $project->delete();

    Session::flash('alert-message', 'Project deleted successfully!');
    Session::flash('alert-class', 'alert-success');

    return back();
  }
}
