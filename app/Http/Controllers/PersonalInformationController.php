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
  
  public function complexsocial(Request $request)
  {
    $context = [
      'sectionshortname' => NULL,
      'accordionshow' => 'complexdata',
      'iscommittee' => $request->user()->iscommittee,
      'sectionid' => NULL
    ];
    return view('registration.personalinformation.complex.social',$context);
  }
  
  public function variousthings(Request $request)
  {
    $context = [
      'sectionshortname' => NULL,
      'accordionshow' => NULL,
      'iscommittee' => $request->user()->iscommittee,
      'sectionid' => NULL
    ];
    return view('registration.personalinformation.variousthings',$context);
  }
  
  public function byindividualindex(Request $request)
  {
    $context = [
      'sectionid' => NULL,
      'iscommittee' => $request->user()->iscommittee,
      'people' => DB::table('v_cols_essential')->select('id','firstname','lastname')->orderby('lastname','firstname','id')->get(),
    ];
    return view('registration.personalinformation.byindividual.index',$context);
  }
  
  public function userid(Request $request, $userid)
  {
    $q = "SELECT
            sectionid,
            sectionname,
            sectiondescr,
            sectionduplicateforeach
          from
            v_rego_required_sections
            natural join
            rego_sections
          where
            userid = ?
            and
            required = 'true'
          order by
            sectionord";


    $firstnamequery = "SELECT responsejson
                         FROM rego_responses
                              JOIN
                              iv_users
                              ON (id = userid)
                        WHERE questionshortname = 'firstname'
                              AND
                              userid = ?";
    $lastnamequery = "SELECT responsejson
                         FROM rego_responses
                              JOIN
                              iv_users
                              ON (id = userid)
                        WHERE questionshortname = 'lastname'
                              AND
                              userid = ?";
    $firstname = DB::select($firstnamequery,[$userid]);
    $lastname = DB::select($lastnamequery,[$userid]);
    $sections = DB::select($q,[$userid]);
    $context = [
      'firstname' => json_decode($firstname[0]->responsejson),
      'lastname' => json_decode($lastname[0]->responsejson),
      'sectionid' => NULL,
      'accordionshow' => 'bulkdata',
      'sections' => $sections,
      'iscommittee' => $request->user()->iscommittee,
      'personalinformation' => true,
      'userid' => $userid
    ];
    return view('registration.responses',$context);
  }
  
}
