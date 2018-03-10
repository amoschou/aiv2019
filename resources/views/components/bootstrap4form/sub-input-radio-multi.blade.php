<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $question->questiontext !!}</label>
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
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
