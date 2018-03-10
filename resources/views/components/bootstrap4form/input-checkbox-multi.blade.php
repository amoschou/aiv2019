<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right pt-0">{!! $question->questiontext !!}</label>
<div class="col-md-5">
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
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
