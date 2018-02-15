@extends('registration.dashboard')


@php
  $q = "SELECT DISTINCT sectionid,
               doasksection as sectionshortname,
               sectionname,
               sectionord,
               sectiondescr
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
                   $suba = "(comparisonoperator = 'LIKE)";
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
  $sections = DB::select($q,[Auth::id(),(int) $sectionid]);
  
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
                 b AS (SELECT responseid,userid,questionshortname,responsejson FROM rego_responses WHERE userid = ?)
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
                      (SELECT responseid,userid,questionshortname,responsejson FROM rego_responses WHERE userid = ?) AS b
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
        return '<table class="table">';
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
      <p>{{ $section->sectiondescr }}</p>
    @endif
    <a href="/home/registration/{{ $section->sectionid }}/edit" role="button" class="btn btn-sm btn-secondary mb-2 rounded-0">Edit responses</a>
      {!! aiv_style_begin_questionresponsegroup($a) !!}
    @foreach($subsections as $subsection)
      @if($hassubsections)
        {!! aiv_style_begin_subsectionheading($a) !!}{{ $subsection->subsectionname }}{!! aiv_style_end_subsectionheading($a) !!}
      @endif
      @php
        $params = $hassubsections ? [$section->sectionid,$subsection->subsectioncode,Auth::id()] : [$section->sectionid,Auth::id()];
      @endphp
        @foreach(DB::select($q,$params) as $row)
          {!! aiv_style_begin_question($a) !!}{{ $row->questiontext }}{!! aiv_style_end_question($a) !!}
          {!! aiv_style_begin_response($a) !!}
            @php
              $object = json_decode($row->responsejson);

              $done = False;
              $output = NULL;
              $specialmessage = NULL;

              // IS IT A STRING?
              if(is_string($object))
              {
                if($object === 'othertext')
                {
                  $output = ucfirst(json_decode(DB::table('rego_responses_nofk')
                                             ->where('userid',Auth::id())
                                             ->where('attributename',$row
                                             ->questionshortname.':othertext')
                                             ->value('responsejson')));
                }
                else
                {
                  $output = ucfirst($object);
                }
                $done = True;
              }

              // IS IT AN ARRAY?
              if(is_array($object))
              {
                // IS IT AN ARRAY OF STRINGS?
                $arrayofstrings = True;
                foreach($object as $element)
                {
                  if(!is_string($element))
                  {
                    $arrayofstrings = False;
                  }
                }
                if($arrayofstrings)
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
                    $output = ucfirst(implode(', ',$object));
                  }
                  $done = True;
                }
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
                $simplekeyvalarrayofstrings = True;
                foreach($candidate as $key => $val)
                {
                  if(!(is_string($key) && is_string($val)))
                  {
                    $simplekeyvalarrayofstrings = False;
                  }
                }
                
                if($simplekeyvalarrayofstrings)
                {
                  $output = [];
                  foreach($candidate as $key => $value)
                  {
                    $output[] = ucfirst($key) . " (" . $value . ")";
                  }
                  $output = implode(', ',$output);
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
  @endforeach
@endsection