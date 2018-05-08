<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right pt-0">{!! $question->questiontext !!}</label>
@php
  $answeritems = explode('|',$responseformat[1]);
  $answeritemsdisplay = [];
  $answeritemsinternal = [];
  foreach($answeritems as $answeritem)
  {
    if($answeritem !== 'OtherText')
    {
      $answeritemarray = explode('^',$answeritem);
      $answeritemarray[1] = $answeritemarray[1] ?? strtolower($answeritemarray[0]);
      $answeritemsdisplay[] = $answeritemarray[0];
      $answeritemsinternal[] = $answeritemarray[1];
    }
  }
  // Check for custom answer items and insert them now.
  if(in_array('OtherText',$answeritems))
  {
    $OtherKey = array_search('OtherText',$answeritems);
    $a = DB::table('rego_responses')
             ->where('userid',Auth::id())
             ->where('foritem',$foritem)
             ->where('questionshortname',$question->questionshortname)
             ->value('responsejson');
    $a = json_decode($a);
    if(!is_null($a))
    {
      // Does it match any existing ones?
      $key = array_search(strtolower($a),$answeritemsinternal);
      // If $key is false, then not found. Otherwise $key contains the index.
      // If it's not found, then add it to the list
      if($key === FALSE)
      {
        $answeritemsdisplay[] = $a;
        $answeritemsinternal[] = $a;
      }
    }
    $answeritemsdisplay[] = 'othertext';
    $answeritemsinternal[] = 'othertext';
  }
@endphp
<div class="col-md-5">
  @foreach ($answeritemsinternal as $key => $answeritemsinternal)
    @php
      $internal = $answeritemsinternal;
      $display = $answeritemsdisplay[$key];
    @endphp
    @if($internal === 'othertext')
      @php
        $othertextradio = $internal === (old($question->questionshortname) ?? json_decode(DB::table('rego_responses')
                                                                                                ->where('userid',Auth::id())
                 ->where('foritem',$foritem)
                                                                                                ->where('questionshortname',$question->questionshortname)
                                                                                                ->value('responsejson')));
        $othertexttext = old($question->questionshortname . ':' . $internal)
                         ?? ''
                         ?? json_decode(DB::table('rego_responses_nofk')
                                          ->where('userid',Auth::id())
                 ->where('foritem',$foritem)
                                          ->where('attributename',$question->questionshortname . ':' . $internal)
                                          ->value('responsejson'));
        $othertexterror = $othertextradio && ($othertexttext === '' || is_null($othertexttext));
      @endphp
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text rounded-0">
            <div class="pretty p-icon p-toggle p-plain pr-0 mr-0">
              <input type="radio"
                     name="{{ $question->questionshortname }}"
                    value="{{ $internal }}"
               aria-label="Radio button for following text input"
                      @if ($othertextradio)
                        checked
                      @endif
              >
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
               name="{{ $question->questionshortname }}:{{ $internal }}"
         aria-label="Text input with radio button"
        placeholder="Other"
              value="{{ $othertexttext }}"
        >
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
                    id="{{ $question->questionshortname }}:{{ $internal }}"
                 value="{{ $internal }}"
                 @if ($question->html5required)
                   required
                 @endif
                 @if (strtolower($internal) === strtolower((old($question->questionshortname) ?? json_decode(DB::table('rego_responses')
                                                                                                  ->where('userid',Auth::id())
                   ->where('foritem',$foritem)
                                                                                                  ->where('questionshortname',$question->questionshortname)
                                                                                                  ->value('responsejson')))))
                   checked
                 @endif>

          <div class="state p-on">
            <i class="icon material-icons text-primary">radio_button_checked</i>
            <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $internal }}">
              {{ $display }}
            </label>
          </div>
          <div class="state p-off">
            <i class="icon material-icons text-secondary">radio_button_unchecked</i>
            <label class="form-check-label" for="{{ $question->questionshortname }}:{{ $internal }}">
              {{ $display }}
            </label>
          </div>
        </div>
        @if($loop->last)
          <div class="invalid-feedback" style="display: block">
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
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
