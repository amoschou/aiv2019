<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use Validator;
use Illuminate\Support\Str;

class PersonalInformationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function complexchoir(Request $request)
  {
    $context = [
      'sectionshortname' => NULL,
      'accordionshow' => 'complexdata',
      'iscommittee' => $request->user()->iscommittee,
      'sectionid' => NULL
    ];
    return view('registration.personalinformation.complex.choir',$context);
  }
  
}
