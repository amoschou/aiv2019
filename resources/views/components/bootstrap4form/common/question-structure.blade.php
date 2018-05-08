@if(@hasfieldset)
  <label class="col-md-3 col-form-label text-md-right">
    {!! $question->questiontext !!}
  </label>
@else
  <label for="{{$question->questionshortname }}" class="col-md-3 col-form-label text-md-right">
    {!! $question->questiontext !!}
  </label>
@endif
<div class="col-md-5">
  @yield('inputarea')
</div>
<span id="{{ $question->questionshortname }}:questiondescr" class="col-md-4 form-control-plaintext">
  {!! $question->questiondescr !!}
</span>
