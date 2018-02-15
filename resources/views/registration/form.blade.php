@extends('layouts.app')

@section('extrastyles')
<style>
  .form-row-striped:nth-of-type(odd) {
    background-color: rgba(0,0,0,.05)
  }
</style>
@endsection

@section('extrascripts')
<script>
  function addsubquestionradio(questionshortname,html5required,radios)
  {
    var htmlstr = document.getElementById(questionshortname + ':othertext:container').innerHTML;
    var i1 = document.getElementById(questionshortname + ':container').childElementCount;
    var i2 = document.getElementById(questionshortname + ':othertext:container').childElementCount;
    var i = i1 + i2;

    htmlstr = htmlstr + '<div class="form-row form-row-striped">';
    htmlstr = htmlstr +   '<div class="col-4">';
    htmlstr = htmlstr +     '<input type="text" class="form-control rounded-0" placeholder="Other" name=' + questionshortname + ':othertext[' + i + ']">';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr +   '<div class="col-8">';
    var isdefault;
    for(var j = 0; j < radios.length; j++)
    {
      var radio = radios[j];
      if(radio.charAt(0) === '!')
      {
        isdefault = true;
        radio = radio.substring(1);
      }
      else
      {
        isdefault = false;
      }
      radio = radio.split('^');
      radio[1] = radio[1] || radio[0];
      htmlstr = htmlstr +     '<div class="form-check form-check-inline">';
      htmlstr = htmlstr +       '<input class="form-check-input" ';
      htmlstr = htmlstr +               'type="radio" ';
      htmlstr = htmlstr +                 'id="' + questionshortname + '[othertext][' + i + ']" ';
      htmlstr = htmlstr +              'value="' + radio[1] + '" ';
      htmlstr = htmlstr +               'name="' + questionshortname + '[othertext][' + i + ']" ';
      htmlstr = htmlstr +                     (html5required ? 'required ' : '');
      // This doesn't work properly?
//      htmlstr = htmlstr +                     (isdefault ? 'checked' : '');
      htmlstr = htmlstr +       '>';
      htmlstr = htmlstr +       '<label class="form-check-label" for="' + questionshortname + '[othertext][' + i + ']">' + radio[0] + '</label>';
      htmlstr = htmlstr +     '</div>';
    }
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr + '</div>';

    document.getElementById(questionshortname + ':othertext:container').innerHTML = htmlstr;
  }


  function toggleelaborations(id,elaborations)
  {
    idarray = id.split(':');
    checkid = idarray[0] + ':' + idarray[1];
    checkobject = document.getElementById(checkid);
    var newdisplay;
    var newvisibility;
    for (var j = 0; j < elaborations.length; ++j)
    {
      var elaboration = elaborations[j];
      inputid = checkid + ':' + elaboration;
      labelid = inputid + ':label';
      newvisibility = checkobject.checked ? "visible" : "hidden";
      document.getElementById(inputid).style.visibility = newvisibility;
      document.getElementById(labelid).style.visibility = newvisibility;
    }
  }
  function addothertext(questionshortname,istring,elaborations = null)
  {
    var i = document.getElementById(questionshortname + ':' + istring + ':container').childElementCount;
    var htmlstr = document.getElementById(questionshortname + ':' + istring + ':container').innerHTML;
    if(elaborations === null)
    {
      htmlstr = htmlstr + '<div class="input-group">';
      htmlstr = htmlstr +   '<div class="input-group-prepend">';
      htmlstr = htmlstr +     '<div class="input-group-text rounded-0">';
      htmlstr = htmlstr +       '<input type="checkbox" name="' + questionshortname + '[' + istring + '][' + i + ']" value="' + i + '" aria-label="Radio button for following text input" checked>';
      htmlstr = htmlstr +     '</div>';
      htmlstr = htmlstr +   '</div>';
      htmlstr = htmlstr +   '<input type="text" class="form-control rounded-0" name="' + questionshortname + ':' + istring + '[' + i + ']" aria-label="Text input with radio button" placeholder="Other">';
      htmlstr = htmlstr + '</div>';
    }
    else
    {
      htmlstr = htmlstr + '<div class="form-row">';
      htmlstr = htmlstr +   '<div class="col">';
      htmlstr = htmlstr +     '<div class="input-group">';
      htmlstr = htmlstr +       '<div class="input-group-prepend">';
      htmlstr = htmlstr +         '<div class="input-group-text rounded-0">';
      htmlstr = htmlstr +           '<input type="checkbox"  name="' + questionshortname + '[' + istring + '][' + i + ']" value="' + i + '" aria-label="Radio button for following text input" checked>';
      htmlstr = htmlstr +         '</div>';
      htmlstr = htmlstr +       '</div>';
      htmlstr = htmlstr +       '<input type="text" class="form-control" name="' + questionshortname + ':' + istring + '[' + i + ']" aria-label="Text input with radio button" placeholder="Other">';
      htmlstr = htmlstr +     '</div>';
      htmlstr = htmlstr +   '</div>';
      htmlstr = htmlstr +   '<div class="col">';
      htmlstr = htmlstr +     '<div class="form-control-plaintext pb-0">';
      for (var j = 0; j < elaborations.length; ++j)
      {
        var elaboration = elaborations[j];
        htmlstr = htmlstr +     '<div class="form-check form-check-inline">';
        htmlstr = htmlstr +       '<input class="aiv-elaboration form-check-input" type="radio" name="' + questionshortname + ':' + istring + ':' + i + '" id="' + questionshortname + ':' + istring + ':' + i + ':' + elaboration + '" value="' + elaboration + '">';
        htmlstr = htmlstr +       '<label class="aiv-elaboration form-check-label" for="' + questionshortname + ':' + istring + ':' + i + ':' + elaboration + '">' + elaboration + '</label>';
        htmlstr = htmlstr +     '</div>';
      }
      htmlstr = htmlstr +     '</div>';
      htmlstr = htmlstr +   '</div>';
      htmlstr = htmlstr + '</div>';

    }
    document.getElementById(questionshortname + ':' + istring + ':container').innerHTML = htmlstr;
  }
</script>
@endsection

@section('content')




<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-12">
    
    
      @php
        if(isset($singlesectionid))
        {
          $sections = DB::table('rego_sections')
                        ->select('sectionid','sectionname','sectiondescr')
                        ->where('sectionid',$singlesectionid)
                        ->orderBy('sectionord','asc')
                        ->get();
        }
        else
        {
          $sections = DB::table('rego_sections')
                        ->select('sectionid','sectionname','sectiondescr')
                        ->orderBy('sectionord','asc')
                        ->get();
        }
      @endphp
      @foreach ($sections as $section)
        <div class="card mb-4 border-primary rounded-0">
          <div class="card-header border-primary rounded-0 bg-primary text-white">{{ $section->sectionname }}</div>
          @if(!is_null($section->sectiondescr))
            <div class="list-group list-group-flush">
              <div class="list-group-item text-info border-0" class="info">
                <div class="form-row">
                  <div class="offset-md-3 col-md-5">
                    {{ $section->sectiondescr }}
                  </div>
                </div>
              </div>
            </div>
          @endif
          <div class="card-body">
          

            <form class="form-horizontal" method="POST" action="/home/registration/{{ $section->sectionid }}">
              {{ csrf_field() }}
              @php
                $hassubsections = 0 !== DB::table('rego_subsections')->where('sectionid',$section->sectionid)->count();
                if($hassubsections)
                {
                  $subsections = DB::table('rego_subsections')->select('sectionid','subsectioncode','subsectionname','subsectiondescr')->where('sectionid',$section->sectionid)->get();
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
              @endphp
              @foreach ($subsections as $subsection)
                @if (!is_null($subsection->subsectionname))
                  <div class="form-row">
                    <h3 class="offset-md-3 col-md-9">{{ $subsection->subsectionname }}</h3>
                    @if (!is_null($subsection->subsectiondescr))
                      <div class="offset-md-3 col-md-9">
                        <p>{!! $subsection->subsectiondescr !!}</p>
                      </div>
                    @endif
                  </div>
                @endif
                @php
                  $questions = $hassubsections
                             ? DB::table('rego_questions')->select('questionshortname','questiontext','questiondescr','responseformat','html5required')->whereRaw('sectionid = ? and subsectioncode = ?',[$section->sectionid, $subsection->subsectioncode])->orderBy('questionord','asc')->get()
                             : DB::table('rego_questions')->select('questionshortname','questiontext','questiondescr','responseformat','html5required')->where('sectionid',$section->sectionid)->orderBy('questionord','asc')->get();
                @endphp
                @foreach ($questions as $question)
                  {{--
                    // $question->aformat is the definition of the allowable answers to the question stored in the database,
                    // according to the following syntax:
                    //
                    // STEP 1: $responseformat = explode(':',$question->aformat);
                    //
                    // NOW, $responseformat[0] is "text" or "radio" or "checkbox". Other values are not implemented in this view.
                    // 
                    // If $responseformat[0] is "text",
                    //   then $responseformat[1] will be "text" or "email" or "tel" or some other HTML5 value for the type attribute of <input>,
                    //   additionally $formatarray[1] could also be "address" which is handled separately because it will use multiple <input>s.
                    //   DONE.
                    //
                    // If $responseformat[0] is "radio" or "checkbox",
                    //   then $responseformat[1] will be a pipe separated list of strings (these are the options for the radio or checkbox group),
                    //   in which case:
                    //
                    // STEP 2: $answeritems = explode('|',responseformat[1]);
                    //
                    // STEP 3: ITERATE FOR EACH $answeritems AS $answeritem.
                    //
                    // STEP 4: $answeritemarray = explode('^',$answeritem)
                    //
                    // STEP 5: $answeritemarray[1] = $answeritemarray[1] ?? strtolower($answeritemarray[0]);
                    //
                    // NOW, $answeritemarray[0] is the display string for the option and
                    //      $answeritemarray[1] is the internal string for the option.
                    //
                    // BUT IF $answeritemarray[0] is "OtherText", then need to put an input here. Only once for radios, but multiples allowed for checkboxes.
                    //
                    // If $responseformat[2] doesn’t exist, then DONE.
                    // $responseformat[2] can only exist if $responseformat[0] is "checkbox".
                    // If it does exist, then $responseformat[2] is a pipe separated list of strings
                    //   (these are the options for the elaborations for each checkbox)
                    //
                    // STEP 6: $globalansweritemelaborations = explode('|',$responseformat[2]);
                    // 
                    // NOW, $globalansweritemelaborations[0] is the display string for the elaboration and
                    //      strtolower($globalansweritemelaborations[0]) is the internal string for the elaboration.
                    // 
                    // MEANWHILE, if the answer requires several inputs (radios, checkboxes and addresses), they are grouped with <fieldset>
                    --}}
                  @php
                    $responseformat = explode(':',$question->responseformat);
                    switch($responseformat[0])
                    {
                      case('radio'):
                      case('checkbox'):
                      case('subquestion-radio'):
                        $hasfieldset = True;
                        break;
                      default:
                        $hasfieldset = ($responseformat[1] ?? '') === 'address' ? True : False;
                        break;
                    }
                  @endphp
                  @if($hasfieldset)
                    <fieldset class="form-group" aria-describedby="{{ $question->questionshortname }}:questiondescr">
                      <legend class="sr-only">{{ $question->questiontext }}</legend>
                      <div class="form-row">
                  @else
                    <div class="form-group form-row">
                  @endif
                    @switch($responseformat[0])
                      
                      
                      @case('subquestion-radio')
                        @php
                          $subquestions = explode('|',$responseformat[1]);
                          $globalradios = explode('|',$responseformat[2]);
                          $theselectedglobalradio = NULL;
                          foreach($globalradios as $globalradio)
                          {
                            if(substr($globalradio,0,1) === '!')
                            {
                              $theselectedglobalradio = substr($globalradio,1);
                            }
                          }
                          
                          // query responses for extra subquestions.
                          $responses = DB::table('rego_responses')
                                         ->where('questionshortname',$question->questionshortname)
                                         ->value('responsejson');
                          $responses = json_decode($responses,TRUE) ?? [];
                          
                          $radiogroup1 = [];
                          $radiogroup2 = [];
                          
                          $radiogrouphasothertext = false;
                          foreach($subquestions as $subquestion)
                          {
                            if($subquestion === 'OtherText')
                            {
                              $radiogrouphasothertext = true;
                            }
                            else
                            {
                              $radiogroup1[] = $subquestion;
                              $radiogroup2[] = $responses[strtolower($subquestion)] ?? $theselectedglobalradio;
                              unset($responses[strtolower($subquestion)]);
                            }
                          }
                          foreach($responses as $responsekey => $responseval)
                          {
                            $radiogroup1[] = $responsekey;
                            $radiogroup2[] = $responseval;
                          }
                          if($radiogrouphasothertext)
                          {
                            $radiogroup1[] = 'OtherText';
                            $radiogroup2[] = NULL;
                          }
                          $radiogroupkeys = array_keys($radiogroup1);
                          
                        @endphp
                        <label class="col-md-3 text-md-right">{{ $question->questiontext }}</label>
                        <div class="col-md-5">
                          <div class="form-row">
                            <div class="col-12" id="{{ $question->questionshortname }}:container">
                              @foreach($radiogroupkeys as $radiogroupkey)
                                @php
                                  $subquestion = $radiogroup1[$radiogroupkey];
                                  $subquesitonval = $radiogroup2[$radiogroupkey];
                                @endphp
                                @if($subquestion === 'OtherText')
                                  <button type="button"
                                         class="btn btn-default checkboxadd rounded-0"
                                       onclick="addsubquestionradio('{{ $question->questionshortname }}',{{ json_encode($question->html5required) }},{{ json_encode($globalradios) }})">Add another option</button>
                                @else
                                  @php
                                    $subquestionlc = strtolower($subquestion);
                                  @endphp
                                  {{-- SUBQUESTION PLACE --}}
                                  <div class="form-row form-row-striped">
                                    <div class="col-sm-4">{{ $subquestion }}</div>
                                    <div class="col-sm-8"
                                            id="{{ $question->questionshortname }}:{{ $subquestionlc }}:container"
                                    >
                                    @foreach($globalradios as $globalradio)
                                      @php
                                        if(substr($globalradio,0,1) === '!')
                                        {
                                          $globalradio = substr($globalradio,1);
                                        }
                              
                                        $globalradio = explode('^',$globalradio);
                                        $globalradio[1] = $globalradio[1] ?? $globalradio[0];
                                        
                                        
                                        
                                      @endphp
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                                type="radio"
                                                  id="{{ $subquestionlc }}:{{ $globalradio[1] }}"
                                               value="{{ $globalradio[1] }}"
                                                name="{{ $question->questionshortname }}[{{ $subquestionlc }}]"
                                                     @if ($question->html5required)
                                                       required
                                                     @endif
                                                     @if ($subquesitonval === $globalradio[1])
                                                       checked
                                                     @endif
                                        >
                                        <label class="form-check-label" for="{{ $subquestionlc }}:{{ $globalradio[1] }}">{{ $globalradio[0] }}</label>
                                      </div>
                                    @endforeach
                                    </div>
                                  </div>
                                @endif
                              @endforeach
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-12" id="{{ $question->questionshortname }}:othertext:container">
                            </div>
                          </div>
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4">
                          {!! $question->questiondescr !!}
                        </span>
                        @break
                      
                      


                      @case('textarea')
                        <label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{{ $question->questiontext }}</label>
                        <div class="col-md-5">
                          <textarea class="rounded-0 form-control @if ($errors->has($question->questionshortname)) is-invalid @endif"
                                       id="{{ $question->questionshortname }}"
                                     rows="2"
                                     name="{{ $question->questionshortname }}">{{
                            old($question->questionshortname)
                            ??
                            json_decode(DB::table('rego_responses')
                                          ->where('userid',Auth::id())
                                          ->where('questionshortname',$question->questionshortname)
                                          ->value('responsejson'))
                          }}</textarea>
                            <div class="invalid-feedback">
                              @if ($errors->has($question->questionshortname))
                                @foreach ($errors->get($question->questionshortname) as $message)
                                  @if(!$loop->first)<br>@endif{{ $message }}
                                @endforeach
                              @endif
                            </div>
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4">
                          {!! $question->questiondescr !!}
                        </span>
                        @break
                      @case('text')
                        @if($responseformat[1] == 'address')
                        {{-- This is not implemented correctly. Use "textarea" instead.
                          <label class="col-md-3 col-form-label text-md-right">{{ $question->questiontext }}</label>
                          <div class="col-md-5">
                            <label for="{{ $question->questionshortname }}:addressline1" class="sr-only">{{ $question->questiontext }} Address line 1</label>
                            <input id="{{ $question->questionshortname }}:addressline1" type="text" class="rounded-0 form-control" name="{{ $question->questionshortname }}:addressline1" placeholder="Address line 1" value="{{ old($question->questionshortname . ':addressline1') }}">
                            <label for="{{ $question->questionshortname }}:addressline2" class="sr-only">{{ $question->questiontext }} Address line 2</label>
                            <input id="{{ $question->questionshortname }}:addressline2" type="text" class="rounded-0 form-control" name="{{ $question->questionshortname }}:addressline2" placeholder="Address line 2" value="{{ old($question->questionshortname . ':addressline2') }}">
                            <div class="form-row no-gutters">
                              <div class="col-lg-6">
                               <label for="{{ $question->questionshortname }}:city" class="sr-only">{{ $question->questiontext }} City</label>
                               <input id="{{ $question->questionshortname }}:city" type="text" class="rounded-0 form-control" name="{{ $question->questionshortname }}:city" placeholder="City" value="{{ old($question->questionshortname . ':city') }}">
                              </div>
                              <div class="col-lg-3">
                                <label for="{{ $question->questionshortname }}:stateterritory" class="sr-only">{{ $question->questiontext }} State/Territory</label>
                                <input id="{{ $question->questionshortname }}:stateterritory" type="text" class="rounded-0 form-control" name="{{ $question->questionshortname }}:stateterritory" placeholder="State/Territory" value="{{ old($question->questionshortname . ':stateterritory') }}">
                              </div>
                              <div class="col-lg-3">
                                <label for="{{ $question->questionshortname }}:postcode" class="sr-only">{{ $question->questiontext }} Postcode</label>
                                <input id="{{ $question->questionshortname }}:postcode" type="text" class="rounded-0 form-control @if ($errors->has($question->questionshortname . ':postcode')) is-invalid @endif" name="{{ $question->questionshortname }}:postcode" placeholder="Postcode" value="{{ old($question->questionshortname . ':postcode') }}">
                                <div class="invalid-feedback">
                                  @if ($errors->has($question->questionshortname . ':postcode'))
                                    @foreach ($errors->get($question->questionshortname . ':postcode') as $message)
                                      @if(!$loop->first)<br>@endif{{ $message }}
                                    @endforeach
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
                          --}}
                        @else
                          <label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{{ $question->questiontext }}</label>
                          <div class="col-md-5">
                            <input    id="{{ $question->questionshortname }}"
                                    type="{{ $responseformat[1] }}"
                                   class="rounded-0 form-control @if ($errors->has($question->questionshortname)) is-invalid @endif"
                                    name="{{ $question->questionshortname }}"
                                   value="{{ old($question->questionshortname)
                                             ?? json_decode(DB::table('rego_responses')
                                                              ->where('userid',Auth::id())
                                                              ->where('questionshortname',$question->questionshortname)
                                                              ->value('responsejson'))
                                          }}"
                        aria-describedby="{{ $question->questionshortname }}:questiondescr"
                                       @if ($question->html5required)
                                         required
                                       @endif>
                            <div class="invalid-feedback">
                              @if ($errors->has($question->questionshortname))
                                @foreach ($errors->get($question->questionshortname) as $message)
                                  @if(!$loop->first)<br>@endif{{ $message }}
                                @endforeach
                              @endif
                            </div>
                          </div>
                          <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
                        @endif
                        @break
                      @case('radio')
                        @php
                          $answeritems = explode('|',$responseformat[1]);
                        @endphp
                        <label class="col-md-3 col-form-label text-md-right pt-0">{{ $question->questiontext }}</label>
                        <div class="col-md-5">
                          @foreach ($answeritems as $answeritem)
                            @php
                              $answeritemarray = explode('^',$answeritem);
                              $answeritemarray[1] = $answeritemarray[1] ?? strtolower($answeritemarray[0]);
                            @endphp
                            @if($answeritemarray[0] === 'OtherText')
                              @php
                                $othertextradio = $answeritemarray[1] === (old($question->questionshortname) ?? json_decode(DB::table('rego_responses')
                                                                                                                        ->where('userid',Auth::id())
                                                                                                                        ->where('questionshortname',$question->questionshortname)
                                                                                                                        ->value('responsejson')));
                                $othertexttext = old($question->questionshortname . ':' . $answeritemarray[1])
                                                 ?? json_decode(DB::table('rego_responses_nofk')
                                                                  ->where('userid',Auth::id())
                                                                  ->where('attributename',$question->questionshortname . ':' . $answeritemarray[1])
                                                                  ->value('responsejson'));
                                $othertexterror = $othertextradio && is_null($othertexttext);
                              @endphp
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text rounded-0">
                                    <input type="radio"
                                           name="{{ $question->questionshortname }}"
                                          value="{{ $answeritemarray[1] }}"
                                     aria-label="Radio button for following text input"
                                            @if ($othertextradio)
                                              checked
                                            @endif>
                                  </div>
                                </div>
                                <input type="text"
                                      class="rounded-0 form-control
                                             @if ($errors->has($question->questionshortname) || $othertexterror)
                                               is-invalid
                                             @endif"
                                       name="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}"
                                 aria-label="Text input with radio button"
                                placeholder="Other"
                                      value="{{ $othertexttext }}">
                                <div class="invalid-feedback">
                                  @if ($errors->has($question->questionshortname))
                                    @foreach ($errors->get($question->questionshortname) as $message)
                                      @if(!$loop->first)<br>@endif{{ $message }}
                                    @endforeach
                                  @endif
                                  @if($othertexterror)
                                    The other field is required if it is selected.
                                  @endif
                                </div>
                              </div>
                            @else
                              <div class="form-check">
                                <input class="form-check-input @if ($errors->has($question->questionshortname)) is-invalid @endif"
                                        type="radio"
                                        name="{{ $question->questionshortname }}"
                                          id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}"
                                       value="{{ $answeritemarray[1] }}"
                                       @if ($question->html5required)
                                         required
                                       @endif
                                       @if ($answeritemarray[1] === (old($question->questionshortname) ?? json_decode(DB::table('rego_responses')
                                                                                                                        ->where('userid',Auth::id())
                                                                                                                        ->where('questionshortname',$question->questionshortname)
                                                                                                                        ->value('responsejson'))))
                                         checked
                                       @endif>
                                <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                  {{ $answeritemarray[0] }}
                                </label>
                                @if($loop->last)
                                  <div class="invalid-feedback">
                                    @if ($errors->has($question->questionshortname))
                                      @foreach ($errors->get($question->questionshortname) as $message)
                                        @if(!$loop->first)<br>@endif{{ $message }}
                                      @endforeach
                                    @endif
                                  </div>
                                @endif
                              </div>
                            @endif
                          @endforeach
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4">
                          {!! $question->questiondescr !!}
                        </span>
                        @break
                      @case('checkbox')
                        @php
                          $answeritems = explode('|',$responseformat[1]);
                          // Check for custom answer items and insert them now.
                          if(in_array('OtherText',$answeritems))
                          {
                            $OtherKey = array_search('OtherText',$answeritems);
                            unset($answeritems[$OtherKey]);
                            $a = DB::table('rego_responses')
                              ->where('userid',Auth::id())
                              ->where('questionshortname',$question->questionshortname)
                              ->value('responsejson');
                            $answeritems = array_unique(array_merge($answeritems,json_decode($a) ?? []));
                            $answeritems[] = 'OtherText';
                          }
                          // This "hiddeninput" business is a hack so that when optional checkboxes are fully unchecked,
                          // that the system will recognise that the user wants none of them, instead of interpreting
                          // it as if it weren't POSTed.
                          if(in_array('hiddeninput',$answeritems))
                          {
                            unset($answeritems[array_search('hiddeninput',$answeritems)]);
                          }
                          // Some duplicates might still exist. We'll check for these
                          // as we go using $checkboxduplicates.
                          $checkboxduplicates = [];
                        @endphp
                        <label class="col-md-3 col-form-label text-md-right pt-0">{{ $question->questiontext }}</label>
                        <div class="col-md-5">
                          <input type="hidden" name="{{ $question->questionshortname }}[]" value="hiddeninput" checked>
                          @foreach ($answeritems as $answeritem)
                            @php
                              $answeritemarray = explode('^',$answeritem);
                              $answeritemarray[1] = $answeritemarray[1] ?? $answeritemarray[0];
                              if(in_array($answeritemarray[1],$checkboxduplicates))
                              {
                                $isduplicate = True;
                              }
                              else
                              {
                                $isduplicate = False;
                                $checkboxduplicates[] = $answeritemarray[1];
                              }
                              if(isset($responseformat[2]))
                              {
                                $haselaborations = True;
                                $globalansweritemelaborations = explode('|',$responseformat[2]);
                              }
                              else
                              {
                                $haselaborations = False;
                              }
                            @endphp
                            @if(!$isduplicate)
                              <div class="form-row">
                                @if($answeritemarray[0] === 'OtherText')
                                  <div class="col">
                                    @if($haselaborations)
                                      <button type="button" class="btn btn-default checkboxadd rounded-0" onclick="addothertext('{{ $question->questionshortname }}','{{ $answeritemarray[1] }}',{{ json_encode($globalansweritemelaborations) }})">Add another option</button>
                                    @else
                                      <button type="button" class="btn btn-default checkboxadd rounded-0" onclick="addothertext('{{ $question->questionshortname }}','{{ $answeritemarray[1] }}')">Add another option</button>
                                    @endif
                                  </div>
                                @else
                                  @if($haselaborations)
                                    <div class="col-sm-6">
                                      <div class="form-check" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:parent">
                                        <input class="form-check-input @if ($errors->has($question->questionshortname)) is-invalid @endif" onchange="toggleelaborations('{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:parent',{{ json_encode($globalansweritemelaborations) }})" type="checkbox" name="{{ $question->questionshortname }}[]" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}" value="{{ $answeritemarray[1] }}">
                                        <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                          {{ $answeritemarray[0] }}
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      @if($answeritemarray[0] !== 'OtherText')
                                        @foreach ($globalansweritemelaborations as $elaboration)
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" style="visibility:hidden" type="radio" name="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:{{ $elaboration }}" value="{{ $elaboration }}">
                                            <label class="form-check-label" style="visibility:hidden"  for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:{{ $elaboration }}" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:{{ $elaboration }}:label">{{ $elaboration }}</label>
                                          </div>
                                        @endforeach
                                      @endif
                                    </div>
                                  @else
                                    <div class="col">
                                      <div class="form-check" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:parent">
                                        <input class="form-check-input @if ($errors->has($question->questionshortname)) is-invalid @endif"
                                                type="checkbox"
                                                name="{{ $question->questionshortname }}[]"
                                                id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}"
                                               value="{{ $answeritemarray[1] }}"
                                               @if(in_array(
                                                     $answeritemarray[1],
                                                     old($question->questionshortname)
                                                     ??
                                                     json_decode(DB::table('rego_responses')
                                                                   ->where('userid',Auth::id())
                                                                   ->where('questionshortname',$question->questionshortname)
                                                                   ->value('responsejson'))
                                                     ??
                                                     []))
                                                 checked
                                               @endif>
                                        <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                          {{ $answeritemarray[0] }}
                                        </label>
                                        @if($loop->last)
                                          <div class="invalid-feedback">
                                            @if ($errors->has($question->questionshortname))
                                              @foreach ($errors->get($question->questionshortname) as $message)
                                                @if(!$loop->first)<br>@endif{{ $message }}
                                              @endforeach
                                            @endif
                                          </div>
                                        @endif
                                      </div>
                                    </div>
                                  @endif
                                @endif
                              </div>
                              <div id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:container"></div>
                            @endif
                          @endforeach
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4">{!! $question->questiondescr !!}</span>
                        @break
                      @default
                        <p>Something went wrong here: $answercontrol is <strong>{{ $answercontrol }}</strong> which is not allowed.</p>
                    @endswitch
                  @if($hasfieldset)
                      </div>
                    </fieldset>
                  @else
                    </div>
                  @endif
                @endforeach <!-- end for each questions as question -->
              @endforeach <!-- end for each subsections as subsection -->
              <div class="form-group form-row mb-0">
                <div class="offset-md-3 col-md-5">
                  <button type="submit" class="rounded-0 btn btn-primary">Save</button>
                </div>
              </div>
            </form>
            
            
            
            
          </div>
        </div>
            
      @endforeach
          
          
          
          
          
    </div>
  </div>
</div>
@endsection
