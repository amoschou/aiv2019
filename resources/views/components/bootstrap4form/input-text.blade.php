{{--
  Handling $responseformat[1]
  Should it be done differently?
--}}
<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $question->questiontext !!}</label>
<div class="col-md-5">
  <input      id="{{ $question->questionshortname }}"
            type="{{ $inputtype }}"
           class="rounded-0 form-control @if($errors->has($question->questionshortname)) is-invalid @endif " 
            name="{{ $question->questionshortname }}"
           value="{{ old($question->questionshortname)
                     ?? json_decode(DB::table('rego_responses')
                                      ->where('userid',Auth::id())
                                      ->where('foritem',$foritem)
                                      ->where('questionshortname',$question->questionshortname)
                                      ->value('responsejson'))
                  }}"
   aria-describedby="{{ $question->questionshortname }}:questiondescr"
                    @if($question->html5required)
                      required
                    @endif
  >
  <div class="invalid-feedback">
    @if ($errors->has($question->questionshortname))
      @foreach ($errors->get($question->questionshortname) as $message)
        @if(!$loop->first)<br>@endif{{ $message }}
      @endforeach
    @endif
  </div>
</div>
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
