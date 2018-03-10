<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $question->questiontext !!}</label>
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
                   is_null(
                     $a = json_decode(DB::table('rego_responses')
                       ->where('userid',Auth::id())
                       ->where('foritem','')
                       ->where('questionshortname',$question->questionshortname)
                       ->value('responsejson'))
                   )
                   ? NULL
                   : $a->{$variant[1]}
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
</div>
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">{!! $question->questiondescr !!}</span>
