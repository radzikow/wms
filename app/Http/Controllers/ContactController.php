<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
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
    // TODO: how to get json file from aws s3???
    if (Storage::disk('s3')->exists('https://radzikowwmsbucket.s3.eu-central-1.amazonaws.com/wms-template/contact.json')) {
      // get json file from aws s3
      $path = Storage::disk('s3')->get('https://radzikowwmsbucket.s3.eu-central-1.amazonaws.com/wms-template/contact.json');
    } else if (Storage::disk('local')->exists('contact.json')) {
      // get json file from storage
      $path = Storage::disk('local')->get('contact.json');
    } else {
      // get json file from storage
      $path = Storage::disk('public')->get('contact.json');
    }

    $content = json_decode($path, true);

    $contactInfo = $content['contact'];
    $socialLinks = $content['social'];

    return view('website-content.contact.index', ['contactInfo' => $contactInfo, 'socialLinks' => $socialLinks]);
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
    if ($request && Storage::exists('contact.json')) {

      $path = public_path('storage/contact.json');
      // $content = json_decode(file_get_contents($path), true);

      $data = [
        "contact" => [
          "company_name" => $request->companyName,
          "company_nip" => $request->companyNip,
          "company_regon" => $request->companyRegon,
          "company_number1" => $request->phoneNumber1,
          "company_number2" => $request->phoneNumber2,
          "company_email1" => $request->emailAddress1,
          "company_email2" => $request->emailAddress2,
          "company_address1" => $request->companyAddress1,
          "company_address2" => $request->companyAddress2,
          "company_hours1" => $request->companyHours1,
          "company_hours2" => $request->companyHours2
        ],
        "social" => [
          "linkedin" => "linkedin link",
          "facebook" => "facebook link",
          "twitter" => "twitter link"
        ]
      ];

      $updated = json_encode($data);

      file_put_contents($path, $updated);
    } else {
      return 'Error occured when saving json file in app filestorage!';
    }

    // Create new alerts
    Session::flash('alert-message', 'Contact informations updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('dashboard/contact');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
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
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
