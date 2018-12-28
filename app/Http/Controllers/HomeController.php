<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use Validator;
use Illuminate\Support\Str;

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
      return view('registration.form.base',$context);
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
  
  
  
  
  
  public function personalinformationsection(Request $request, $sectionid)
  {
    $sectionshortname = DB::table('rego_sections')->where('sectionid',(int) $sectionid)->value('sectionshortname');
    $context = [
      'sectionshortname' => $sectionshortname,
      'accordionshow' => 'bulkdata',
      'iscommittee' => $request->user()->iscommittee,
      'sectionid' => $sectionid
    ];
    return view('registration.personalinformation.section',$context);
  }
  
  
  
  
  public function meetandgreet(Request $request)
  {
    $context = [];
    return view('registration.meetandgreet', $context);
  }
  
  
  
  
  
  
  public function displayregistration(Request $request, $sectionid)
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
            and
            sectionid = ?
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
      'personalinformation' => false,
      'userid' => Auth::id(),
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
    return view('registration.form.base',$context);
  }
  
  
  
  
  
  

  public function registrationformwithforitem (Request $request,$singlesectionid,$foritem)
  {
    $foritem = $foritem;
    $context = [
      'singlesectionid' => $singlesectionid,
      'foritem' => $foritem,
      'iscommittee' => $request->user()->iscommittee,
    ];
    return view('registration.form.base',$context);
  }
  
  
  
  
  
  

  
  public function registrationformpost (Request $request,$sectionid)
  {
//var_dump($_POST);
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
          case('radio'):
            $radiochoices = explode('|',$exploded[1]);
            if(in_array('OtherText',$radiochoices,TRUE))
            {
              $validationarray[$question->questionshortname] = 'string|nullable';
              $validationarray[$question->questionshortname . ':othertext'] = 'string|nullable|required_if:' . $question->questionshortname . ',OtherText';
            }
            else
            {
              $validationarray[$question->questionshortname] = $question->responsevalidationlogic;
            }
            break;
          case('files'):
            $exploded = explode(':',$question->responseformat,3);
            var_dump($exploded);
//            $validationarray[$question->questionshortname . '.file.*'] = ;
            $checkboxes = $request->all()['concessionproof']['checkbox'] ?? [];
            $files = $request->all()['concessionproof']['file'] ?? [];
           var_dump($checkboxes);
           var_dump($files);
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
//var_dump($validationarray);
//die();
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
            echo "Something is wrong aaa.";
            die();
        }
      }
    }
    
    // It doesn't look like that acdinner and acdinnerguest can be
    // validated using the abstract approach so one of the rules is
    // done manually here.
    //
    //   IF THERE'S AN ACADEMIC DINNER GUEST,
    //   THEN YOU MUST BE GOING TO THE DINNER YOURSELF.
    
    $v = Validator::make(
      $request->all(),
      $validationarray,
      ['acdinner.in' => 'This must be ‘yes’ if you are bringing a guest to the academic dinner. Either select ‘yes’ here or deselect any guests below.']
    );
    $v->sometimes('acdinner','in:yes', function ($input) {
      return (
        isset($input->acdinnerguest[0])
        &&
        $input->acdinnerguest[0] === 'hiddeninput'
        &&
        count($input->acdinnerguest) > 1
      );
      // Remember that the "hiddeninput" guest should always exist
      // This is posted into acdinnerguest[0] and it's handled.
    });
    
    // Normally, without custom "sometimes" rules like above,
    // we could do:
    //
    //   $data = $request->validate($validationarray)
    // 
    // and get returned the validated data. Unfortunately, this isn't
    // automatic when using the Validator trait with custom rules, so
    // we borrow extractInputFromRules() from ValidatesRequest.php:
    //
    //  /**
    //   * Get the request input based on the given validation rules.
    //   *
    //   * @param  \Illuminate\Http\Request  $request
    //   * @param  array  $rules
    //   * @return array
    //   */
    //  protected function extractInputFromRules(Request $request, array $rules)
    //  {
    //    return $request->only(collect($rules)->keys()->map(function ($rule) {
    //      return Str::contains($rule, '.') ? explode('.', $rule)[0] : $rule;
    //    })->unique()->toArray());
    //  }
    
    $v->validate();
    
//    echo "If you can see this message, then validation succeeded."; die();
    
    $rules = $v->getRules();
    $data = $request->only(collect($rules)->keys()->map(function ($rule) {
                return Str::contains($rule, '.') ? explode('.', $rule)[0] : $rule;
            })->unique()->toArray());
    
//    var_dump($data); die();
    
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

    $removekeys = [];
    foreach($data as $key => $val)
    {
      if($val === 'othertext' && isset($data[$key.':othertext']))
      {
        $data[$key] = $data[$key.':othertext'];
        $removekeys[] = $key.':othertext';
      }
    }
    foreach($removekeys as $removekey)
    {
      unset($data[$removekey]);
    }

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
      if(DB::table('rego_questions')
           ->where('questionshortname',$datakey)
           ->exists())
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
        // This shouldn't ever happen (Hopefully).
        // But things will still work if it does.
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
    // Delete old personal information no longer required.
    $questionshortnamein = "
                 select questionshortname
                 from rego_questions
                 natural join
                 v_rego_required_sections
                 where userid = ? and required = 'false' ";
    DB::delete("delete from
             rego_responses
             where
               questionshortname in ( {$questionshortnamein} )
               and 
               userid = ?",[Auth::id(),Auth::id()]);
               // Remember there two parametes to bind!
    
    $duplicatedsections = DB::table('rego_sections')
      ->select('sectionid','sectionduplicateforeach')
      ->whereNotNull('sectionduplicateforeach')
      ->get();
    foreach($duplicatedsections as $section)
    {
      $json = DB::table('rego_responses')
                ->where('questionshortname',$section->sectionduplicateforeach)
                ->where('userid',Auth::id())
                ->where('foritem','')
                ->value('responsejson');
      $guests = json_decode($json);
      $guests[] = ''; // Don't forget yourself.
      // Now $guests is an array of people being taken to the dinner.
      // including yourself (who is the empty string).
      // We need to delete the dietary requirements of any guests not in that list.
      DB::table('rego_responses')
        ->where('userid',Auth::id())
        ->whereNotIn('foritem',$guests)
        ->whereRaw('questionshortname in (
                    select questionshortname
                    from rego_questions
                    where sectionid = ?)',$section->sectionid)
        ->delete();
    }
    // This whole process could be more robust, but it works now.
    // That is, in some situations, it might delete more than it should,
    // but that's not going to happen with Adelaide IV's setup.
    DB::commit();

    return redirect('home/registration/'.$sectionid);
  }
  
  
  
  
  
    public function invoice (Request $request)
    {
      $firstname = json_decode(DB::table('rego_responses')->where('questionshortname','firstname')->where('userid',Auth::id())->value('responsejson'));
      $lastname = json_decode(DB::table('rego_responses')->where('questionshortname','lastname')->where('userid',Auth::id())->value('responsejson'));
      $address = json_decode(DB::table('rego_responses')->where('questionshortname','post')->where('userid',Auth::id())->value('responsejson'));
      $context = [
        'sectionid' => NULL,
        'iscommittee' => $request->user()->iscommittee,
        'name' => "$firstname $lastname",
        'address' => $address,
        'email' => $request->user()->email,
        'accountref' => $request->user()->accountref
      ];
      
      $transactions = DB::select('SELECT * FROM bank_transactions WHERE id NOT IN (SELECT transactionid FROM bank_transaction_accounts)');
      foreach($transactions as $transaction)
      {
        $accountrefmatches = [];
        preg_match('/AR\d\d\d\d[A-Z]/', strtoupper($transaction->description), $accountrefmatches);
        DB::table('bank_transaction_accounts')->insert([
          'transactionid' => $transaction->id,
          'accountref' => $accountrefmatches[0] ?? NULL,
        ]);
      }

      return view('registration.business.invoice',$context);
    }

    public function accounts (Request $request)
    {
      $context = [
        'sectionid' => NULL,
        'iscommittee' => $request->user()->iscommittee,
        'people' => DB::table('v_cols_essential')->select('id','firstname','lastname')->orderby('lastname','firstname','id')->get(),
        'getemail' => $request->query('email'),
        'getpeoplelist' => $request->query('peoplelist'),
      ];
      
      // Repeat this from invoice() method above
      $transactions = DB::select('SELECT * FROM bank_transactions WHERE id NOT IN (SELECT transactionid FROM bank_transaction_accounts)');
      foreach($transactions as $transaction)
      {
        $accountrefmatches = [];
        preg_match('/AR\d\d\d\d[A-Z]/', strtoupper($transaction->description), $accountrefmatches);
        DB::table('bank_transaction_accounts')->insert([
          'transactionid' => $transaction->id,
          'accountref' => $accountrefmatches[0] ?? NULL,
        ]);
      }

      return view('registration.business.accounts',$context);
    }


  
  
}
