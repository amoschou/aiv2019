<label for="{{ $question->questionshortname }}" class="col-md-3 col-form-label text-md-right">{!! $question->questiontext !!}</label>
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
     $existingcustoms = json_decode(DB::table('rego_responses')->where('questionshortname',$question->questionshortname)->where('userid',Auth::id())->where('foritem',$foritem)->value('responsejson'));
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
