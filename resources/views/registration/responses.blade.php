@extends('registration.dashboard')


@php
                  function is_array_of_scalars($iv_array)
                  {
                    $iv_returnval = True;
                    foreach($iv_array as $iv_array_thing)
                    {
                      if(!is_null($iv_array_thing))
                      {
                        if(!is_scalar($iv_array_thing))
                        {
                          $iv_returnval = False;
                        }
                      }
                    }
                    return $iv_returnval;
                  }
  $hassubsections = 0 !== DB::table('rego_subsections')->where('sectionid',(int) $sectionid)->count();
  if($hassubsections)
  {
    $subsections = DB::table('rego_subsections')->select('sectionid','subsectioncode','subsectionname','subsectiondescr')->where('sectionid',(int) $sectionid)->get();
  }
  else
  {
    switch(config('database.default'))
    {
      case('pgsql'):
        $rawquery = 'NULL::INT as sectionid,NULL::INT as subsectioncode,NULL::TEXT as subsectionname,NULL::TEXT as subsectiondescr';
        break;
      case('mysql'):
        $rawquery = 'NULL as sectionid,NULL as subsectioncode,NULL as subsectionname,NULL as subsectiondescr';
        break;
    }
    $subsections = DB::table('rego_subsections')->selectRaw($rawquery)->take(1)->get();
  }
  
//  var_dump($subsections); die();


  $subsectioninsert = $hassubsections ? ' and subsectioncode = ?' : '';
  
  switch(config('database.default'))
  {
    case('pgsql'):
      $q = "WITH a AS (SELECT questiontext,questionshortname,questionord FROM rego_questions WHERE sectionid = ? $subsectioninsert),
                 b AS (SELECT responseid,userid,questionshortname,responsejson FROM rego_responses WHERE userid = ? AND foritem = ?)
               SELECT *
                 FROM a
                      LEFT OUTER JOIN
                      b USING (questionshortname)
             ORDER BY questionord ASC";
      break;
    case('mysql'):
      $q = "   SELECT *
                 FROM (SELECT questiontext,questionshortname,questionord FROM rego_questions WHERE sectionid = ? $subsectioninsert) AS a
                      LEFT OUTER JOIN
                      (SELECT responseid,userid,questionshortname,responsejson FROM rego_responses WHERE userid = ? AND foritem = ?) AS b
                      USING (questionshortname)
             ORDER BY questionord ASC";
      break;
  }
@endphp

@php
  function aiv_style_begin_questionresponsegroup($a)
  {
    switch($a)
    {
      case('dl'):
        return '<dl>';
        break;
      case('table'):
        return '<table class="table table-sm">';
        break;
    }
  }
  function aiv_style_end_questionresponsegroup($a)
  {
    switch($a)
    {
      case('dl'):
        return '</dl>';
        break;
      case('table'):
        return '</table>';
        break;
    }
  }
  function aiv_style_begin_question($a)
  {
    switch($a)
    {
      case('dl'):
        return '<dt>';
        break;
      case('table'):
        return '<tr><td class="pl-0">';
        break;
    }
  }
  function aiv_style_end_question($a)
  {
    switch($a)
    {
      case('dl'):
        return '</dt>';
        break;
      case('table'):
        return '</td>';
        break;
    }
  }
  function aiv_style_begin_response($a)
  {
    switch($a)
    {
      case('dl'):
        return '<dd>';
        break;
      case('table'):
        return '<td class="pr-0">';
        break;
    }
  }
  function aiv_style_end_response($a)
  {
    switch($a)
    {
      case('dl'):
        return '</dd>';
        break;
      case('table'):
        return '</td></tr>';
        break;
    }
  }
  function aiv_style_begin_subsectionheading($a)
  {
    switch($a)
    {
      case('dl'):
        return '<h3>';
        break;
      case('table'):
        return '<tr><th colspan="2" class="px-0">';
        break;
    }
  }
  function aiv_style_end_subsectionheading($a)
  {
    switch($a)
    {
      case('dl'):
        return '</h3>';
        break;
      case('table'):
        return '</th></tr>';
        break;
    }
  }
  
  $a = 'table';
@endphp
    
@section('innercontent')
  @foreach($sections as $section)
    <h2>{{ $section->sectionname }}</h2>
    @if(!is_null($section->sectiondescr))
      <p>{!! $section->sectiondescr !!}</p>
    @endif
    @if(!is_null($section->sectionduplicateforeach))
      @php
        $foritems = json_decode(DB::table('rego_responses')->where('questionshortname',$section->sectionduplicateforeach)->where('userid',Auth::id())->value('responsejson'));
        $hastabs = True;
      @endphp
    @else
      @php
        $foritems = NULL;
        $hastabs = False;
      @endphp
    @endif
    
    @php
      $foritems = $foritems ?? [''];
    @endphp
    
    @if($hastabs)
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach($foritems as $foritem)
          @php
            if($foritem === '' || $foritem === 'hiddeninput')
            {
              $tagname = '';
              $tabname = 'For yourself';
            }
            else
            {
              $tagname = $foritem;
              $tabname = "For your guest " . $foritem;
            }
          @endphp
          <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="responsesfor-{{ $tagname }}-tab" data-toggle="tab" href="#responsesfor-{{ $tagname }}" role="tab" aria-controls="responsesfor-{{ $tagname }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $tabname }}</a>
          </li>
        @endforeach
      </ul>
      <div class="tab-content" id="myTabContent">
    @endif
    
    
    @foreach($foritems as $foritem)
      @php
        if(!$hastabs)
        {
          $tagname = $foritem;
          $tabname = 'Edit responses';
        }
        else
        {
          if($foritem === '' || $foritem === 'hiddeninput')
          {
            $tagname = '';
            $tabname = 'Edit responses for yourself';
          }
          else
          {
            $tagname = $foritem;
            $tabname = "Edit responses for your guest " . $foritem;
          }
        }
      @endphp
      @if($hastabs)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="responsesfor-{{ $tagname }}" role="tabpanel" aria-labelledby="responsesfor-{{ $tagname }}-tab">
      @endif
      @if($tagname === '')
        <a href="/home/registration/{{ $section->sectionid }}/edit" class="btn btn-sm btn-secondary mb-2 rounded-0">{{ $tabname }}</a>
      @else
        <a href="/home/registration/{{ $section->sectionid }}/{{ $tagname }}/edit" class="btn btn-sm btn-secondary mb-2 rounded-0">{{ $tabname }}</a>
      @endif
      {!! aiv_style_begin_questionresponsegroup($a) !!}
        @foreach($subsections as $subsection)
          @if($hassubsections)
            {!! aiv_style_begin_subsectionheading($a) !!}{{ $subsection->subsectionname }}{!! aiv_style_end_subsectionheading($a) !!}
          @endif
          @php
            $params = $hassubsections ? [$section->sectionid,$subsection->subsectioncode,Auth::id(),$tagname] : [$section->sectionid,Auth::id(),$tagname];
          @endphp
            @foreach(DB::select($q,$params) as $row)
              {!! aiv_style_begin_question($a) !!}{!! $row->questiontext !!}{!! aiv_style_end_question($a) !!}
              {!! aiv_style_begin_response($a) !!}
                @php
                  $object = json_decode($row->responsejson);
                  if(isset($object->uploadedfiles))
                  {
                    $isuploadedfiles = True;
                  }
                  else
                  {
                    $isuploadedfiles = False;
                    $object = json_decode($row->responsejson, True);
                  }
                  
                  
                  $done = False;
                  $output = NULL;
                  $specialmessage = NULL;

                  // IS IT A STRING?
                  if(is_string($object))
                  {
                    switch($object)
                    {
                      case('othertext'):
                        $output = ucfirst(json_decode(DB::table('rego_responses_nofk')
                                                   ->where('userid',Auth::id())
                                                   ->where('attributename',$row
                                                   ->questionshortname.':othertext')
                                                   ->value('responsejson')));
                        break;
                      case('');
                        $specialmessage = '<small class="text-muted">(Nothing)</small>';
                        break;
                      default:
                        $output = ucfirst($object);
                        break;
                    }
                    $done = True;
                  }

                  // IS IT AN ARRAY?
                  if(is_array($object))
                  {
                    // GET RID OF NULLS
                    $object = array_filter($object,function($a){return !is_null($a);});
                    if(is_array_of_scalars($object))
                    {
                      if(in_array('hiddeninput',$object))
                      {
                        unset($object[array_search('hiddeninput',$object)]);
                      }
                      if(count($object) === 0)
                      {
                        $specialmessage = '<small class="text-muted">(None)</small>';
                      }
                      else
                      {
                        $objectkeys = array_keys($object);

                        // If any key is a string, then it is important
                        // Otherwise they are not reported.
                        $stringkeys = False;
                        foreach($objectkeys as $key)
                        {
                          if(is_string($key))
                          {
                            $stringkeys = True;
                          }
                        }
                        if($stringkeys)
                        {
                          $outputarray = [];
                          foreach($objectkeys as $key)
                          {
                            $outputarray[] = "$key: " . $object[$key];
                          }
                          $output = implode(";\n",array_map('ucfirst',$outputarray));
                        }
                        else
                        {
                          $output = implode(";\n",array_map('ucfirst',$object));
                        }
                      }
                      $done = True;
                    }
                    else
                    {
                      // Is it an array of checkbox and customtext?
                      $checkboxarray = $object['checkbox'] ?? [];
                      $customtextarray = $object['customtext'] ?? [];
                      if(is_array_of_scalars($checkboxarray) && is_array_of_scalars($customtextarray))
                      {
                        $outputarray = [];
                        foreach($checkboxarray as $key => $val)
                        {
                          if(is_null($customtextarray[$key]))
                          {
                            $outputarray[] = "{$val} without customisation";
                          }
                          else
                          {
                            $outputarray[] = "{$val} with customisation: {$customtextarray[$key]}";
                          }
                        }
                        $output = implode(";\n",array_map('ucfirst',$outputarray));
                        $done = True;
                      }
                    }
                  }
                  
                  if($isuploadedfiles)
                  {
                    $output = [];
                    foreach($object->uploadedfiles as $file)
                    {
                      $output[] = "<a href=\"/home/registration/{$row->questionshortname}/{$file[0]}/{$file[1]}\">{$file[1]}</a>";
                    }
                      $specialmessage = $output === [] ? '<small class="text-muted">(None)</small>' : implode("<br>",$output);
                      $done = True;
                  }
                  
                  if(is_null($object))
                  {
                    $specialmessage = '<small class="text-muted">(Not answered)</small>';
                    $done = True;
                  }
          
                  if(!$done)
                  {
          
                    $candidate = json_decode($row->responsejson,TRUE);

                    // IS IT A SIMPLE KEY VALUE ARRAY OF STRINGS?
                    $simplekeyvalarrayofscalars = True;
                    foreach($candidate as $key => $val)
                    {
                      if(!(is_string($key) && is_string($val)))
                      {
                        $simplekeyvalarrayofscalars = False;
                      }
                    }
            
                    if($simplekeyvalarrayofscalars)
                    {
                      $output = [];
                      foreach($candidate as $key => $value)
                      {
                        $output[] = ucfirst($key) . " (" . $value . ")";
                      }
                      $output = implode(";\n",$output);
                      $done = True;
                    }
                    else
                    {
                      // EVERYTHING ELSE
                      $output = $row->responsejson;
                      $done = True;
                    }
                  }
                @endphp
                {!! $specialmessage ?? nl2br(htmlspecialchars($output)) !!}
              {!! aiv_style_end_response($a) !!}
            @endforeach
          @endforeach
        {!! aiv_style_end_questionresponsegroup($a) !!}
        @if($hastabs)
          </div>
        @endif
      @endforeach
    @if($hastabs)
      </div>
    @endif
  @endforeach
@endsection