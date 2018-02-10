<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Firstly, have the essential details been asked and answered yet?
    switch(config('database.default'))
    {
      case('pgsql'):
        $query = "WITH Q AS (SELECT * FROM rego_questions WHERE sectionid = ?),
                       R AS (SELECT * FROM rego_responses WHERE userid = ?)
                     SELECT COUNT(*)
                       FROM Q
            LEFT OUTER JOIN R
                      USING (questionshortname)
                      WHERE userid IS NULL";
        break;
      case('mysql'):
        $query = "SELECT COUNT(*)
                    FROM (SELECT * FROM rego_questions WHERE sectionid = ?) Q
         LEFT OUTER JOIN (SELECT * FROM rego_responses WHERE userid = ?) R
                   USING (questionshortname)
                   WHERE userid IS NULL";
        break;
    }
    $essentialdetailsid = DB::table('rego_sections')
                            ->where('sectionname','Essential details')
                            ->value('sectionid');
    $params = [$essentialdetailsid,Auth::id()];
    $count = DB::select($query,$params)[0]->count;
    // If the count is not zero, then there are unanswered essential questions.
    if($count > 0)
    {
      // The essential questions do not have corresponding answers
      $context = [
        'singlesectionid' => $essentialdetailsid,
      ];
      return view('registration.form',$context);
    }
    
    
    $context = [
    ];
    return view('registration.dashboard',$context);
  }
  
  public function registrationform ($singlesectionid)
  {
    $context = [
      'singlesectionid' => $singlesectionid,
    ];
    return view('registration.form',$context);
  }
  
  public function registrationformpost (Request $request,$sectionid)
  {
    $sectionid = (int) $sectionid;
    $validationarray = [];
    $validationlogics = DB::table('rego_questions')
                          ->where('sectionid',$sectionid)
                          ->select('questionshortname','responsevalidationlogic','companionresponsevalidationlogic')
                          ->get();
    foreach($validationlogics as $logic)
    {
      $validationarray[$logic->questionshortname] = $logic->responsevalidationlogic;
      if(!is_null($logic->companionresponsevalidationlogic))
      {
        $exploded = explode(':',$logic->companionresponsevalidationlogic,2);
        $validationarray[$logic->questionshortname . ":" . $exploded[0]] = $exploded[1];
      }
    }
    $validatedData = $request->validate($validationarray);
    // Only continues if valid
    $data = $validatedData;
    $datakeys = array_keys($data);
    $falsekey = NULL;
    
    var_dump($data);
    var_dump($datakeys);
    
    DB::beginTransaction();
    foreach($datakeys as $datakey)
    {
      if(DB::table('rego_questions')->where('questionshortname',$datakey)->exists())
      {
        if(DB::table('rego_responses')
             ->where('userid',Auth::id())
             ->where('questionshortname',$datakey)
             ->exists())
        {
          DB::table('rego_responses')
            ->where('userid',Auth::id())
            ->where('questionshortname',$datakey)
            ->update([
            'responsejson' => json_encode($data[$datakey]),
          ]);
        }
        else
        {
          DB::table('rego_responses')->insert([
            'userid' => Auth::id(),
            'questionshortname' => $datakey,
            'responsejson' => json_encode($data[$datakey]),
          ]);
        }
      }
      else
      {
        if(DB::table('rego_responses_nofk')
             ->where('userid',Auth::id())
             ->where('attributename',$datakey)
             ->exists())
        {
          DB::table('rego_responses_nofk')
            ->where('userid',Auth::id())
            ->where('attributename',$datakey)
            ->update([
            'responsejson' => json_encode($data[$datakey]),
          ]);
        }
        else
        {
          DB::table('rego_responses_nofk')->insert([
            'userid' => Auth::id(),
            'attributename' => $datakey,
            'responsejson' => json_encode($data[$datakey]),
          ]);
        }
      }
    }
    DB::table('rego_mustask')
      ->where('userid',Auth::id())
      ->where('sectionid',$sectionid)
      ->update(['submitted' => True]);
    DB::commit();

/*
    foreach($datakeys as $datakey)
    {
      if(isset($data[$datakey]) && $data[$datakey] === 'othertext')
      {
        $falsekey = $datakey . ":othertext";
        $data[$datakey] = $data[$falsekey];
      }
    }
    DB::beginTransaction();
    foreach($datakeys as $datakey)
    {
      if(DB::table('rego_questions')->where('questionshortname',$datakey)->exists())
      {
        DB::table('rego_responses')->insert([
          'userid' => Auth::id(),
          'questionshortname' => $datakey,
          'responsejson' => json_encode($data[$datakey]),
        ]);
      }
    }
    DB::table('rego_mustask')
      ->where('userid',Auth::id())
      ->where('sectionid',$sectionid)
      ->update(['submitted' => True]);
    DB::commit();
*/
    return redirect('home');
  }
}
