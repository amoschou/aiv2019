<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

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




  public function getuploadedfile($questionshortname, $key, $filename)
  {
    $file = DB::table('v_rego_fileuploads')
      ->select('userid','foritem','questionshortname','key','filename','mimetype','b64contents')
      ->where('userid',Auth::id())
      ->where('questionshortname',$questionshortname)
      ->where('key',$key)
      ->get()[0];
    // With pgsql, these are already decoded.  
    switch(config('database.default'))
    {
      case('pgsql'):
        $filename2 = $file->filename;
        $mimetype = $file->mimetype;
        $contents = base64_decode($file->b64contents);
        break;
      case('mysql'):
        $filename2 = json_decode($file->filename);
        $mimetype = json_decode($file->mimetype);
        $contents = base64_decode(json_decode($file->b64contents));
        break;
    }
    
    if($filename !== $filename2)
    {
      abort(404);
    }
    
    $response = new Response($contents, 200);
    $response->header('Content-Type', $mimetype);
    return $response;
  }



  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // Firstly, have the essential details been asked and answered yet?
    switch(config('database.default'))
    {
      case('pgsql'):
        $query = "WITH Q AS (SELECT * FROM rego_questions WHERE sectionid = ?),
                       R AS (SELECT * FROM rego_responses WHERE userid = ? and foritem = '')
                     SELECT COUNT(*)
                       FROM Q
            LEFT OUTER JOIN R
                      USING (questionshortname)
                      WHERE userid IS NULL";
        break;
      case('mysql'):
        $query = "SELECT COUNT(*) count
                    FROM (SELECT * FROM rego_questions WHERE sectionid = ?) Q
         LEFT OUTER JOIN (SELECT * FROM rego_responses WHERE userid = ? and foritem = '') R
                   USING (questionshortname)
                   WHERE userid IS NULL";
        break;
    }
    $essentialdetailsid = DB::table('rego_sections')
                            ->where('sectionname','Essential details')
                            ->value('sectionid');
    $params = [$essentialdetailsid,Auth::id()];
    $select = DB::select($query,$params);
    $count = $select[0]->count;
    
    // If the count is not zero, then there are unanswered essential questions.
    if($count > 0)
    {
      // The essential questions do not have corresponding answers
      $context = [
        'singlesectionid' => $essentialdetailsid,
        'foritem' => '',
      ];
      return view('registration.form',$context);
    }
    
    switch(config('database.default'))
    {
      case('pgsql'):
        $firstname = DB::select("select responsejson from rego_responses join iv_users on (id = userid) where questionshortname = 'firstname' and userid = ?",[Auth::id()]);
        break;
      case('mysql'):
        $firstname = DB::select("select responsejson from rego_responses join iv_users on (id = userid) where questionshortname = 'firstname' and userid = ?",[Auth::id()]);
        break;
    }
    $context = [
      'sectionid' => NULL,
      'firstname' => json_decode($firstname[0]->responsejson),
      'accordionshow' => 'responses',
      'iscommittee' => $request->user()->iscommittee,
    ];
    return view('registration.dashboard',$context);
  }
  
  
  
  
  
  public function bulkdata(Request $request, $sectionid)
  {
    $sectionshortname = DB::table('rego_sections')->where('sectionid',(int) $sectionid)->value('sectionshortname');
    $context = [
      'sectionshortname' => $sectionshortname,
      'accordionshow' => 'bulkdata',
      'iscommittee' => $request->user()->iscommittee,
    ];
    return view('registration.bulkdata',$context);
  }
  
  
  
  
  
  public function displayregistration(Request $request, $sectionid)
  {
    $q = "SELECT DISTINCT sectionid,
                 doasksection as sectionshortname,
                 sectionname,
                 sectionord,
                 sectiondescr,
                 sectionduplicateforeach
            FROM rego_responses
                 NATURAL JOIN
                 rego_requirements
                 JOIN rego_sections
                 ON (doasksection = sectionshortname)
                 LEFT OUTER JOIN rego_subsections USING (sectionid)
           WHERE userid = ?
                 AND
                 sectionid = ?
                 AND ";
                 switch(config('database.default'))
                 {
                   case('pgsql'):
                     $q .= "CASE
                            WHEN comparisonoperator = 'LIKE'
                            THEN responsejson::TEXT LIKE responsepattern
                            WHEN comparisonoperator = '@>'
                            THEN responsejson::JSONB @> ('\"'||responsepattern||'\"')::JSONB
                            END";
                     break;
                   case('mysql'):
                     // Wow, MySQL, just wow.
                     $suba = "(comparisonoperator = 'LIKE')";
                     $subb = "(CAST(responsejson AS CHAR) LIKE responsepattern)";
                     $subc = "(comparisonoperator = '@>')";
                     $subd = "(JSON_SEARCH(responsejson,'one',responsepattern) IS NOT NULL)";
                     $subp = "((NOT $suba) OR $subb)";
                     $subq = "($suba OR (NOT $subc) OR $subd)";
                     $subr = "($suba OR $subc)";
                     $subxnorpqr = "(($subp AND $subq AND $subr) OR ((NOT $subp) AND (NOT $subq) AND (NOT $subr)))";
                     $q .= $subxnorpqr;
                     break;
                 }
          $q .= " ORDER BY sectionord";
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
    $firstname = DB::select($firstnamequery,[Auth::id()]);
    $lastname = DB::select($lastnamequery,[Auth::id()]);
    $sections = DB::select($q,[Auth::id(),(int) $sectionid]);
    $context = [
      'firstname' => json_decode($firstname[0]->responsejson),
      'lastname' => json_decode($lastname[0]->responsejson),
      'sectionid' => $sectionid,
      'accordionshow' => 'responses',
      'sections' => $sections,
      'iscommittee' => $request->user()->iscommittee,
    ];
    return view('registration.responses',$context);
  }
  
  
  
  
  
  public function registrationform (Request $request,$singlesectionid)
  {
    $context = [
      'singlesectionid' => $singlesectionid,
      'foritem' => '',
      'iscommittee' => $request->user()->iscommittee,
    ];
    return view('registration.form',$context);
  }
  
  
  
  
  
  

  public function registrationformwithforitem (Request $request,$singlesectionid,$foritem)
  {
    $foritem = $foritem;
    $context = [
      'singlesectionid' => $singlesectionid,
      'foritem' => $foritem,
      'iscommittee' => $request->user()->iscommittee,
    ];
    return view('registration.form',$context);
  }
  
  
  
  
  
  

  
  public function registrationformpost (Request $request,$sectionid)
  {
    $sectionid = (int) $sectionid;
    $validationarray = [];
    $questions = DB::table('rego_questions')
                          ->where('sectionid',$sectionid)
                          ->select('questionshortname','responseformat','responsevalidationlogic','companionresponsevalidationlogic')
                          ->get();
    $multiothertextquestionshortnames = [];
    $subquestionradioquestionshortnames = [];
    foreach($questions as $question)
    {
      if(!is_null($question->responsevalidationlogic))
      {
        $exploded = explode(':',$question->responseformat,2);
        switch($exploded[0])
        {
          case('files'):
            $exploded = explode(':',$question->responseformat,3);
//            var_dump($exploded);
//            $validationarray[$question->questionshortname . '.file.*'] = ;
            $checkboxes = $request->all()['concessionproof']['checkbox'] ?? [];
            $files = $request->all()['concessionproof']['file'] ?? [];
//           var_dump($checkboxes);
//           var_dump($files);
//die();
            foreach($checkboxes as $key => $val)
            {
              if($val === 'hiddeninput')
              {
                $validationarray[$question->questionshortname . '.checkbox.' . $key] = 'string|nullable';
              }
              else
              {
                if($val === 'save')
                {
                  $validationarray[$question->questionshortname . '.checkbox.' . $key] = 'string|nullable';
                }
                else
                {
                  $validationarray[$question->questionshortname . '.checkbox.' . $key] = 'string|nullable';
                  $validationarray[$question->questionshortname . '.file.' . $key] = $question->responsevalidationlogic . '|required_with:' . $question->questionshortname . '.checkbox.' . $key;
                }
              }
            }
            break;
          case('text-var-custom'):
            $exploded = explode(':',$question->responseformat,3);
            $validationarray[$question->questionshortname . '.customtext.*'] = $question->responsevalidationlogic;
            break;
          case('text-var'):
            $exploded = explode(':',$question->responseformat,3);
            $validationarray[$question->questionshortname . '.*'] = $question->responsevalidationlogic;
            break;
          case('subquestion-radio'):
            $subquestionradioquestionshortnames[] = $question->questionshortname;
            $exploded = explode(':',$question->responseformat,3);
            $subquestions = explode('|',$exploded[1]);
            $radios = explode('|',$exploded[2]);
            $defaultradio = NULL;
            foreach($radios as $radio)
            {
              if(substr($radio,0,1) === '!')
              {
                $defaultradio = $radio;
              }
            }
            $defaultradio = explode('^',substr($defaultradio,1));
            $defaultradio = $defaultradio[1] ?? $defaultradio[0];
            foreach($subquestions as $subquestion)
            {
              $subquestionlc = strtolower($subquestion);
              if($subquestionlc !== 'othertext')
              {
                $validationarray[$question->questionshortname . "." . $subquestionlc] = $question->responsevalidationlogic;
              }
            }
            $qdata0keys = array_keys($request->input($question->questionshortname . ":othertext") ?? []);
            foreach($qdata0keys as $key)
            {
              $validationarray[$question->questionshortname . "." . $subquestionlc . "." . $key] = $question->responsevalidationlogic;
              if(is_null($defaultradio))
              {
                $validationarray[$question->questionshortname . ":" . $subquestionlc . "." . $key] = $question->responsevalidationlogic;
              }
              else
              {
                $validationarray[$question->questionshortname . ":" . $subquestionlc . "." . $key] = 'string|nullable|required_unless:' . $question->questionshortname . "." . $subquestionlc . "." . $key . "," . $defaultradio;
              }
            }
            break;
          default:
            $validationarray[$question->questionshortname] = $question->responsevalidationlogic;
            break;
        }
      }
      if(!is_null($question->companionresponsevalidationlogic))
      {
        $exploded = explode(':',$question->companionresponsevalidationlogic,2);
        switch($exploded[0])
        {
          case('multiothertext'):
            $multiothertextquestionshortnames[] = $question->questionshortname;
            $qdata1 = $request->input($question->questionshortname);
//            $qdata2 = $request->input($question->questionshortname . ":OtherText");
            foreach(($qdata1['OtherText'] ?? []) as $othertext)
            {
              $validationarray[$question->questionshortname . ".OtherText." . $othertext] = 'string|nullable';
              $validationarray[$question->questionshortname . ":OtherText." . $othertext] = 'string|nullable|required_with:'.$question->questionshortname . ".OtherText." . $othertext;
            }
            break;
          case('othertext'):
            $validationarray[$question->questionshortname . ":" . $exploded[0]] = $exploded[1];
            break;
          default:
            echo "Something is wrong.";
            die();
        }
      }
    }
    
//    var_dump($validationarray);
//die();
    
    $validatedData = $request->validate($validationarray);
    // Only continues if valid
    $data = $validatedData;
    
//var_dump($_POST);
//    echo "VALIDATION PASSED";
//   var_dump($data); die();
    
    foreach($subquestionradioquestionshortnames as $questionshortname)
    {
      $qdata0keys = array_keys($request->input($questionshortname . ":othertext") ?? []);
      foreach($qdata0keys as $key)
      {
        $data[$questionshortname][$data[$questionshortname . ":othertext"][$key]] = $data[$questionshortname]['othertext'][$key];
      }
      unset($data[$questionshortname]['othertext']);
      unset($data[$questionshortname . ":othertext"]);
      if(!is_null($defaultradio))
      {
        $ingredientkeys = array_keys($data[$questionshortname]);
        foreach($ingredientkeys as $key)
        {
          if($data[$questionshortname][$key] === $defaultradio)
          {
            unset($data[$questionshortname][$key]);
          }
        }
      }
    }
    foreach($multiothertextquestionshortnames as $questionshortname)
    {
      foreach(($data[$questionshortname]['OtherText'] ?? []) as $othertext)
      {
        $data[$questionshortname][] = $data[$questionshortname . ":OtherText"][$othertext];
      } 
      unset($data[$questionshortname . ":OtherText"]);
      unset($data[$questionshortname]['OtherText']);
    }

    $foritem = $request->input('foritem') ?? '';

    $datakeys = array_keys($data);
    
//    var_dump($data);
//    var_dump($data['concessionproof']['file']);
//    var_dump($datakeys);
//    die();

    DB::beginTransaction();
    foreach($datakeys as $datakey)
    {
      if(
        isset($data[$datakey]['checkbox']) 
        &&
        isset($data[$datakey]['file']) 
      )
      {
        $out = new \stdClass();
        $out->uploadedfiles = [];
//        var_dump($data[$datakey]['checkbox']);
 //       var_dump($data[$datakey]['file']);
//        die();
        foreach($data[$datakey]['checkbox'] ?? [] as $key => $val)
        {
          if($val !== 'hiddeninput')
          {
            if($val === 'save')
            {
              $savedfile = DB::table('v_rego_fileuploads')
                ->select('filename','mimetype','b64contents')
                ->where('userid',Auth::id())
                ->where('foritem','')
                ->where('questionshortname',$datakey)
                ->where('key',$key)
                ->get()[0];
              $out->uploadedfiles[] = [
                $key,
                $savedfile->filename,
                $savedfile->mimetype,
                $savedfile->b64contents
              ];
            }
            else
            {
//              var_dump($data);
  //            die();
              $contents = file_get_contents($data[$datakey]['file'][$key]->path());
              $contents = base64_encode($contents);
              $out->uploadedfiles[] = [
                $key,
                $data[$datakey]['file'][$key]->getClientOriginalName(),
                $data[$datakey]['file'][$key]->getMimeType(),
                $contents
              ];
            }
          }
        }
        $responsejson = json_encode($out);
      }
      else
      {
        $responsejson = json_encode($data[$datakey]);
      }
      if(DB::table('rego_questions')->where('questionshortname',$datakey)->exists())
      {
        if(DB::table('rego_responses')
             ->where('userid',Auth::id())
             ->where('foritem',$foritem)
             ->where('questionshortname',$datakey)
             ->exists())
        {
          DB::table('rego_responses')
            ->where('userid',Auth::id())
            ->where('foritem',$foritem)
            ->where('questionshortname',$datakey)
            ->update([
            'responsejson' => $responsejson,
          ]);
        }
        else
        {
          DB::table('rego_responses')->insert([
            'userid' => Auth::id(),
            'foritem' => $foritem,
            'questionshortname' => $datakey,
            'responsejson' => $responsejson,
          ]);
        }
      }
      else
      {
        if(DB::table('rego_responses_nofk')
             ->where('userid',Auth::id())
             ->where('foritem',$foritem)
             ->where('attributename',$datakey)
             ->exists())
        {
          DB::table('rego_responses_nofk')
            ->where('userid',Auth::id())
             ->where('foritem',$foritem)
            ->where('attributename',$datakey)
            ->update([
            'responsejson' => $responsejson,
          ]);
        }
        else
        {
          DB::table('rego_responses_nofk')->insert([
            'userid' => Auth::id(),
            'foritem' => $foritem,
            'attributename' => $datakey,
            'responsejson' => $responsejson,
          ]);
        }
      }
    }
    DB::commit();

    return redirect('home/registration/'.$sectionid);
  }
  
  
  
  
}
