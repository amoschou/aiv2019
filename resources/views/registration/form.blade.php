@extends('registration.layouts.app')

@section('extrastyles')
<style>
  .form-row-striped:nth-of-type(odd) {
    background-color: rgba(0,0,0,.05)
  }
</style>
<link href="//cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"
      rel="stylesheet">
<link href="//fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css">
{{--
<link href="//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet">
<script type="text/javascript"
         src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
--}}
@endsection

@section('extrascripts')
{{--
<script type="text/javascript"
         src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script type="text/javascript"
         src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/en-au.js"></script>
--}}
<script src="/js/bootstrap-select.js"></script>
<script>
  function addfileinput(questionshortname)
  {
    var htmlstr = document.getElementById(questionshortname + ':extra').innerHTML;
    var i = document.getElementById(questionshortname + ':extra').childElementCount;
    // Expect one child already (the hidden input), so add 1 to begin the new children.
    i = i + 1;

    htmlstr = htmlstr + '                            <div class="col-md-12">';
    htmlstr = htmlstr + '                              <div class="input-group">';
    htmlstr = htmlstr + '                                <div class="input-group-prepend">';
    htmlstr = htmlstr + '                                  <div class="input-group-text rounded-0">';
    htmlstr = htmlstr + '                                    <div class="pretty p-icon p-toggle p-plain pr-0 mr-0">';
    htmlstr = htmlstr + '                                      <input type="checkbox"';
    htmlstr = htmlstr + '                                             name="' + questionshortname + '[checkbox][' + i + ']"';
    htmlstr = htmlstr + '                                       aria-label="Checkbox for following text input"';
    htmlstr = htmlstr + '                                              checked>';
    htmlstr = htmlstr + '                                      <div class="state p-on">';
    htmlstr = htmlstr + '                                        <i class="icon material-icons text-primary">check_box</i>';
    htmlstr = htmlstr + '                                        <label></label>';
    htmlstr = htmlstr + '                                      </div>';
    htmlstr = htmlstr + '                                      <div class="state p-off">';
    htmlstr = htmlstr + '                                        <i class="icon material-icons text-secondary">check_box_outline_blank</i>';
    htmlstr = htmlstr + '                                        <label></label>';
    htmlstr = htmlstr + '                                      </div>';
    htmlstr = htmlstr + '                                    </div>';
    htmlstr = htmlstr + '                                  </div>';
    htmlstr = htmlstr + '                                </div>';
    htmlstr = htmlstr + '                                <input class="rounded-0 form-control" type="file" name="' + questionshortname + '[file][' + i + ']" id="' + questionshortname + ':file:' + i + '" aria-label="File input with checkbox">';
    htmlstr = htmlstr + '                              </div>';
    htmlstr = htmlstr + '                            </div>';

    document.getElementById(questionshortname + ':extra').innerHTML = htmlstr;
  }
  function customselect(questionshortname)
  {
    var htmlstr = document.getElementById(questionshortname + ':custom').innerHTML;
    var selectvalinternal = document.getElementById(questionshortname).value;
    var selectvaldisplay = document.getElementById(questionshortname + ':' + selectvalinternal).innerHTML;
    var i = document.getElementById(questionshortname + ':custom').childElementCount;
    htmlstr = htmlstr + '<div class="form-row">';
    htmlstr = htmlstr +   '<div class="col-md-6">';
    htmlstr = htmlstr +     '<div class="form-control-plaintext">';




      htmlstr = htmlstr +     '<div class="pl-0 form-check">';
      htmlstr = htmlstr +       '<div class="pretty p-icon p-toggle p-plain">';
      htmlstr = htmlstr +         '<input class="form-check-input" ';
      htmlstr = htmlstr +                 'type="checkbox" ';
      htmlstr = htmlstr +                   'id="' + questionshortname + ':checkbox:' + i + '" ';
      htmlstr = htmlstr +                'value="' + selectvalinternal + '" ';
      htmlstr = htmlstr +                 'name="' + questionshortname + '[checkbox][' + i + ']" ';
      htmlstr = htmlstr +         ' checked >';

    htmlstr = htmlstr +           '<div class="state p-on">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-primary">check_box</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + ':checkbox:' + i + '">' + selectvaldisplay + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +           '<div class="state p-off">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-secondary">check_box_outline_blank</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + ':checkbox:' + i + '">' + selectvaldisplay + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +         '</div>';
      
      htmlstr = htmlstr +     '</div>';




    htmlstr = htmlstr +     '</div>';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr +   '<div class="col-md-6">';
    htmlstr = htmlstr +     '<input class="rounded-0 form-control" name="' + questionshortname + '[customtext][' + i + ']">';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr + '</div>';
    document.getElementById(questionshortname + ':custom').innerHTML = htmlstr;
  }
  function deselect(questionshortname)
  {
    var radiolist = document.getElementsByName(questionshortname);
    for(var i = 0 ; i < radiolist.length; i++)
    {
      radiolist[i].checked = false;
    }
    document.getElementById(questionshortname + ":deselected").checked = true;
  }
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
      htmlstr = htmlstr +     '<div class="pl-0 form-check">';
      htmlstr = htmlstr +       '<div class="pretty p-icon p-toggle p-plain">';
      htmlstr = htmlstr +         '<input class="form-check-input" ';
      htmlstr = htmlstr +                 'type="radio" ';
      htmlstr = htmlstr +                   'id="' + questionshortname + '[othertext][' + i + ']" ';
      htmlstr = htmlstr +                'value="' + radio[1] + '" ';
      htmlstr = htmlstr +                 'name="' + questionshortname + '[othertext][' + i + ']" ';
      htmlstr = htmlstr +                       (html5required ? 'required ' : '');
      htmlstr = htmlstr +         '>';

    htmlstr = htmlstr +           '<div class="state p-on">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-primary">radio_button_checked</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + '[othertext][' + i + ']">' + radio[0] + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +           '<div class="state p-off">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-secondary">radio_button_unchecked</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + '[othertext][' + i + ']">' + radio[0] + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +         '</div>';
      
      htmlstr = htmlstr +     '</div>';
    }
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr + '</div>';

    document.getElementById(questionshortname + ':othertext:container').innerHTML = htmlstr;
  }
  function addothertext(questionshortname,istring,elaborations = null)
  {
    var i = document.getElementById(questionshortname + ':' + istring + ':container').childElementCount;
    var htmlstr = document.getElementById(questionshortname + ':' + istring + ':container').innerHTML;
    htmlstr = htmlstr + '<div class="input-group">';
    htmlstr = htmlstr +   '<div class="input-group-prepend">';
    htmlstr = htmlstr +     '<div class="input-group-text rounded-0">';
    htmlstr = htmlstr +       '<div class="pretty p-icon p-toggle p-plain pr-0 mr-0">';
    htmlstr = htmlstr +         '<input type="checkbox" name="' + questionshortname + '[' + istring + '][' + i + ']" value="' + i + '" aria-label="Checkbox button for following text input" checked>';
    htmlstr = htmlstr +         '<div class="state p-on">';
    htmlstr = htmlstr +           '<i class="icon material-icons text-primary">check_box</i>';
    htmlstr = htmlstr +           '<label></label>';
    htmlstr = htmlstr +         '</div>';
    htmlstr = htmlstr +         '<div class="state p-off">';
    htmlstr = htmlstr +           '<i class="icon material-icons text-secondary">check_box_outline_blank</i>';
    htmlstr = htmlstr +           '<label></label>';
    htmlstr = htmlstr +         '</div>';
    htmlstr = htmlstr +       '</div>';
    htmlstr = htmlstr +     '</div>';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr +   '<input type="text" class="form-control rounded-0" name="' + questionshortname + ':' + istring + '[' + i + ']" aria-label="Text input with radio button" placeholder="Other">';
    htmlstr = htmlstr + '</div>';
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
            <div class="list-group list-group-flush">
              @if(!is_null($section->sectiondescr))
                <div class="list-group-item text-info border-primary" class="info">
                 {!! $section->sectiondescr !!}
                </div>
              @endif
              <div class="list-group-item border-primary">
                General tips<br>
                If a question does not apply to you, it is best to <strong>leave it empty</strong>.
                Putting ‘N/A’ or ‘0’ or something similar draws our attention to the wrong places and makes our job harder.
              </div>
            </div>
          <div class="card-body">
          
          

            <form class="form-horizontal" method="POST" action="/home/registration/{{ $section->sectionid }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="foritem" value="{{ $foritem }}">
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
                             ? DB::table('rego_questions')
                                 ->select('questionshortname','questiontext','questiondescr','responseformat','html5required')
                                 ->whereRaw('sectionid = ? and subsectioncode = ?',[$section->sectionid, $subsection->subsectioncode])
                                 ->orderBy('questionord','asc')
                                 ->get()
                             : DB::table('rego_questions')
                                 ->select('questionshortname','questiontext','questiondescr','responseformat','html5required')
                                 ->where('sectionid',$section->sectionid)
                                 ->orderBy('questionord','asc')
                                 ->get();
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
                    //   then $responseformat[1] will be "text" or "email" or "tel" or "datetime-local" or some other HTML5 value for the type attribute of <input>,
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
                    $questiontextwithoptional = $question->questiontext . ($question->html5required
                                                                           ? ''
                                                                           : '<br><small class="text-muted">Optional</small>');
                    $responseformat = explode(':',$question->responseformat);
                    switch($responseformat[0])
                    {
                      case('radio'):
                      case('checkbox'):
                      case('subquestion-radio'):
                      case('text-var'):
                      case('files'):
                        $hasfieldset = True;
                        break;
                      default:
                        $hasfieldset = False;
                        break;
                    }
                  @endphp
                  @if($hasfieldset)
                    <fieldset class="form-group" aria-describedby="{{ $question->questionshortname }}:questiondescr">
                      <legend class="sr-only">{!! $questiontextwithoptional !!}</legend>
                      <div class="form-row">
                  @else
                    <div class="form-group form-row">
                  @endif
                  
{{-- GIANTS SWITCH --}}
                    @switch($responseformat[0])
                    
{{-- GIANTS SWITCH CASE --}}
                      @case('files')
                        <label class="col-md-3 col-form-label text-md-right">{!! $questiontextwithoptional !!}</label>
                        <div class="col-md-5">
                          <div class="form-row">
                            <div class="col-md-12">
                              <button type="button" class="btn btn-default checkboxadd rounded-0" onclick="addfileinput('{{ $question->questionshortname }}')">Add a file</button>
                            </div>
                          </div>
                          <input type="hidden" value="hiddeninput" name="{{ $question->questionshortname }}[checkbox][0]">
                          <input type="hidden" value="hiddeninput" name="{{ $question->questionshortname }}[file][0]">
                          <div class="form-row" id="{{ $question->questionshortname }}:extra">
                            @php
                              $files = DB::table('v_rego_fileuploads')
                                ->select('key','filename')
                                ->where('userid',Auth::id())
                                ->where('foritem','')
                                ->where('questionshortname',$question->questionshortname)
                                ->get();
                            @endphp
                            @foreach($files as $file)
                              <div class="col-md-12">
                                <div class="form-check pl-0" id="">
                                  <div class="pretty p-icon p-toggle p-plain" id="">
                                    <input class="form-check-input"
                                            type="checkbox"
                                            name="{{ $question->questionshortname }}[checkbox][{{ $file->key }}]"
                                            id="{{ $question->questionshortname }}:checkbox:{{ $file->key }}"
                                           value="save"
                                                checked>
                                      <div class="state p-on">
                                        <i class="icon material-icons text-primary">check_box</i>
                                        <label class="form-check-label" for="{{ $question->questionshortname }}:checkbox:{{ $file->key }}">
                                          {{ $file->filename }}
                                        </label>
                                      </div>
                                      <div class="state p-off">
                                        <i class="icon material-icons text-secondary">check_box_outline_blank</i>
                                        <label class="form-check-label" for="{{ $question->questionshortname }}:checkbox:{{ $file->key }}">
                                          {{ $file->filename }}
                                        </label>
                                      </div>
                                  </div>
                                  <a href="/home/registration/{{$question->questionshortname}}/{{$file->key}}/{{$file->filename}}">Open</a>
                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
                        @break

{{-- GIANTS SWITCH CASE --}}
                      @case('text-var-custom')
                        <label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $questiontextwithoptional !!}</label>
                        <div class="col-md-5">
                          @php
                            $variants = explode('|',$responseformat[2]);
                          @endphp
                          <div class="form-row">
                            <div class="col-md-12">
                              <select id="{{ $question->questionshortname }}" class="form-control selectpicker" title="Select a bottle" data-style="rounded-0">
                                @foreach($variants as $variant)
                                  @php
                                    $variant = explode('^',$variant);
                                    $variant[1] = $variant[1] ?? $variant[0];
                                  @endphp
                                  <option id="{{ $question->questionshortname }}:{{ $variant[1] }}" value="{{ $variant[1] }}">{{ $variant[0] }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-12">
                              <button type="button" class="btn btn-default checkboxadd rounded-0" onclick="customselect('{{ $question->questionshortname }}')">Add {{ $question->questionshortname }}</button>
                            </div>
                          </div>
                          <div id="{{ $question->questionshortname }}:custom">
                            @php
                             $existingcustoms = json_decode(DB::table('rego_responses')
                                                              ->where('questionshortname',$question->questionshortname)
                                                              ->where('userid',Auth::id())
                                                              ->where('foritem',$foritem)
                                                              ->value('responsejson'));
                            @endphp
                            @foreach($existingcustoms->checkbox ?? [] as $key => $val)
                              <div class="form-row">
                                <div class="col-md-6">
                                  <div class="form-control-plaintext">
                                    <div class="pl-0 form-check">
                                      <div class="pretty p-icon p-toggle p-plain">
                                        <input class="form-check-input" type="checkbox" id="{{ $question->questionshortname }}:checkbox:{{ $loop->index }}" value="{{ $val }}" name="{{ $question->questionshortname }}[checkbox][{{ $loop->index }}]" checked>
                                        <div class="state p-on">
                                          <i class="icon material-icons text-primary">check_box</i>
                                          <label class="form-check-label" for="{{ $question->questionshortname }}:checkbox:{{ $loop->index }}">{{ $val }}</label>
                                        </div>
                                        <div class="state p-off">
                                          <i class="icon material-icons text-secondary">check_box_outline_blank</i>
                                          <label class="form-check-label" for="{{ $question->questionshortname }}:checkbox:{{ $loop->index }}">{{ $val }}</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <input class="rounded-0 form-control" name="{{ $question->questionshortname }}[customtext][{{ $loop->index }}]" value="{{ $existingcustoms->customtext[$key] }}">
                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
                        @break
                    
{{-- GIANTS SWITCH CASE --}}
                      @case('text-var')
                        <label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $questiontextwithoptional !!}</label>
                        <div class="col-md-5">
                          @php
                            $variants = explode('|',$responseformat[2]);
                          @endphp
                          @foreach($variants as $variant)
                            @php
                              $variant = explode('^',$variant);
                              $variant[1] = $variant[1] ?? $variant[0];
                            @endphp
                            <div class="form-row">
                              <div class="col-md-6">
                                <div class="form-control-plaintext">{{ $variant[0] }}</div>
                              </div>
                              <div class="col-md-6">
                                <input
                                   type="{{ $responseformat[1] }}"
                                   name="{{ $question->questionshortname }}[{{ $variant[1] }}]"
                                  class="rounded-0 form-control @if ($errors->has($question->questionshortname . '.' . $variant[1])) is-invalid @endif "
                                 value="{{ old($question->questionshortname . '.' . $variant[1])
                                           ??
                                           json_decode(DB::table('rego_responses')
                                             ->where('userid',Auth::id())
                                             ->where('foritem','')
                                             ->where('questionshortname',$question->questionshortname)
                                             ->value('responsejson'))->{$variant[1]}
                                        }}"
                                      @if ($question->html5required)
                                        required
                                      @endif>
                                <div class="invalid-feedback">
                                  @if ($errors->has($question->questionshortname . '.' . $variant[1]))
                                    @foreach ($errors->get($question->questionshortname . '.' . $variant[1]) as $message)
                                      @if(!$loop->first)<br>@endif{{ $message }}
                                    @endforeach
                                  @endif
                                </div>
                              </div>
                            </div>
                          @endforeach
                          {{--
                          <input    id="{{ $question->questionshortname }}"
                                  type="{{ $responseformat[1] }}"
                                 class="rounded-0 form-control @if ($errors->has($question->questionshortname)) is-invalid @endif " 
                                  name="{{ $question->questionshortname }}"
                                 value="{{ old($question->questionshortname)
                                           ?? json_decode(DB::table('rego_responses')
                                                            ->where('userid',Auth::id())
                                       ->where('foritem',$foritem)
                                                            ->where('questionshortname',$question->questionshortname)
                                                            ->value('responsejson'))
                                        }}"
                                     @if ($question->html5required)
                                       required
                                     @endif>
                          --}}
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
                        @break

{{-- GIANTS SWITCH CASE --}}
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
                                         ->where('userid',Auth::id())
                                         ->where('foritem',$foritem)
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
                        <label class="col-md-3 text-md-right">{!! $questiontextwithoptional !!}</label>
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
                                      <div class="form-check">
                                        <div class="pretty p-icon p-toggle p-plain">
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
                                          <div class="state p-on">
                                            <i class="icon material-icons text-primary">radio_button_checked</i>
                                            <label class="form-check-label" for="{{ $subquestionlc }}:{{ $globalradio[1] }}">{{ $globalradio[0] }}</label>
                                          </div>
                                          <div class="state p-off">
                                            <i class="icon material-icons text-secondary">radio_button_unchecked</i>
                                            <label class="form-check-label" for="{{ $subquestionlc }}:{{ $globalradio[1] }}">{{ $globalradio[0] }}</label>
                                          </div>
                                        </div>
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
                      
{{-- GIANTS SWITCH CASE --}}
                      @case('textarea')
                        <label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $questiontextwithoptional !!}</label>
                        <div class="col-md-5">
                          <textarea class="rounded-0 form-control @if ($errors->has($question->questionshortname)) is-invalid @endif"
                                       id="{{ $question->questionshortname }}"
                                     rows="2"
                                     name="{{ $question->questionshortname }}">{{
                            old($question->questionshortname)
                            ??
                            json_decode(DB::table('rego_responses')
                                          ->where('userid',Auth::id())
                                          ->where('foritem',$foritem)
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

{{-- GIANTS SWITCH CASE --}}
                      @case('text')
                        <label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $questiontextwithoptional !!}</label>
                        <div class="col-md-5">
                          @php
                            $isdatetimelocal = $responseformat[1] === 'datetime-local';
                          @endphp
                          <input    id="{{ $question->questionshortname }}"
                                  type="{{ $isdatetimelocal ? 'text' : $responseformat[1] }}"
                                 class="rounded-0 form-control @if ($errors->has($question->questionshortname)) is-invalid @endif @if($isdatetimelocal) datetimepicker-input @endif " 
{{--
@if($isdatetimelocal)
                                 data-toggle="datetimepicker"
                                 data-target="#{{ $question->questionshortname }}"
@endif
--}}
                                  name="{{ $question->questionshortname }}"
                                 value="{{ old($question->questionshortname)
                                           ?? json_decode(DB::table('rego_responses')
                                                            ->where('userid',Auth::id())
                                       ->where('foritem',$foritem)
                                                            ->where('questionshortname',$question->questionshortname)
                                                            ->value('responsejson'))
                                        }}"
                      aria-describedby="{{ $question->questionshortname }}:questiondescr"
                                     @if ($question->html5required)
                                       required
                                     @endif>
{{--
@if($isdatetimelocal)
  <script type="text/javascript">
    $(function () {
      $('#{{ $question->questionshortname }}').datetimepicker();
    });
  </script>
@endif
--}}
                          <div class="invalid-feedback">
                            @if ($errors->has($question->questionshortname))
                              @foreach ($errors->get($question->questionshortname) as $message)
                                @if(!$loop->first)<br>@endif{{ $message }}
                              @endforeach
                            @endif
                          </div>
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
                        @break

{{-- GIANTS SWITCH CASE --}}
                      @case('radio')
                        @php
                          $answeritems = explode('|',$responseformat[1]);
                        @endphp
                        <label class="col-md-3 col-form-label text-md-right pt-0">{!! $questiontextwithoptional !!}</label>
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
                                         ->where('foritem',$foritem)
                                                                                                                        ->where('questionshortname',$question->questionshortname)
                                                                                                                        ->value('responsejson')));
                                $othertexttext = old($question->questionshortname . ':' . $answeritemarray[1])
                                                 ?? json_decode(DB::table('rego_responses_nofk')
                                                                  ->where('userid',Auth::id())
                                         ->where('foritem',$foritem)
                                                                  ->where('attributename',$question->questionshortname . ':' . $answeritemarray[1])
                                                                  ->value('responsejson'));
                                $othertexterror = $othertextradio && ($othertexttext === '' || is_null($othertexttext));
                              @endphp
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text rounded-0">
                                    <div class="pretty p-icon p-toggle p-plain pr-0 mr-0">
                                      <input type="radio"
                                             name="{{ $question->questionshortname }}"
                                            value="{{ $answeritemarray[1] }}"
                                       aria-label="Radio button for following text input"
                                              @if ($othertextradio)
                                                checked
                                              @endif>
                                      <div class="state p-on">
                                        <i class="icon material-icons text-primary">radio_button_checked</i>
                                        <label></label>
                                      </div>
                                      <div class="state p-off">
                                        <i class="icon material-icons text-secondary">radio_button_unchecked</i>
                                        <label></label>
                                      </div>
                                    </div>
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
                              <div class="pl-0 form-check">
                                <div class="pretty p-icon p-toggle p-plain">
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
                                           ->where('foritem',$foritem)
                                                                                                                          ->where('questionshortname',$question->questionshortname)
                                                                                                                          ->value('responsejson'))))
                                           checked
                                         @endif>

                                  <div class="state p-on">
                                    <i class="icon material-icons text-primary">radio_button_checked</i>
                                    <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                      {{ $answeritemarray[0] }}
                                    </label>
                                  </div>
                                  <div class="state p-off">
                                    <i class="icon material-icons text-secondary">radio_button_unchecked</i>
                                    <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                      {{ $answeritemarray[0] }}
                                    </label>
                                  </div>
                                </div>
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
                          @if(!$question->html5required)
                            <input id="{{ $question->questionshortname }}:deselected" class="d-none" type="radio" name="{{ $question->questionshortname }}" value="">
                            <button type="button" class="btn btn-sm btn-default rounded-0" onclick="deselect('{{ $question->questionshortname }}')">Deselect</button>
                          @endif
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4">
                          {!! $question->questiondescr !!}
                        </span>
                        @break

{{-- GIANTS SWITCH CASE --}}
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
                                         ->where('foritem',$foritem)
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
                        <label class="col-md-3 col-form-label text-md-right pt-0">{!! $questiontextwithoptional !!}</label>
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
                                    <button type="button" class="btn btn-default checkboxadd rounded-0" onclick="addothertext('{{ $question->questionshortname }}','{{ $answeritemarray[1] }}')">Add another option</button>
                                  </div>
                                @else



                                  <div class="col">
                                    <div class="form-check pl-0" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:parent">
                                      <div class="pretty p-icon p-toggle p-plain" id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:parent">
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
                                         ->where('foritem',$foritem)
                                                                   ->where('questionshortname',$question->questionshortname)
                                                                   ->value('responsejson'))
                                                     ??
                                                     []))
                                                 checked
                                               @endif>
                                        <div class="state p-on">
                                          <i class="icon material-icons text-primary">check_box</i>
                                          <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                            {{ $answeritemarray[0] }}
                                          </label>
                                        </div>
                                        <div class="state p-off">
                                          <i class="icon material-icons text-secondary">check_box_outline_blank</i>
                                          <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}">
                                            {{ $answeritemarray[0] }}
                                          </label>
                                        </div>
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
                                  </div>
                                @endif
                              </div>
                              <div id="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}:container">
                                @if($answeritemarray[0] === 'OtherText')
                                  @php
                                    $othertextkeys = array_keys(old($question->questionshortname . ":OtherText") ?? []);
                                    $checkboxothertexterror = false;
                                  @endphp
                                  @foreach($othertextkeys as $othertextkey)
                                    @php
                                    $checkbothisoneerror = isset(old($question->questionshortname)['OtherText'][$othertextkey]) && (old($question->questionshortname . ":OtherText")[$othertextkey] === '' || is_null(old($question->questionshortname . ":OtherText")[$othertextkey]));
                                    $checkboxothertexterror =  $checkbothisoneerror ? True : $checkboxothertexterror;
                                    @endphp
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text rounded-0">
                                          <div class="pretty p-icon p-toggle p-plain pr-0 mr-0">
                                            <input type="checkbox" name="{{ $question->questionshortname }}[{{ $answeritemarray[1] }}][{{ $othertextkey }}]" value="{{ $othertextkey }}" aria-label="Radio button for following text input" {{ isset(old($question->questionshortname)['OtherText'][$othertextkey]) ? 'checked' : '' }}>
                                            <div class="state p-on">
                                              <i class="icon material-icons text-primary">check_box</i>
                                              <label></label>
                                            </div>
                                            <div class="state p-off">
                                              <i class="icon material-icons text-secondary">check_box_outline_blank</i>
                                              <label></label>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <input type="text" class="form-control rounded-0 @if($checkbothisoneerror) is-invalid @endif" name="{{ $question->questionshortname }}:{{ $answeritemarray[1] }}[{{ $othertextkey }}]" aria-label="Text input with radio button" placeholder="Other" @if(isset(old($question->questionshortname . ":OtherText")[$othertextkey])) value="{{ old($question->questionshortname . ":OtherText")[$othertextkey] }}" @endif>
                                      <div class="invalid-feedback">
                                        @if ($errors->has($question->questionshortname))
                                          @foreach ($errors->get($question->questionshortname) as $message)
                                            @if(!$loop->first)<br>@endif{{ $message }}
                                          @endforeach
                                        @endif
                                        @if($checkboxothertexterror)
                                          The other field is required if it is selected.
                                        @endif
                                      </div>
                                    </div>
                                  @endforeach
                                @endif
                              </div>
                            @endif
                          @endforeach
                        </div>
                        <span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4">{!! $question->questiondescr !!}</span>
                        @break

{{-- GIANTS SWITCH CASE --}}
                      @default
                        <p>Something went wrong here: $answercontrol is <strong>{{ $answercontrol }}</strong> which is not allowed.</p>
                    @endswitch
{{-- END GIANTS SWITCH CASE --}}

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
