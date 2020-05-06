<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{

  // ===============================================================
  public function __construct()
  {
    $this->middleware('auth');

    // ------------------------------
    // create file contact.json if it doesn't exist
    if (!Storage::disk('local')->exists('contact.json')) {

      $data = [
        "contact" => [
          "company_name" => "",
          "company_nip" => "",
          "company_regon" => "",
          "company_number1" => "",
          "company_number2" => "",
          "company_email1" => "",
          "company_email2" => "",
          "company_address1" => "",
          "company_address2" => "",
          "company_hours1" => "",
          "company_hours2" => ""
        ],
        "social" => [
          "linkedin" => "",
          "facebook" => "",
          "twitter" => ""
        ]
      ];

      Storage::disk('local')->put('contact.json', json_encode($data));
    }
  }

  // ===============================================================
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (Storage::disk('local')->exists('contact.json')) {
      // ------------------------------
      // get json file from storage
      $path = Storage::disk('local')->get('contact.json');

      // ------------------------------
      // create file contact.json if it doesn't exist
    } else if (!Storage::disk('local')->exists('contact.json')) {

      $data = [
        "contact" => [
          "company_name" => "",
          "company_nip" => "",
          "company_regon" => "",
          "company_number1" => "",
          "company_number2" => "",
          "company_email1" => "",
          "company_email2" => "",
          "company_address1" => "",
          "company_address2" => "",
          "company_hours1" => "",
          "company_hours2" => ""
        ],
        "social" => [
          "linkedin" => "",
          "facebook" => "",
          "twitter" => ""
        ]
      ];

      Storage::disk('local')->put('contact.json', json_encode($data));
    }


    // ------------------------------
    // convert json to array
    $content = json_decode($path, true);

    $contactInfo = $content['contact'];
    $socialLinks = $content['social'];

    return view('website-content.contact.index', ['contactInfo' => $contactInfo, 'socialLinks' => $socialLinks]);
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
    if ($request && Storage::exists('contact.json')) {

      $path = public_path('files/contact.json');

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
          "linkedin" => $request->linkedin,
          "facebook" => $request->facebook,
          "twitter" => $request->twitter
        ]
      ];

      $updated = json_encode($data);

      file_put_contents($path, $updated);

      // ------------------------------
      // create file contact.json if it doesn't exist
    } else if (!Storage::disk('local')->exists('contact.json')) {

      $data = [
        "contact" => [
          "company_name" => "",
          "company_nip" => "",
          "company_regon" => "",
          "company_number1" => "",
          "company_number2" => "",
          "company_email1" => "",
          "company_email2" => "",
          "company_address1" => "",
          "company_address2" => "",
          "company_hours1" => "",
          "company_hours2" => ""
        ],
        "social" => [
          "linkedin" => "",
          "facebook" => "",
          "twitter" => ""
        ]
      ];

      Storage::disk('local')->put('contact.json', json_encode($data));
    }

    // ------------------------------
    // alerts
    Session::flash('alert-message', 'Contact informations updated successfully!');
    Session::flash('alert-class', 'alert-success');

    return redirect('dashboard/contact');
  }
}
