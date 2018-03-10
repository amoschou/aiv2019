<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $question->questiontext !!}</label>
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
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
